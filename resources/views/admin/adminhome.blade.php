@extends('layouts.admin_app')

@section('content')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Count'],
      ['Pending Orders', {{$count['pending_order_count']}}],
      ['Reject Orders',  {{$count['reject_order']}}],
      ['Complete Order', {{$count['complete_order']}}],
    ]);

    var options = {
      title: 'Order Dashboad'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>


<div class="container" style="margin-bottom: 100%;">
    <center>

   
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header">Order Dashboad</div>
                <div class="card-body">

                  <div id="piechart" style="width: 900px; height: 500px;"></div>

                    <div class="card-deck">
                        <div class="card border-danger h-75 d-inline-block">
                          <div class="card-body">
                            <h5 class="card-title"><center><b>Pending Orders</b></center></h5>
                            <center>
                                <h1>
                                   {{$count['pending_order_count']}}
                                </h1>
                            </center>
                            
                          </div>
                        </div>
                        <div class="card border-primary h-75 d-inline-block">
                          <div class="card-body">
                            <h5 class="card-title"><center><b>Complete Orders</b></center></h5>
                            <center>
                                <h1>
                                  {{$count['complete_order']}}
                                </h1>
                            </center>
                            
                          </div>
                        </div>

                        <div class="card border-primary h-75 d-inline-block">
                          <div class="card-body">
                            <h5 class="card-title"><center><b>Reject Orders</b></center></h5>
                            <center>
                                <h1>
                                  {{$count['reject_order']}}
                                </h1>
                            </center>
                            
                          </div>
                        </div>
                      
                      </div>

                </div>
            </div>
        </div>



</center>








</div>








@endsection