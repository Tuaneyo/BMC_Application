<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAssigment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AssignmentDescription;

class AdminController extends Controller
{


    public function index()
    {
        //Get all unanswered files
        $assignments = UserAssigment::where(function($q) {
            $q->where('file1', '!=', '')
                ->orWhere('file2','!=', '');})
            ->where('rated', '==', 0)->orderbyDesc('updated_at')->with('user')->with('component')->get();


        $finishedAssignments = UserAssigment::where('rated', '!=', 0)->get();
        //dd($assignments);
        $userID = Auth::user()->id;
        $user = User::where('id', $userID)->first();
        return view('admin.assignments.index', compact('user', 'assignments', 'finishedAssignments'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rateUser($id)
    {
        $userAssigment = UserAssigment::where('id', '=', $id)->with(['user', 'component'])->first();
        //dd($userAssigment->id);
        $allAssignments = UserAssigment::where([['user_id', $userAssigment->user_id],['id','<>',$userAssigment->id] ])
            ->with('component')->orderBy('rated')->get();
        //dd($allAssignments);
        $user = $userAssigment->user;
        $component = $userAssigment->component;
        //dd($component->name);
        return view('admin.assignments.rating', compact('userAssigment', 'user', 'component', 'allAssignments'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function giveFeedback(Request $request)
    {
        $userAssigment = UserAssigment::where('id', '=', $request->id)->first();
        //dd($userAssigment);
        $feedback = $request->feedback;
        if(!empty($feedback)){
            $userAssigment->feedback = $feedback;
            $userAssigment->save();
            return \Redirect::back()->with('status', 'Feedback is toegevoegd');
        }

        return \Redirect::back()->with('danger', 'Feedback box mag niet leeg zijn');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function addAssignment(Request $request)
    {
        if($request->ajax()){
            $user = Auth::user()->hasRole('administrator', 'docent');
            if($user) {
                $request->validate(AssignmentDescription::$rules);
                $created = AssignmentDescription::create($request->all());
                if ($created) {
                    $desciption = $request->description;
                    return $desciption;
                }
            }
        }
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function deleteAssignment(Request $request)
    {
        if($request->ajax()){

            $deleted = AssignmentDescription::destroy($request->adid);
            if($deleted) return true;
            else return false;
        }
    }
}
