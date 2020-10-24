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

    public function readQR(request $request){
        $billNum = $request->Input('bill');
        $bill = DB::table('update_status')
            ->where(['trackNumber'=>$billNum])
            ->orderBy('updateDate', 'DESC')->take(1)->get();
        $name = DB::table('bill')
            ->where(['trackNumber'=>$billNum])->get();
        return view('read-QRcode/readQR',['bill' => $bill, 'name' => $name]);
    }

    public function update(request $request){
        $billNum = $request->input('billNum');
        $bill = DB::table('update_status')
            ->where(['trackNumber'=>$billNum])
            ->orderBy('updateDate', 'DESC')->take(1)->get();
        $name = DB::table('bill');
        $billStatus = DB::table('update_status')
            ->where(['trackNumber'=>$billNum])
            ->orderBy('updateDate', 'DESC')->take(1)
            ->value('status');
        if($billStatus == 'รับออเดอร์เข้าระบบ'){
            $billStatus = 'กำลังจัดเตรียมสินค้า';
        }elseif($billStatus == 'กำลังจัดเตรียมสินค้า'){
            $billStatus = 'อยู่ในระหว่างการขนส่ง';
        }elseif($billStatus == 'อยู่ในระหว่างการขนส่ง'){
            $billStatus = 'จัดส่งสินค้าเรียบร้อยแล้ว';
        }else{
            $billStatus = 'ERROR';
        }
        DB::table('update_status')->insert(
            ['trackNumber' => $billNum,
            'status' => $billStatus,
            'updateDate' => now()]
        );
        return redirect()->back();
    }
}
