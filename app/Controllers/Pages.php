<?php namespace App\Controllers;

Class Pages extends BaseController
{
    public function loginForm(): string
    {
        return view('page/login');
    }

    public function registerForm(): string
    {
        return view('page/register');
    }
}