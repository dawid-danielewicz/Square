@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="h1 ml-2 my-3 inline-block mr-auto" style="color: #364F6B;">Sprzedane akcesoria - statystyki</h1>
        </div>
    </div>
    <hr class="color-bg">

    <h4 class="h4 color-txt my-3 ml-2">Najlepiej sprzedające się akcesoria:</h4>
    <div class="row mt-5 mx-5">
       <div class="col-sm-12">
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
           <div class="col-sm-12">
               <div id="chart_div"></div>
           </div>
           <script>
               google.charts.load('current', {'packages':['bar']});
               google.charts.setOnLoadCallback(drawChart);

               function drawChart() {
                   var data = google.visualization.arrayToDataTable([
                       ['Nazwa akcesoriów', 'Ilość'],
                           @foreach($accessories as $accessory)
                       ['{{ $accessory->saleable->name }}', {{ $accessory->quantity }}],
                       @endforeach
                   ]);

                   var options = {
                       bars: 'vertical',
                       vAxis: {format: 'decimal'},
                       height: 400,
                       colors: ['#364F6B']
                   };

                   var chart = new google.charts.Bar(document.getElementById('chart_div'));

                   chart.draw(data, google.charts.Bar.convertOptions(options));
               }
           </script>
       </div>
    </div>
@endsection
