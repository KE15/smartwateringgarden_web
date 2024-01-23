@extends('layouts.main')

@section('dashboard')
<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

           

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <!-- <li class="dropdown-header text-start">
                      <h6></h6>
                    </li> -->

                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalDetailDevice">Detail</a></li>
                  </ul>
                </div>

                <div class="modal fade" id="ModalDetailDevice" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Detail Device</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Multi Columns Form -->
                        <form class="row g-3" method="POST" action="{{ route('updateDevice') }}">
                          @csrf
                              <div class="col-md-12">
                                  <input type="hidden" class="form-control" id="Ket_idDevice" name="idDevice">
                              </div>
                              <div class="col-md-12">
                                  <label for="inputName5" class="form-label">Device Name</label>
                                  <input type="text" class="form-control" id="DeviceName" name="nameDevice">
                              </div>
                              <div class="col-sm-10">
                                <label for="inputName5" class="form-label">Information Device</label>
                                <textarea class="form-control" style="height: 100px" id="InformationDevice" name="infoDevice"></textarea>
                              </div>
                              <div class="col-md-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                        </form>
                        <!-- End Multi Columns Form -->
                      </div>
                      <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div> -->
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <h5 class="card-title">ID Device IoT</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cpu"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="idDevice">
                        None
                      </h6>
                      <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Average Moisture <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-view-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="avgValue">
                        0
                      </h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Status Keterangan <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-sticky-note-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="statusKet">
                        -
                      </h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Soil Moisture 1 <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-pin-map-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="soil1">
                        0
                      </h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">

              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Soil Moisture 2 <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-pin-map"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="soil2">
                        0
                      </h6>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Light instensity <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-brightness-high"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="light1">
                        0
                      </h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->



          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>

              <div class="activity" style="overflow-y: auto; max-height: 265px;" id="activity-list">

                <!-- div untuk laporan log siram -->

              </div>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Detail Automatic Watering</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <!-- Multi Columns Form -->
                      <form class="row g-3">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label ">ID</div>
                            <div class="col-lg-9 col-md-8" id="modalIdData"></div>
                          </div>

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Date</div>
                            <div class="col-lg-9 col-md-8" id="modalTanggal"></div>
                          </div>

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Time</div>
                            <div class="col-lg-9 col-md-8" id="modalWaktu"></div>
                          </div>

                        </div>
                        <br>
                        <div class="col-md-12">
                          <label for="inputName5" class="form-label">Average soil moiture</label>
                          <input type="text" class="form-control" id="modalAvgValue" disabled>
                        </div>
                        <div class="col-md-12">
                          <label for="inputName5" class="form-label">Status Information</label>
                          <input type="text" class="form-control" id="modalStatKet" disabled>
                        </div>
                        <div class="col-md-6">
                          <label for="inputName5" class="form-label">Soil moisture 1</label>
                          <input type="text" class="form-control" id="modalSoil1" disabled>
                        </div>
                        <div class="col-md-6">
                          <label for="inputName5" class="form-label">Soil moisture 2</label>
                          <input type="text" class="form-control" id="modalSoil2" disabled>
                        </div>
                        <div class="col-12">
                          <label for="inputName5" class="form-label">Light instensity</label>
                          <input type="text" class="form-control" id="modalLight1" disabled>
                        </div>
                      </form><!-- End Multi Columns Form -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>



          </div><!-- End Recent Activity -->

        </div><!-- End Right side columns -->

        <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sensor Kelembapan 1',
                          data: [0, 0, 0, 0, 0, 0, 0],
                        }, {
                          name: 'Sensor Kelembapan 2',
                          data: [0, 0, 0, 0, 0, 0, 0]
                        }, {
                          name: 'Sensor Intensitas Cahaya',
                          data: [0, 0, 0, 0, 0, 0, 0]
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
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
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
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

      </div>
    </section>

  </main><!-- End #main -->
  <script>
    getDataChart();
    getDataDashboard();
    getDataLogsSiram();

    setInterval(() => {
            getDataChart();
            getDataDashboard();
            getDataLogsSiram();
    }, 10 * 1000); // 60 = detik, 1000 = milisecond. 60 * 1000 = 1 menit

      $(document).ready(function() {
        
      });

      function getDataDashboard(){
        $.ajax({
          url:'{{ route("datasToday") }}',
          type:'GET',
          data:{
            '_token':'<?php echo csrf_token() ?>'
          },
          dataType: 'json',
          success:function(data){
            console.log(data);
            if(data.datas.length > 0){
              $('#idDevice').text(data.datas[0].id_Device);
              $('#avgValue').text(data.datas[0].TotalValue + '%');
              $('#statusKet').text(data.datas[0].StatusKeterangan);
              $('#soil1').text(data.datas[0].ValueKelembapan1 + '%');
              $('#soil2').text(data.datas[0].ValueKelembapan2 + '%');
              $('#light1').text(Math.round((parseFloat(data.datas[0].ValueCahaya)+ Number.EPSILON) * 100) / 100  + ' lux');
              $('#Ket_idDevice').val(data.datas[0].id_Device);
              $('#DeviceName').val(data.dataDevice[0].NamaDevice);
              $('#InformationDevice').val(data.dataDevice[0].KeteranganDevice);
            }
            
          }
        });
      }


      function getDataLogsSiram(){
        $.ajax({
          url:'{{ route("datasToday") }}',
          type:'GET',
          data:{
            '_token':'<?php echo csrf_token() ?>'
          },
          dataType: 'json',
          success:function(data){
            console.log(data);
            document.getElementById("activity-list").innerHTML = '';
            data.dataslog.forEach(function (datalog) {
              var activityItem = `
                    <div class="activity-item d-flex">
                        <div class="activite-label" id="WaktuLog">${datalog.Waktu}</div>
                        <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                        <div class="activity-content">
                            Automatic watering is ON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="${datalog.id_Data}">
                                <i class="bi bi-info-circle"></i>
                            </button>
                        </div>
                    </div>`;
                
                $('#activity-list').append(activityItem);
            }) 
            $('.btn-info').click(function() {
            var idLog = $(this).data('id'); // Mendapatkan nilai data-id dari tombol yang diklik
            $.ajax({
                url: '{{ route("detailLogSiram") }}', // Ganti dengan URL rute di Laravel
                type: 'GET',
                data: {
                    'id': idLog
                },
                dataType: 'json',
                success: function(data) {
                  console.log(data);
                    $('#modalIdData').text(data.data[0].id_Data);
                    $('#modalAvgValue').val(data.data[0].TotalValue + '%');
                    $('#modalStatKet').val(data.data[0].StatusKeterangan);
                    $('#modalSoil1').val(data.data[0].ValueKelembapan1 + '%');
                    $('#modalSoil2').val(data.data[0].ValueKelembapan2 + '%');
                    $('#modalLight1').val(Math.round((parseFloat(data.data[0].ValueCahaya) + Number.EPSILON) * 100) / 100 );
                    $('#modalTanggal').text(data.data[0].Tanggal);
                    $('#modalWaktu').text(data.data[0].Jam);
                }
            });
        });

          },
          error: function() {
            console.log('Error fetching data.');
          }
        });
      }

      function getDataChart(){
        $.ajax({
          type:'POST',
          url:'{{ route("renderChartHome") }}',
          data:{
              '_token':'<?php echo csrf_token() ?>',
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
  </script>
  @endsection