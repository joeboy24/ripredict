<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfitData;
use Session;

class ComputationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //    
        // return 'none';
        $where = [
            'del' => 'no',
            'compare' => 'yes'
        ];
        $PD = ProfitData::where($where)->orderBy('ics', 'DESC')->get();
        // return $PD;
        if(empty($PD)){
            return redirect(url()->previous());
        }
        $max = 0;
        // if($PD){
            foreach ($PD as $val) {
                if ($val->ics > $max) {
                    $max = $val->ics;
                }
            }
            // return $max;
            $max2 = $max + ($max / 10);
        // }else{
        //     $max2 = '';
        // }
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            switch ($request->input('store_action')) {

                case 'compute':
                    $xter = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4)), 0, 4);
                    $time = date('is');
                    $entry_id = 'M'.$xter.$time;

                    $ics = $request->input('ics');
                    $vr = $request->input('vr');
                    $lb = $request->input('lb');
                    $icf = $request->input('icf');
                    $iln = $request->input('iln');
                    $icr = $request->input('icr');
                    $ld = $request->input('ld');
                    $dw = $request->input('dw');
                    $exp = $request->input('exp');
                    $obs = $request->input('obs');
                    $bias = -0.00207;
                    $kscale = 172803.4;

                    try {
                        //code...
                        $ics2 = $ics * 24498.22;
                        $vr2 = $vr * 24798.70;
                        $lb2 = -13186.93 * $lb; 
                        $icf2 = -1300.02 * $icf;
                        $iln2 = -2351.68 * $iln;
                        $icr2 = -375.22 * $icr;
                        $ld2 = -1658.56 * $ld;
                        $dw2 = -1740.18 * $dw;
                        $exp2 = ($exp / 100) * $ics;
                        $obs2 = ((100 - $obs) / 100) * $exp2;

                        $profit = (1 / $kscale) * ($ics2 + $vr2 + $lb2 + $icf2 + $iln2 + $icr2 + $ld2 + $dw2 + $bias);
                        // return $profit.' / '.$exp2.' / '.$obs2;

                        $where = [
                            'del' => 'no',
                            'compare' => 'yes'
                        ];
                        // $PD = ProfitData::where($where)->orderBy('ics', 'DESC')->get();
                        // $max = 0;
                        // foreach ($PD as $val) {
                        //     if ($val->ics > $max) {
                        //         $max = $val->ics;
                        //     }
                        // }
                        // // return $max;
                        // $max2 = $max + ($max / 10);
                        // $entries_all = ProfitData::where($where)->orderBy('id', 'DESC')->limit(4)->get();
                        // $entries = ProfitData::latest()->first();
                        // Session::put('entry_id', $entry_id);
                        // Session::put('ics', $ics);
                        // Session::put('vr', $vr);
                        // Session::put('lb', $lb);
                        // Session::put('icf', $icf);
                        // Session::put('iln', $iln);
                        // Session::put('icr', $icr);
                        // Session::put('ld', $ld);
                        // Session::put('dw', $dw);
                        // Session::put('bias', $bias);
                        // Session::put('kscale', $kscale);
                        // Session::put('profit', $profit);
                        // Session::put('entries', $entries);

                        $uid = auth()->user()->id;
                        $use_times = auth()->user()->use_times;
                        if($use_times == ''){
                            $user = User::find($uid);
                            $user->use_times = 1;
                            $user->save();
                        }else{
                            $user = User::find($uid);
                            $user->use_times = $use_times + 1;
                            $user->save();
                        }

                        $pfd = ProfitData::firstOrCreate([
                            'user_id' => auth()->user()->id,
                            'ics' => $ics,
                            'vr' => $vr,
                            'lb' => $lb,
                            'icf' => $icf,
                            'iln' => $iln,
                            'icr' => $icr,
                            'ld' => $ld,
                            'dw' => $dw,
                            'exp' => $exp,
                            'obs' => $obs,
                            'bias' => $bias,
                            'kscale' => $kscale,
                            'profit' => $profit,
                        ]);
                    } catch (\Throwable $th) {
                        return redirect(url()->previous())->with('error', 'Oops..! Text field requires only numbers.');
                    }

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
                    
                    // return $entries->id;
                    $pass = [
                        'i' => 1,
                        'c' => 1,
                        'max' => $max2,
                        'profit' => $profit,
                        'entries' => $entries,
                        'entries_all' => $entries_all
                    ];

                    // return $profit;
                    return view('pages.predict')->with($pass);
    
                break;

                case 'save_customer':

                    // Save Customer Data
                    $cust_id2 = Session::get('cust_id2');

                    $service_type = $request->input('service_type');
                    if($service_type == '-- Choose Type --'){
                        return redirect(url()->previous())->with('error', 'Choose Type of Service');
                    }

                    $customer = Customer::firstOrCreate([
                        'user_id' => 1,
                        'personal_id' => $cust_id2,
                        'acc_no' => $request->input('acc_no'),
                        'spn' => $request->input('spn'),
                        'geocode' => $request->input('geocode'),
                        'structure_id' => $request->input('structure_id'),
                        'service_type' => $service_type,
                    ]);

                    return redirect('/technical')->with('success', 'Customer data successfully saved');
    
                break;

            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {

            switch ($request->input('update_action')) {

                case 'up_compare':
                    $up = ProfitData::find($id);
                    if ($up->compare == 'yes') {
                        # code...
                        $up->compare = 'no';
                    }else{
                        $up->compare = 'yes';
                    }
                    $up->save();
                    // return redirect('/predict');
                    return redirect(url()->previous());
                    // return 'Works!..';
                break;

                case 'compare_del':
                    $up = ProfitData::find($id);
                    $up->del = 'yes';
                    $up->save();
                    return redirect(url()->previous());
                    // return 'Works!..';
                break;

                }
        } catch (\Throwable $th){
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
