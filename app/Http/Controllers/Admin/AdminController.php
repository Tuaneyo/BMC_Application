<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AssignmentDescription;
use App\Models\Component;
use App\Models\User;
use App\Models\UserAssigment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


/**
 * Generic administration operations.
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
    /**
     * Show users rating table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rate()
    {
        //Get all unanswered files
        $assignments = UserAssigment::where(function($q) {
            $q->where('file1', '!=', '')
                ->orWhere('file2','!=', '');})
            ->where('rated', '==', 0)->orderby('updated_at')->with('user')->with('component')->get();


        $userID = Auth::user()->id;
        $user = User::where('id', $userID)->first();
        return view('admin.assignments.users', compact('user', 'assignments'));
    }

    /**
     * Show rated table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rated()
    {
        $rated = UserAssigment::where('rated', '<>', 0)->get();
        return view('admin.assignments.rated', compact('rated'));
    }

    /**
     * Show dashboard
     */
    public function index()
    {
        // trait to get top students
        $arr = ['0','25', '50'];
        $user = User::all();
        $students = User::role('student')->count();
        $teachers = User::role('docent')->count();
        $assignments = UserAssigment::all();
        $uploaded = UserAssigment::orderBy('updated_at')->where('rated', 0)->get()->take(3);
        $rated = UserAssigment::where('rated', 1)->orWhere('rated', 2);
        $showRated = $rated->orderby('updated_at', 'desc')->get()->take(3);
        $topUser = $this->getTopUsers();
        return view('admin.assignments.index', compact('arr','students', 'teachers', 'assignments', 'rated', 'uploaded', 'showRated', 'topUser'));
    }

    /**
     * Get list of all top students
     * @return \Illuminate\Support\Collection
     */
    public function getTopUsers()
    {
        $component = Component::orderBy('id')->with('assignment')->get();
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
        $list = $list->sortByDesc('total');
        $list = $list->values()->all();
        return $list;
    }

    public function rateUser($id)
    {
        $userAssigment = UserAssigment::where('id', '=', $id)->with(['user', 'component'])->first();
        //dd($userAssigment->id);
        $allAssignments = UserAssigment::where([['user_id', $userAssigment->user_id],['id','<>',$userAssigment->id] ])
            ->with('component')->orderBy('rated')->get();
        //dd($allAssignments);
        $user = $userAssigment->user;
        $component = $userAssigment->component;

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
            $request->validate(AssignmentDescription::$rules);
            $assignment = AssignmentDescription::create($request->all());
            if($assignment){
                return $assignment;
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
            if($deleted) return 'true';
            else return 'false';
        }
    }
}
