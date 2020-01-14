<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Authenticate constructor.
     * @param Factory $auth
     */
    public function __construct(Factory $auth)
    {
        parent::__construct($auth);

        //$this->retrieveAmountOfNotifications();
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Sends amount of notifications to the view
     */
    public function retrieveAmountOfNotifications()
    {
        if(Auth::check())
        {
            $amount = \App\Models\Notification::where('check', 0)->count();
            view()->share('number', $amount);
        }
    }
}
