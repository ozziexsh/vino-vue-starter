<?php

use Illuminate\Http\Request;
use Ozzie\Vino\Page;

Page::name('profile');

$submit = function(Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
    ]);

    auth()->user()->update($data);

    return ['ok' => true];
};

$resetPassword = function(Request $request) {
    $data = $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed',
    ]);

    if (!Hash::check($data['current_password'], auth()->user()->password)) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'current_password' => 'The current password is incorrect',
        ]);
    }

    auth()->user()->update([
        'password' => bcrypt($data['password']),
    ]);

    return ['ok' => true];
};
