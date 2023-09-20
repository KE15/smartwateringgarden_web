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
                <form class="row g-3" id="searchForm">
                    @csrf
                    <div class="col-md-6">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" value="">
                    </div>
                    <div class="col-md-6">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" value="">
                    </div>
                
                    <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="getDataChartByDate()">Search</button>
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
              <!-- <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#lineChart'), {
                    type: 'line',
                    data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                      datasets: [{
                        label: 'Line Chart',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
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
              </script> -->
              <!-- End Line CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Tables</h5>
              
              <!-- Table with stripped rows -->
              <table class="table datatable" id="tableData">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Average Value</th>
                    <th scope="col">Soil Moisture 1</th>
                    <th scope="col">Soil Moisture 2</th>
                    <th scope="col">Light Intensity</th>
                    <th scope="col">Relay Status</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
    
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
  
    </section>

  </main>
  @endsection

  <script>

    var currentChart;

    function getDataChartByDate(){

        $.ajax({
            type:'GET',
            url:'{{ route("ReportByDate") }}',
            data:$('#searchForm').serialize(),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                renderChartByDate(data.kelembapan1_data, data.kelembapan2_data, data.cahaya_data,data.tanggal).render();
            },
            error: function(data){
                console.log(data);
            }

        });
    }

    // function getDataTableByDate(){
    //     var t = $('tableData').DataTable();
    //     var Counter = 1;

    //     t.row.add([])
    // }

    function renderChartByDate(kelembapan1, kelembapan2, cahaya1, tanggal){
        // document.querySelector('#lineChart').innerHTML = "";
        var canvas = document.getElementById('lineChart');
        // Dapatkan konteks 2D dari elemen <canvas>
        var ctx = canvas.getContext('2d');
        // Set warna latar belakang ke putih (atau warna latar belakang yang Anda inginkan)
        if (currentChart != null){
            currentChart.destroy();
        }
        
        currentChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: tanggal,
                      datasets: [{
                        label: 'Kelembapan 1',
                        data: kelembapan1,
                        fill: false,
                        borderColor: '#4154f1',
                        tension: 0.1
                      },
                      {
                        label: 'Kelembapan 2',
                        data: kelembapan2,
                        fill: false,
                        borderColor: '#ff771d',
                        tension: 0.1
                      },
                      {
                        label: 'Cahaya',
                        data: cahaya1,
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
            return currentChart;
    }

  </script>