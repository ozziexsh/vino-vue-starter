<?php

use Illuminate\Http\Request;
use Ozzie\Vino\Page;

Page::name('login');

$submit = function(Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!auth()->attempt($data)) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    return redirect()->intended('/home');
};
