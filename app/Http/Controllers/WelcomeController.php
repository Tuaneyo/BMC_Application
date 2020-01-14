<?php

namespace App\Http\Controllers;

use App\Models;
use App\Models\UserAssigment;
use App\Models\Component;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
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
        //dd($acomponent[0]['finished']);
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
            $userl = Models\User::find($user->user_id);
            if($userl)
                $list->push(['user' => $userl, 'total' => $total]);
        }
        //dd($list->reverse());
        $list = $list->sortByDesc('total');
        $list = $list->values()->all();
        $uploaded = self::getUploaded();
        return view('welcome', compact('list', 'acomponent', 'uploaded'));
    }

    public static function getUploaded()
    {

        $uploaded = count(UserAssigment::where('user_id', Auth::user()->id)->get());
        return $uploaded;
    }

    public static function sortByTotal(&$arr, $col, $dir = SORT_DESC)
    {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);

    }
}
