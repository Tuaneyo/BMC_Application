<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\User;
use App\Notifications\DeadlineNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Jenssegers\Date\Date;

class ComponentController extends Controller
{
    public function index()
    {
        $acomponent = collect();
        $component = Component::orderBy('id')->with('assignment')->get();
        foreach ($component as $key => $c){
            $bool = $c->assignment()->where([['user_id', Auth::user()->id], ['rated', '=', 2]])->first();
            if($bool) $bool = true;
            $acomponent->push(['id' => $c->id, 'finished' => $bool]);
        }

        return view('dashboard.components.index', compact( 'acomponent'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function setDate(Request $request){

        if(Auth::user()->hasRole(['administrator', 'docent'])){
            // set default date now if no date is set
            if(empty($request->date)) $request->date = Date::now();
            $component = Component::where('id', '=', $request->component_id)->first();
            $component->deadline = $request->date;
            $component->disabled = $request->disabled;
            $component->save();
            $users = User::role('student')->get();
            Notification::send($users, new DeadlineNotify(Auth::user(), $component));
            return \Redirect::back()->with('status', "Deadline is bepaald");
        }
        return \Redirect::back()->with('danger', "Niet toegestaan om de deadline te bepalen");

    }
}
