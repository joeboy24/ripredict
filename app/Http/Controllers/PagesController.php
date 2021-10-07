<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Customer;
use App\Models\Remarks;
use App\Models\Technical;
use App\Models\ProfitData;
use Session;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    } 

    // 
    public function index(){
        // return Session::get('ics');
        // Session::put('entry_id', 1);
        // Session::put('ics', 1);
        // Session::put('vr', 1);
        // Session::put('lb', 1);
        // Session::put('icf', 1);
        // Session::put('iln', 1);
        // Session::put('icr', 1);
        // Session::put('ld', 1);
        // Session::put('dw', 1);
        // Session::put('bias', 1);
        // Session::put('kscale', 1);
        // Session::put('profit', 1);
        // Session::put('entries', 1);
        // return view('pages.register2');
        return redirect('/input');
    }

    public function predict2(){
        // Session::put('ics', '');
        // return Session::get('ics');
        $pd_count = ProfitData::all()->count();
        $where = [
            'del' => 'no',
            'compare' => 'yes'
        ];

        if ($pd_count < 1) {
            return view('pages.input');
        } else {
            # code...
            // if (Session::get('ics') != '') {
            //     return view('pages.predict');
            // }else{
                $PD = ProfitData::where($where)->orderBy('ics', 'DESC')->get();
                $max = 0;
                foreach ($PD as $val) {
                    if ($val->ics > $max) {
                        $max = $val->ics;
                    }
                }
                // return $max;
                $max2 = $max + ($max / 10);
                $entries = ProfitData::latest()->first();
                $entries_all = ProfitData::where($where)->orderBy('id', 'DESC')->limit(4)->get();
                $pass = [
                    'i' => 1,
                    'c' => 1,
                    'max' => $max2,
                    'entries' => $entries,
                    'entries_all' => $entries_all
                ];
                // $result = (100 * $entries_all->ics) / $max2;
                // return $result;
                return view('pages.predict')->with($pass);
            // }
        }
    }

    public function input(){
        return view('pages.input');
    }

    public function compare(){
        $entries = ProfitData::where('del', 'no')->orderBy('id', 'DESC')->paginate(10);
        $pass = [
            'entries' => $entries
        ];
        return view('pages.compare')->with($pass);
    }

    public function personal(){
        // $data_search = Personal::where('customer_id', 'CT4648V12J2')->first();
        // return $data_search->id;
        $xter = substr(str_shuffle(str_repeat("0123456789A1B2C3D4E5F6G7H8I9J0K9L8M7N6O5P4Q3R2S1T2U3V4W5X6Y7Z8", 5)), 0, 5);
        $time = date('is');
        $cust_id = 'CT'.$time.$xter;
        Session::put('cust_id', $cust_id);
        return view('pages.personal_data');
    }

    public function customer(){
        $cust_id2 = Session::get('cust_id2');
        if($cust_id2 == ''){
            return redirect('/');
        }
        return view('pages.customer_data');
    }

    public function technical(){
        $cust_id2 = Session::get('cust_id2');
        if($cust_id2 == ''){
            return redirect('/');
        }
        return view('pages.tech_data');
    }

    public function recc(){
        $cust_id2 = Session::get('cust_id2');
        if($cust_id2 == ''){
            return redirect('/');
        }
        return view('pages.recc');
    }

    public function remarks(){
        $cust_id2 = Session::get('cust_id2');
        if($cust_id2 == ''){
            return redirect('/');
        }
        return view('pages.remarks');
    }

    public function database(){
        $personal = Personal::where('del', 'no')->orderBy('id', 'DESC')->paginate(10);
        $pass = [
            'c' => 1,
            'personal' => $personal
        ];
        return view('pages.data_view')->with($pass);
    }
}
