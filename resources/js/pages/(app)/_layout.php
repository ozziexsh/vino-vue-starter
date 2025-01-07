<?php

use Ozzie\Vino\Page;

Page::middleware(['auth']);

$logout = function() {
    auth()->logout();

    return redirect()->route('login');
};

$user = auth()->user();
