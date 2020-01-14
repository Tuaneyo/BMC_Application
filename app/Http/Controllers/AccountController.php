<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\User;
use App\Models\UserAssigment;
use App\Notifications\RatedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all unanswered files
        $assignments = UserAssigment::where(function ($q) {
            $q->where('file1', '!=', '')
                ->orWhere('file2', '!=', '');
        })
            ->where('rated', '==', 0)->orderbyDesc('updated_at')->get();

        $assignments->join('users', 'users.id', '=', 'user_id');

        $finishedAssignments = UserAssigment::where('rated', '!=', 0)->get();
        $user = User::where('id', Auth::user()->id)->first();

        return view('account.index', compact('user', 'assignments', 'finishedAssignments'));
    }


    public function changeRating(Request $request)
    {

        //print_r($request->all());
        print($request->input('rated'));
        $assignment = UserAssigment::find($request->input('id'));
        $assignment->rated = $request->input('rated');
        $assignment->notification = true;
        $assignment->save();

        $assignment->user->notify(new RatedUser($assignment, Auth::user(), $assignment->Component));

        return \Redirect::back()->with('status', 'Student is beoordeeld');
    }

    public function showProfile($id)
    {

        $user = User::where('id', $id)->first();
        $acomponent = collect();
        $component = Component::orderBy('id')->with('assignment')->get();
        foreach ($component as $key => $c){
            $assignment = $c->assignment()->where([['user_id', $id], ['rated', '=', 2]])->first();
            if(isset($assignment))  $bool = true;
            else $bool = false;
            $acomponent->push(['id' => $c->id, 'finished' => $bool]);
        }
        $assignments = UserAssigment::where([['user_id', $id], ['rated', '=', 2]])
            ->orWhere([['user_id', $id], ['rated', '=', 1]])
            ->with('component')->orderBy('updated_at')->get();

        $allAssign = UserAssigment::where('user_id', $id)->get();
        $unrated = UserAssigment::where([['user_id', $user->id],['rated', 0]])->with('component')->get();
        $list = self::getTopUsers();

        return view('dashboard.account.index', compact('user', 'acomponent', 'assignments', 'component', 'list', 'unrated', 'allAssign'));
    }

    public static function getTopUsers()
    {
        $userList = UserAssigment::groupby('user_id')->where('rated', '=', 2)->get();
        $list = collect();
        foreach ($userList as $user) {
            $components = UserAssigment::where('user_id', '=', $user->user_id)->where('rated', '=', 2)->orderBy('component_id')->get();

            $total = 0;

            foreach ($components as $component) {

                switch ($component->component_id) {
                    case 4:     //Waardepropositie
                        $total += 15;
                        break;
                    case 7:     //Klantsegment
                        $total += 15;
                        break;
                    default:    //Anders
                        $total += 10;
                        break;
                }
            }
            $userl = User::find($user->user_id);
            if($userl)
                $list->push(['user' => $userl, 'total' => $total]);
        }
        //dd($list->reverse());
        $list = $list->sortByDesc('total');
        $list = $list->values()->all();
        return $list;
    }

    public function editProfile($id)
    {
        $user = User::find($id);
        if($user->id === Auth::user()->id){
            return view('dashboard.account.edit', compact('user'));
        }

        return redirect('profile/' . $user->id);

    }

    public function changeProfileImg(Request $request)
    {
        try {
            $user = self::getUser($request->id);

            //join user and file and use as argument for changeProfilePicture

            if (!empty($request->upload)) {
                //Upload avatar

                $request->validate([
                    'upload' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                ]);

                $name = $user->name;
                if (preg_match('/\s/', $request->name)) {
                    $name = str_replace(' ', '_', $request->name);
                    $name = strtolower($name);
                }
                $filename = $name . '.' . $request->file('upload')->extension();

                $user->file = $filename;
                $request->file('upload')->storeAs($user->id, $filename, 'avatar');
            }


            $user->save();
            return redirect()->back()->with('status', 'Profiel foto is gewijzigd');
        }
        catch(Exception $e){
            return redirect()->back()->with('status', 'Er is iets fout gegaan'.$e->getMessage().'');
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function getUser($user)
    {
        $dUser = Crypt::decryptString($user);
        $user = User::find($dUser);
        return $user;
    }


    public function editAbout(Request $request)
    {
        try {
            $user = self::getUser($request->id);

            //join user and file and use as argument for changeProfilePicture

            if (!empty($request->cabout)) {
                //Upload avatar
                $request->validate([
                    'cabout' => 'required|string|min:3|max:400',
                ]);

                $user->cabout = $request->cabout;
                $user->save();
                return redirect()->back()->with('status', 'Wijziging is succesvol');
            }
            return redirect()->back()->with('danger', 'Mag niet langer zijn dan 400 karakters');
        }
        catch(Exception $e){
            return redirect()->back()->with('status', 'Er is iets fout gegaan'.$e->getMessage().'');
        }
    }

    public function editAccount(Request $request)
    {
        try {
            $user = self::getUser($request->id);

            //edit user data

            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'st_number' => 'required',
            ]);

            //If there is a name change
            if($user->name != $request->name){
                //change name (obviously)
                $user->name = $request->name;

                //change file name
                if(!empty($user->file)){
                    $oldfile = $user->id.'/'.$user->file;
                    $ext = pathinfo($oldfile, PATHINFO_EXTENSION);
                    $newfile = $user->id.'/'.$user->name.'.'.$ext;

                    rename('uploads/avatar/'.$oldfile, 'uploads/avatar/'.$newfile);
                    $user->file = $user->name.'.'.$ext;
                }

            }

            $user->update($request->all());
            return redirect()->back()->with('status', 'Account gegevens zijn gewijzigd');

        }
        catch(Exception $e){
            return redirect()->back()->with('status', 'Er is iets fout gegaan'.$e->getMessage().'');
        }
    }

}
