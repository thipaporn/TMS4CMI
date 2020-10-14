<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function bill(){
        $bills = DB::table('bill')->get();
        //return view('bill/view',['bills' => $bills]);
    }
}
