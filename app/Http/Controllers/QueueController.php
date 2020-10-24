<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QueueController extends Controller
{
    public function showQueue(){
        $pre = DB::table('pre_schedule')->orderBy('startDate', 'ASC')->get();
        $driver = DB::table('driver')->selectRaw('id,name,number,type')
        ->Join('car','driver.id','=','car.driver_id')->get();

        $firstDay = date('Y-m-01', strtotime('now'));
        $lastDay = date('Y-m-t', strtotime('now'));

        $schedule = DB::table('driver_schedule')
        ->where( 'startDate','>=',$firstDay)->where( 'startDate','<=',$lastDay)->get();

        $sumDist = DB::table('driver_schedule')->selectRaw('id,sum(dist) as dist')
        ->where( 'startDate','>=',$firstDay)->where( 'startDate','<=',$lastDay)
        ->groupBY('id')->get();

        $dist = DB::table('prov_dist')->get();

        return view('queue-management/output',['driver' => $driver, 'pre' => $pre, 'schedule'=>$schedule,'sumDist'=>$sumDist, 'dist'=>$dist]);
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
        $pre = DB::table('pre_schedule')->orderBy('startDate', 'ASC')->get();
        $driver = DB::table('driver')->selectRaw('id,name,number,type')
        ->Join('car','driver.id','=','car.driver_id')->get();

        $firstDay = date('Y-m-01', strtotime($date));
        $lastDay = date('Y-m-t', strtotime($date));

        $schedule = DB::table('driver_schedule')
        ->where( 'startDate','>=',$firstDay)->where( 'startDate','<=',$lastDay)->get();

        $sumDist = DB::table('driver_schedule')->selectRaw('id,sum(dist) as dist')
        ->where( 'startDate','>=',$firstDay)->where( 'startDate','<=',$lastDay)
        ->groupBY('id')->get();

        $dist = DB::table('prov_dist')->get();

        return view('queue-management/output',['driver' => $driver, 'pre' => $pre, 'schedule'=>$schedule,'sumDist'=>$sumDist, 'dist'=>$dist]);
    }

    // public function show(){
    //     $scheds = DB::table('pre_schedule')::all()->get();
    //     return view('queue-management/output',['scheds' => $scheds]);
    // }
}
