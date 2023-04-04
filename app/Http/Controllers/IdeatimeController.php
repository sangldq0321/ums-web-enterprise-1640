<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdeatimeController extends Controller
{
    public function IdeaTime() {
        return view('ideatimes.ideatime-index');
    }
}
