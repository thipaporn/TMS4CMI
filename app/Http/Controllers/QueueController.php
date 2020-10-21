<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QueueController extends Controller
{
    public function showQueue(){
        $drivers = DB::table('driver')->get();
        return view('queue-management/output',['drivers' => $drivers]);
    }

    public function preQueue(){

    }
}
