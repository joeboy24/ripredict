@extends('layouts.app')

@section('nav2')
    <div class="nav2">
        <a href="/input"><button type="button" class="menu_btn btn_focus">INPUT</button></a>
        <a href="/predict"><button type="button" class="menu_btn">PREDICT</button></a>
        <a href="/compare"><button type="button" class="menu_btn">COMPARE</button></a>
    </div>
@endsection
 
@section('content')

  <div style="height: 20px"></div>
    
  <div class="col-sm-8 col-sm-offset-2 myCol">
      @include('inc.messages')
      <div class="welcome_msg">
        <p class="p1">Welcome <span>Use Times</span></p>
        <p class="p2">Mr. {{ auth()->user()->name }} <span>{{ auth()->user()->use_times }}</span></p>
    </div>

      <form action="{{ action('ComputationsController@store') }}" method="POST">
        @csrf

        {{-- <div class="input_tf_contii">
          <p class="input_lbl pull-left">Ics - Initial Contract Sum</p> --}}
          <div class="row" style="margin: 0; padding: 0">
            <div class="col-md-6" style="margin: 0; padding: 0">
              <p class="input_lbl pull-left">Ics - Initial Contract Sum</p>
              <input type="number" step="any" class="input_tf" name="ics" placeholder="Ics - Initial Contract Sum" required/>
              <p class="input_lbl pull-left">Vr - Variation</p>
              <input type="number" step="any" class="input_tf" name="vr" placeholder="Vr - Variation" required/>
              <p class="input_lbl pull-left">Lb - Labour</p>
              <input type="number" step="any" class="input_tf" name="lb" placeholder="Lb - Labour" required/>
              <p class="input_lbl pull-left">Mcf - Markup Contractor Finance</p>
              <input type="number" step="any" class="input_tf" name="icf" placeholder="Mcf - Markup Contractor Finance" required/>
              <p class="input_lbl pull-left">ILn - Interest on Loan</p>
              <input type="number" step="any" class="input_tf" name="iln" placeholder="ILn - Interest on Loan" />
            </div>
            <div class="col-md-6" style="margin: 0; padding: 0">
              <p class="input_lbl pull-left">Mcr - Markup on Credit</p>
              <input type="number" step="any" class="input_tf" name="icr" placeholder="Mcr - Markup on Credit" />
              <p class="input_lbl pull-left">Ld - Loss due Delay</p>
              <input type="number" step="any" class="input_tf" name="ld" placeholder="Ld - Loss due Delay" />
              <p class="input_lbl pull-left">Dw - Defective Works</p>
              <input type="number" step="any" class="input_tf" name="dw" placeholder="Dw - Defective Works" />
              <p class="input_lbl pull-left">Exp. - Expected %</p>
              <input type="number" step="any" class="input_tf" name="exp" placeholder="Exp. - Expected %" />
              <p class="input_lbl pull-left">Obs. - Observed %</p>
              <input type="number" step="any" class="input_tf" name="obs" placeholder="Obs. - Observed %" />
            </div>
          </div>
          {{-- <input type="text" class="input_tf" name="bias" placeholder="B" />
          <input type="text" class="input_tf" name="kscale" placeholder="K" required/> --}}

          <button type="submit" name="store_action" value="compute" class="predict_submit">Predict</button>

      </form>
      
  </div>  

@endsection