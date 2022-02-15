<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendWelcomeEmail;

class HomeController extends Controller
{
    public function index(){

        //email
        Mail::to(Auth::user()->email)->send(new SendWelcomeEmail(Auth::user()->name));

        //carbon
        $dt = Carbon::now();
        // dump($dt->isoFormat('dddd DD/MM/YYYY'));
        // dump( $dt->locale() );
        

        return view('admin.home');
    }
}
