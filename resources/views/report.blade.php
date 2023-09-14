@extends('layouts.main')

@section('dashboard')
<div class="pagetitle">
      <h1>Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Report</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-6">
          <div class="row">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Search Report By Date</h5>

                <!-- Multi Columns Form -->
                <form class="row g-3" action='{{ route("ReportByDate") }}' method="POST">
                    @csrf
                    <div class="col-md-6">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" value="<?php if(isset($startDate)){echo $startDate;} ?>">
                    </div>
                    <div class="col-md-6">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" value="<?php if(isset($endDate)){echo $endDate;} ?>">
                    </div>
                
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form><!-- End Multi Columns Form -->

                </div>
            </div>
          </div>
        </div><!-- End Left side columns -->


        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Line Chart</h5>

              <!-- Line Chart -->
              <canvas id="lineChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#lineChart'), {
                    type: 'line',
                    data: {
                      labels: <?php if(isset($time)){echo $time;} ?>,
                      datasets: [{
                        label: 'Kelembapan 1',
                        data: <?php if(isset($kelembapan1_data)){echo $kelembapan1_data;} ?>,
                        fill: false,
                        borderColor: '#4154f1',
                        tension: 0.1
                      },
                      {
                        label: 'Kelembapan 2',
                        data: <?php if(isset($kelembapan2_data)){echo $kelembapan2_data;} ?>,
                        fill: false,
                        borderColor: '#ff771d',
                        tension: 0.1
                      },
                      {
                        label: 'Cahaya',
                        data: <?php if(isset($cahaya_data)){echo $cahaya_data;} ?>,
                        fill: false,
                        borderColor: '#4bf542',
                        tension: 0.1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Line CHart -->

            </div>
          </div>
        </div>

        

      </div>
    </section>

  </main><!-- End #main -->
  <!-- <script>
    getDataChart();
      function getDataChart(){

        var startDate = $("startDate").val();
        var endDate = $("endDate").val();

        $.ajax({
          type:'POST',
          url:'{{ route("ReportByDate") }}',
          data:{
              '_token':'<?php echo csrf_token() ?>',
              startDate : startDate,
              endDate : endDate
          },
          success: function(data){
              renderChart(data.kelembapan1_data, data.kelembapan2_data, data.cahaya_data,data.time).render();
          },
          error: function(xhr){
              console.log(xhr);
          }
        });
      }
      function renderChart(kelembapan1,kelembapan2,cahaya1,date){
      document.querySelector("#reportsChart").innerHTML = "";
      let chart = new ApexCharts(document.querySelector("#reportsChart"), {
         series: [{
            name: 'Sensor kelembapan 1',
            data: kelembapan1,
         }, {
            name: 'Sensor Kelembapan 2',
            data: kelembapan2
         }, {
            name: 'Sensor Intensistas Cahaya',
            data: cahaya1
         }],
         chart: {
            height: 350,
            type: 'area',
            toolbar: {
            show: false
            },
         },
         markers: {
            size: 4
         },
         colors: ['#4154f1', '#ff771d', '#4bf542'],
         fill: {
            type: "gradient",
            gradient: {
               shadeIntensity: 1,
               opacityFrom: 0.3,
               opacityTo: 0.4,
               stops: [0, 90, 100]
            }
         },
         dataLabels: {
            enabled: false
         },
         stroke: {
            curve: 'smooth',
            width: 2
         },
         xaxis: {
            type: 'datetime',
            categories: date,
            labels: {
                    datetimeUTC: false
                },
         },
         tooltip: {
            x: {
               format: 'dd/MM/yy'
            },
         }
      });
      return chart;
   }
  </script> -->
  @endsection