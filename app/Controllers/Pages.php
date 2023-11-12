<?php namespace App\Controllers;

Class Pages extends BaseController
{
    public function loginForm(): string
    {
        return view('/pages/login');
    }

    public function registerForm(): string
    {
        return view('pages/register');
    }
}