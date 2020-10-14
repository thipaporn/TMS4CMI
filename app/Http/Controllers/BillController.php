<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function bill(){
        $bills = DB::table('bill')->get();
        return view('code-generator/input',['bills' => $bills]);
    }

    public function billView(request $request){
        $billNum = $_POST['bill'];
        $bill = DB::table('bill')->where(['trackNumber'=>$billNum])->get();
        return view('code-generator/output',['bill' => $bill]);
    }
}
