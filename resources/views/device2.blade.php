@extends('layouts.main')

@section('dashboard')
<div class="pagetitle">
      <h1>Device Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Device</li>
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
                <h5 class="card-title">Select Automatic Watering or Scheduling</h5>
                <p>This is where you can choose the prototype using automatic watering or scheduling</p>

                <form class="row g-3" action='' method="POST" id="schedulingForm">
                    @csrf
                    <div class="form-check form-switch">
                        <!-- <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="is_scheduling" checked onchange="updateScheduling({{session('idDevice')}})"> -->
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="is_scheduling" data-iddevice="{{ json_encode(session('idDevice')) }}"  onchange="updateScheduling(this)">

                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                    </div>
                </form><!-- End Multi Columns Form -->
                </div>
            </div>
          </div>
        </div><!-- End Left side columns -->

         
        <!-- Right side columns -->
        <div class="col-lg-6">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
            </div>

            <div class="card-body">
              <h5 class="card-title">Delete Data By Date <span>| This action will delete your datas by date.</span></h5>
              <!-- Multi Columns Form -->
              <form class="row g-3" id="form_deletedata">
                  @csrf
                  <div class="col-md-6">
                  <label for="startDate" class="form-label">Start Date</label>
                  <input type="date" class="form-control" id="delete_startDate" name="delete_startDate" value="<?php if(isset($startDate)){echo $startDate;} ?>" disabled>
                  </div>
                  <div class="col-md-6">
                  <label for="endDate" class="form-label">End Date</label>
                  <input type="date" class="form-control" id="delete_endDate" name="delete_endDate" value="<?php if(isset($endDate)){echo $endDate;} ?>" disabled>
                  </div>
              
                  <div class="text-center">
                  <button type="button" class="btn btn-danger" onclick="delete_bydate()">Delete</button>
                  </div>
              </form><!-- End Multi Columns Form -->


            </div>
          </div><!-- End Recent Activity -->

        </div><!-- End Right side columns -->


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
                      labels: <?php if(isset($tanggal)){echo $tanggal;} ?>,
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

        <div class="col-lg-12">
        @if(session('success'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        </div>

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Tables</h5>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avg Value</th>
                    <th scope="col">Avg ADC</th>
                    <th scope="col">Soil Moisture 1</th>
                    <th scope="col">ADC Soil 1</th>
                    <th scope="col">Soil Moisture 2</th>
                    <th scope="col">ADC Soil 2</th>
                    <th scope="col">Status Information</th>
                    <th scope="col">Light Intensity</th>
                    <th scope="col">Relay Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <!-- <th scope="col">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  @isset($datas)
                    @foreach($datas as $key =>$d)
                    <tr>
                      <th scope="row">{{ $key + 1 }}</th>
                      <td>{{ $d -> TotalValue }}%</td>
                      <td>{{ $d -> AdcTotal }}</td>
                      <td>{{ $d -> ValueKelembapan1 }}%</td>
                      <td>{{ $d -> AdcKelembapan1 }}</td>
                      <td>{{ $d -> ValueKelembapan2 }}%</td>
                      <td>{{ $d -> AdcKelembapan2 }}</td>
                      <td>{{ $d -> StatusKeterangan }}</td>
                      <td>{{ number_format($d->ValueCahaya, 2) }} lx</td>
                      <td>{{ $d -> StatusRelay }}</td>
                      <td>{{ $d -> Tanggal }}</td>
                      <td>{{ $d -> Waktu }}</td>
                      <!-- <td>
                          <button type="submit" onclick="delete_data('{{ $d -> id_Data }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal">
                              <i class="bi bi-trash-fill"></i>
                          </button>
                      </td> -->
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
  @endsection
  <script>
    
    $(document).ready(function() {
        getDetailDevice();
        
    });

    function getDetailDevice(){
            $.ajax({
            url:'{{ route("getDetailDevice") }}',
            type:'GET',
            data:{
                '_token':'<?php echo csrf_token() ?>'
            },
            dataType: 'json',
            success:function(data){
                console.log(data);
                if(data.datasDevice.length > 0){
                $('#NamaDevice').text(data.datasDevice[0].NamaDevice);
                $('#KetDevice').text(data.datasDevice[0].KeteranganDevice);
                $('#isSchedule').text(data.datasDevice[0].is_Schedule);
                $('#DebitAir').text(data.datasDevice[0].Debit_air);
                $('#VolumeAir').text(data.datasDevice[0].Volume_air);
                if (data.datasDevice[0].is_Schedule == 1) {
                    $('#flexSwitchCheckChecked').prop('checked', true);
                    console.log(data.datasDevice[0].is_Schedule)
                } else {
                    $('#flexSwitchCheckChecked').prop('checked', false);
                }
                }
                
            }
            });
    }

    function updateScheduling(checkboxSchedule) {
        var isScheduling = document.getElementById("flexSwitchCheckChecked").checked ? 1 : 0;
        var idDevice = JSON.parse(checkboxSchedule.getAttribute('data-iddevice'));
 
        console.log(idDevice)
        // Kirim permintaan AJAX ke server
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log("Data updated successfully");
            }
        };
        xhttp.open("POST", "{{ route('AutoScheduling') }}", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("_token={{ csrf_token() }}&is_scheduling=" + isScheduling + "&idDevice="+idDevice);
    }

    function delete_data(id){
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: '{{ route("DeleteData") }}', 
            data: {
              '_token': '{{ csrf_token() }}',
              'id': id,
            },
            success: function(data) {
              console.log(data);
              if (data.status == "sukses") {
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                );
                location.reload();
              } else {
                swalWithBootstrapButtons.fire(
                  'Failed',
                  'Your file cannot be deleted.',
                  'error'
                );
              }
            },
            error: function() {
              swalWithBootstrapButtons.fire(
                  'Error',
                  'Server Error',
                  'error'
                );
            }
          });
          
        } 
      })
    }

    function delete_bydate(){
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'DELETE',
            url: '{{ route("DeleteDataByDate") }}', 
            data: {
              '_token': '{{ csrf_token() }}',
              'delete_startDate' : document.getElementById("startDate").value,
              'delete_endDate' : document.getElementById("endDate").value,
              // 'id': id,
            },
            success: function(data) {
              console.log(data);
              if (data.status == "sukses") {
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                );
                location.reload();
              } else {
                swalWithBootstrapButtons.fire(
                  'Failed',
                  'Your file cannot be deleted.',
                  'error'
                );
              }
            },
            error: function() {
              swalWithBootstrapButtons.fire(
                  'Error',
                  'Server Error',
                  'error'
                );
            }
          });
          
        } 
      })
    }

  </script>