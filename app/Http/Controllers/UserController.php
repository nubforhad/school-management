<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class UserController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('welcome', compact('settings'));
    }
}
