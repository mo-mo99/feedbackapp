<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function admin()
    {
        return view('adminpanel');
    }

    public function feedback()
    {
        return view('feedback');
    }
}
