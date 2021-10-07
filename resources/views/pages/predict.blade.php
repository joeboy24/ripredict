@extends('layouts.app')

@section('nav2')
    <div class="nav2">
        <a href="/input"><button type="button" class="menu_btn">INPUT</button></a>
        <a href=""><button type="button" class="menu_btn btn_focus">PREDICT</button></a>
        <a href="/compare"><button type="button" class="menu_btn">COMPARE</button></a>
    </div> 
@endsection

@section('content')

    <div style="height: 10px"></div>
    
    <div class="col-sm-8 col-sm-offset-2 myCol">
        {{-- @include('inc.messages'); --}}
        @if ($entries->profit)
            <h2 class="tp">₵ {{ number_format($entries->profit, 2) }}</h2>
        @else
            <h2 class="tp">₵ 0</h2>
        @endif
        {{-- @if (!empty($entries->entries))
        @else 
        @endif --}}
        <form style="padding: 0" action="{{ action('ComputationsController@update', $entries->id) }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <p class="tp_notice">Total Profit <button type="submit" class="compare_btn" name="update_action" value="up_compare"><i class="fa fa-plus-circle"></i> Compare</button></p>
            {{-- <div class="btn_center">
                <button type="button" class="compare_btn"><i class="fa fa-plus-circle"></i> PREDICT</button>
            </div> --}}
        </form>

        <div class="bar_graph">
            <div class="bar xmod" style="height: 70%">
            </div>
            <div class="bar" style="height: {{ (70 * $entries->vr) / $entries->ics }}%">
            </div>
            <div class="bar xmod" style="height: {{ (70 * $entries->lb) / $entries->ics }}%">
            </div>
            <div class="bar" style="height: {{ (70 * $entries->icf) / $entries->ics }}%">
            </div>
            <div class="bar xmod" style="height: {{ (70 * $entries->iln) / $entries->ics }}%">
            </div>
            <div class="bar" style="height: {{ (70 * $entries->icr) / $entries->ics }}%">
            </div>
            <div class="bar xmod" style="height: {{ (70 * $entries->ld) / $entries->ics }}%">
            </div>
            <div class="bar" style="height: {{ (70 * $entries->dw) / $entries->ics }}%">
            </div>
            <div class="bar xmod" style="height: {{ (70 * $entries->bias) / $entries->ics }}%">
            </div>
            <div class="bar" style="height: 100%">
            </div>
            <p>Ics</p><p>Vr</p><p>Lb</p><p>Mcf</p><p>ILn</p><p>Mcr</p><p>Ld</p><p>Dw</p><p>B</p><p>K</p>
        </div>
    </div>  

    <!--div class="bar_graph2">
        <div class="bar xmod">
        </div>
        <div class="bar">
        </div>
        <div class="bar xmod">
        </div>
        <div class="bars_bottom">
        </div>
    </div-->

    <div class="compare">

        <div class="compare_indiv">
            {{-- <h3>Items</h3> --}}
            {{-- <p style="width: 100%">&nbsp;</p> --}}
            @if (count($entries_all) > 0)
                @foreach ($entries_all as $entry)
                    <p class="compare{{ $c++ }}"><i class="fa fa-square"></i>&nbsp;&nbsp;₵&nbsp;{{ number_format($entry->ics, 2) }} <b>/ {{ number_format($entry->profit, 2) }} </b> 
                        <span class="pull-right"> Apr. {{ number_format(($entry->profit * 100) / $entry->ics, 1) }}%</span></p>
                @endforeach

                <div style="height: 5px"></div>
                
                @foreach ($entries_all as $entry)
                    <div class="loader_container" style="width: 100%">
                        <div class="loader{{ $i++ }}" style="width: {{ ($entry->ics * 100) / $max }}%">
                        </div>
                    </div>
                @endforeach
            @else
                
            @endif
            {{-- <p class="compare1"><i class="fa fa-square"></i>&nbsp;&nbsp;7,750,000</p>
            <p class="compare2"><i class="fa fa-square"></i>&nbsp;&nbsp;5,540,700</p>
            <p class="compare3"><i class="fa fa-square"></i>&nbsp;&nbsp;7,750,000</p>
            <p class="compare4"><i class="fa fa-square"></i>&nbsp;&nbsp;5,540,700</p> --}}

            <!--div class="loader_container">
                <div class="loader2" style="width: 75%">
                </div>
            </div>
            <div class="loader_container">
                <div class="loader3" style="width: 50%">
                </div>
            </div>
            <div class="loader_container">
                <div class="loader4" style="width: 85%">
                </div>
            </div-->
        </div>

        <!--div class="compare_indiv">
            <h3>Item B</h3>
            <p class="compare1"><i class="fa fa-square"></i>&nbsp;&nbsp;7,750,000</p>
            <p class="compare2"><i class="fa fa-square"></i>&nbsp;&nbsp;5,540,700</p>
            <div style="height: 10px">
            </div>
            <div class="loader_container">
                <div class="loader1" style="width: 80%; background: #e5376b">
                </div>
            </div>
            <div class="loader_container">
                <div class="loader2" style="width: 45%; background: #b520d3">
                </div>
            </div>
        </div-->

        <!--div class="compare_indiv">
            {{-- <h3>Comparison</h3>
            <p class="compare1"><i class="fa fa-square"></i>&nbsp;&nbsp;7,750,000</p>
            <p class="compare2"><i class="fa fa-square"></i>&nbsp;&nbsp;5,540,700</p>
            <div style="height: 10px">
            </div>
            <div class="loader_container">
                <div class="loader1" style="width: 20%; background: #e5376b">
                </div>
            </div>
            <div class="loader_container">
                <div class="loader2" style="width: 50%; background: #b520d3">
                </div>
            </div> --}}
            <div id="donutchart" style="width: 100%; height: 100%;"></div>
        </div-->

    </div>
    
    <!--div class="compare">

        <div class="compare_indiv">
            <h3>Item A</h3>
            <p class="compare1"><i class="fa fa-square"></i>&nbsp;&nbsp;7,750,000</p>
            <p class="compare2"><i class="fa fa-square"></i>&nbsp;&nbsp;5,540,700</p>
            <div style="height: 10px">
            </div>
            <div class="loader_container">
                <div class="loader1" style="width: 30%; background: #e5376b">
                </div>
            </div>
            <div class="loader_container">
                <div class="loader2" style="width: 75%; background: #b520d3">
                </div>
            </div>
        </div>

        <div class="compare_indiv">
            <h3>Item B</h3>
            <p class="compare1"><i class="fa fa-square"></i>&nbsp;&nbsp;7,750,000</p>
            <p class="compare2"><i class="fa fa-square"></i>&nbsp;&nbsp;5,540,700</p>
            <div style="height: 10px">
            </div>
            <div class="loader_container">
                <div class="loader1" style="width: 80%; background: #e5376b">
                </div>
            </div>
            <div class="loader_container">
                <div class="loader2" style="width: 45%; background: #b520d3">
                </div>
            </div>
        </div>

    </div-->
@endsection
    
