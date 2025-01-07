<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Ozzie\Vino\Page;

Page::name('password.request');

$submit = function (Request $request) {
    $request->validate(['email' => 'required|email']);

    Password::sendResetLink(
        $request->only('email')
    );

    return ['ok' => true];
};
