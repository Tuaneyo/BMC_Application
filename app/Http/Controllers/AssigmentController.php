<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Helpers\Data;
use App\Models\User;
use App\Models\UserAssigment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;

class AssigmentController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {

        $today = Date::now()->format('l, j F');
        $component = Component::where('id', '=', $id)->with('AssignmentDesc')
            ->first();
        if(!isset($component)) return \Redirect::back()->with('danger', 'Pagina niet gevonden');

        $component->description = json_decode($component->description);
        $assignments = UserAssigment::where('component_id', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
        //dd($today);
        if (isset($component->deadline)) {
            $deadline = new Date($component->deadline);
            // $deadline->format('l j F Y H:i'); // vrijdag 31 mei 2019 00:40
            $deadline = collect([
                'day' => $deadline->format('l'),
                'dayInt' => $deadline->format('j'),
                'month' => $deadline->format('F'),
                'time' => $deadline->format('H:i')
            ]);
            //dd($component->deadline);
        } else {
            $deadline = null;
        }
        $allAssignments= UserAssigment::where([['component_id', $id], ['rated', 0]])->orderBy('updated_at')->with(['user', 'component'])->get();
        //dd($allAssignments);
        if(isset($assignments->notification) && $assignments->notification == true) {
            $assignments->notification = false;
            $assignments->save();
        }
        return view('dashboard.component', compact('component', 'assignments', 'deadline', 'today', 'allAssignments'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function retrieveUploadUser($id)
    {
        return UserAssigment::where([['user_id', Auth::user()->id], ['component_id', $id]])->first(); // check if row exist
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request)
    {
        dd($request->all());
        $file = "../storage/app/upload/component/" . $request->component_id . "/" . $request->file;
        return response()->download($file);
    }

    public static function checkDeadline($component)
    {
        $deadline = strtotime($component->deadline);
        $curDate = strtotime(Date::now());

        if($curDate < $deadline || !$deadline || $component->disabled == 0){
            return true;
        }
        return false;
    }

    public function upload(Request $request)
    {
        $component_id = $request->componentId; // get component id

        $component = Component::find($component_id);
        $deadline = self::checkDeadline($component);
        //Check if deadline has passed
        //Not yet passed: upload file
        //dd($deadline);
        if($deadline) {
            $file = $request->file('fassigment'); // get file

            $uploaded_user = self::retrieveUploadUser($component_id);

            $request->validate(UserAssigment::$rules);
            // upload file to path
            if ($request->hasFile('fassigment')) {
                $uploaded = Data::uploadFile($file, 'upload/component/' . $component_id);

                try {
                    $message = "Succes";
                    if ($uploaded['success']) {
                        $fileName = $uploaded['name']; // filename to save into database

                        // replace uploaded file when user already uploaded before (Deprecated)
                        // New: if user has already uploaded, add new file to folder
                        if (!empty($uploaded_user)) {
                            $uploaded_user->file2 = $fileName;
                            if ($uploaded_user->rated !== 2) {
                                $uploaded_user->rated = 0;
                            }

                            $uploaded_user->save();

                        } else {
                            // upload new file database to new assigment
                            $fields = [
                                'user_id' => Auth::user()->id,
                                'component_id' => $component_id,
                                'file1' => $fileName,
                                'rated' => 0
                            ];

                            UserAssigment::create($fields); // insert new row
                        }
                    }
                } //if uploading fails or database update fails delete file to prevent unnecessary files
                catch (Exception $e) {
                    $message = $e;

                    $pathToFile = 'app/upload/component/' . $component_id . '/' . $file;
                    unlink(storage_path($pathToFile)); // delete existing file
                }
            }

            //$message:
            //Add message succes/failure
            return \Redirect::back()->with('status', 'Bestand geupload');
        }
        //Passed: return message
        else{

            return \Redirect::back()->with('danger', 'Deadline is voorbij! Inleverpunt gesloten.');
            //Return message, deadline has passed

        }
    }

    /**
     * create function get user upload data
     * @return $data
     * */
    public static function retrieveData($id)
    {
        $data = false;
        $class = '';
        $upload_user = self::retrieveUploadUser($id);
        // fetch data if user exist
        if($upload_user){
            $data = [
                'exist' => true,
                'file' => $upload_user->file,
                'upload_count' => $upload_user->upload_count,
                'status' => $upload_user->status,
                'rated' => $upload_user->rated,
                'checked' => $upload_user->checked,
                'class' => $class
            ];
        }
        return $data;
    }


}
