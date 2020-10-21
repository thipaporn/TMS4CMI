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

    public function preQueue(request $request){
        $type = $_POST['type'];
        $location =$_POST['location'];
        $date = $_POST['date'];
        $countBill = count($_POST["name"]);
        for($i = 0; $i <= $countBill; $i++){
            if(isset($_POST["name"][$i])){
                $name = $_POST["name"][$i];
                $number = $_POST["number"][$i];
                DB::table('bill')->insert(
                    ['trackNumber' => $number,
                    'name' => $name,
                    'dest' => $location]
                );
                DB::table('pre_schedule')->insert(
                    ['type' => $type,
                    'dest' => $location,
                    'startDate' => $date,
                    'trackNumber' => $number]
                );
            }
        }
        return view('queue-management/output',['countBill' => $countBill, 'type' => $type, 'location' => $location, 'date' => $date ]);
    }
}
