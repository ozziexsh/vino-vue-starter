<?php

use Illuminate\Http\Request;
use Ozzie\Vino\Page;
use App\Models\User;

Page::name('register');

$submit = function(Request $request) {
    $data = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',
    ]);

    $data['password'] = bcrypt($data['password']);

    auth()->login($user = User::create($data));

    return redirect()->intended('/home');
};
