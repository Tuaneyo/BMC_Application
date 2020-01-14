<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id = Auth::user()->id;
        $done = $this->retrieveDone($id);
        $users = User::role('student')->where('email_verified_at', '<>', null)->orderBy('name')->get();
        $mentors = User::role('docent')->orderBy('name')->get();
        return view('dashboard.progress', compact('done', 'users', 'mentors'));
    }

    public function getUser(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            //first(['name', 'email'])
            $data = [];
            $user = User::where('id', $id)->first();
            $data['perc'] = $user->assignmentPercentile($id);
            $data['doneInt'] = $user->getCountCompletedAssignments($id);
            $data['user'] = $user;
            return $data;
        }
    }

    public function retrieveDone()
    {
        return Auth::user()->assignments->where('rated', '=', 2);
    }
}
