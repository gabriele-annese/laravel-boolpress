<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){

        //carbon
        $dt = Carbon::now();
        dump($dt->isoFormat('dddd DD/MM/YYYY'));
        dump( $dt->locale() );
        

        return view('admin.home');
    }
}
