<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
        $location = $_POST['location'];
        $date = $_POST['date'];
        $countBill = count($_POST["name"]);
        for ($i = 0; $i <= $countBill; $i++) {
            if (isset($_POST["name"][$i])) {
                $name = $_POST["name"][$i];
                $number = $_POST["number"][$i];
                DB::table('bill')->insert(
                    [
                        'trackNumber' => $number,
                        'name' => $name,
                        'dest' => $location
                    ]
                );
                DB::table('pre_schedule')->insert(
                    [
                        'type' => $type,
                        'dest' => $location,
                        'startDate' => $date,
                        'trackNumber' => $number
                    ]
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

    public function showStatus()
    {
        $orders = DB::table('driver_schedule')
            ->join('update_status', 'driver_schedule.trackNumber', '=', 'update_status.trackNumber')
            ->groupBy('driver_schedule.trackNumber')
            ->orderBy('updateDate', 'DESC')
            ->get(); 
        $status = DB::select('SELECT t1.trackNumber, t1.status, t1.updateDate
        FROM update_status t1,( SELECT trackNumber, status,MAX(updateDate) as lastDate 
                                  FROM update_status
                                  GROUP by trackNumber) t2
        WHERE t1.trackNumber = t2.trackNumber AND t1.updateDate = t2.lastDate');

        //print_r($status);
        return view('home',['orders' => $orders, 'status' => $status]);
    }

    public function addQueue()
    {
        $count = count($_POST['id']);
        for ($i = 0; $i < $count; $i++){
            $id = $_POST['id'][$i];
            $name = $_POST['name'][$i];
            $type = $_POST['type'][$i];
            $carNumber = $_POST['carNumber'][$i];
            $dest = $_POST['dest'][$i];
            $trackNumber = $_POST['trackNumber'][$i];
            $startDate = $_POST['startDate'][$i];
            $dist = $_POST['dist'][$i];
            $status = 'รับออเดอร์เข้าระบบ';
            if (isset($_POST["id"][$i])) {
                DB::table('driver_schedule')->insert(
                    [
                        'id' => $id,
                        'name' => $name,
                        'type' => $type,
                        'carNumber' => $carNumber,
                        'dest' => $dest,
                        'trackNumber' => $trackNumber,
                        'startDate' => $startDate,
                        'endDate' => $startDate,
                        'dist' => $dist
                    ]
                );
                DB::table('update_status')->insert(
                    [
                        'trackNumber' => $trackNumber,
                        'status' => $status,
                        'updateDate' => now(),
                    ]
                );
                DB::delete('DELETE FROM pre_schedule');
            }
        }

        $orders = DB::table('driver_schedule')
            ->join('update_status', 'driver_schedule.trackNumber', '=', 'update_status.trackNumber')
            ->groupBy('driver_schedule.trackNumber')
            ->orderBy('updateDate', 'DESC')
            ->get(); 
        $status = DB::select('SELECT t1.trackNumber, t1.status, t1.updateDate
        FROM update_status t1,( SELECT trackNumber, status,MAX(updateDate) as lastDate 
                                  FROM update_status
                                  GROUP by trackNumber) t2
        WHERE t1.trackNumber = t2.trackNumber AND t1.updateDate = t2.lastDate');

        return view('home',['orders' => $orders, 'status' => $status]);
    }
}
