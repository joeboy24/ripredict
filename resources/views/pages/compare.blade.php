
    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Sleep',    7]
        ]);

        var options = {
        //   title: 'My Daily Activities',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script> --}}

@extends('layouts.app')

@section('nav2')
    <div class="nav2">
        <a href="/input"><button type="button" class="menu_btn">INPUT</button></a>
        <a href="/predict"><button type="button" class="menu_btn">PREDICT</button></a>
        <a href="/input"><button type="button" class="menu_btn btn_focus">COMPARE</button></a>
    </div>
@endsection

@section('content')

    <div class="col-sm-8 col-sm-offset-2 myCol">
        {{-- @include('inc.messages') --}}
        <div class="welcome_msg">
            <p class="p1">Welcome <span>Use Times</span></p>
            <p class="p2">{{ auth()->user()->title.' '.auth()->user()->name }} <span>{{ auth()->user()->use_times }}</span></p>
        </div>
        
    </div>  

    <div class="compare_list">
      <table class="tbl_view">
        <tbody>
          @if (count($entries) > 0)
            @foreach ($entries as $entry)
              <tr>
                <td><a href="/predict"><i class="fa fa-chevron-circle-left">&nbsp;&nbsp;</i><b class="ics_amt">₵ {{ number_format($entry->ics, 2) }}</b></a>
                  <br><p class="act_profit">Pre. {{ number_format($entry->profit, 2) }}</p>
                  <p class="act_profit">Exp. {{ number_format(($entry->exp / 100) * $entry->ics, 2) }}</p>
                  <p class="act_profit">Obs. {{ number_format((92.38 / 100) * (($entry->exp / 100) * $entry->ics), 2) }}</p>
                  <p class="tbl_date">{{ $entry->created_at }}</p>
                </td>
                <td class="">
                  <form action="{{ action('ComputationsController@update', $entry->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <button type="" class="btn btn_close pull-right" name="update_action" value="compare_del"><i class="fa fa-close"></i></button>
                    @if ($entry->compare == 'yes')
                      <button type="" class="btn warn btn_compare pull-right" name="update_action" value="up_compare"><i class="fa fa-edit"></i>&nbsp;&nbsp;Compare</button>
                    @else
                      <button type="" class="btn btn_compare pull-right" name="update_action" value="up_compare"><i class="fa fa-edit"></i>&nbsp;&nbsp;Compare</button>
                    @endif
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <div class="empty_tbl">
              <p>No records found</p>
            </div>
          @endif
          
        </tbody>
      </table>
            {{ $entries->links() }}
    </div>
    
@endsection
