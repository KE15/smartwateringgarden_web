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
                <form class="row g-3" action='{{ route("ReportByDate") }}' method="GET">
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
                    <th scope="col">Average Value</th>
                    <th scope="col">Soil Moisture 1</th>
                    <th scope="col">Soil Moisture 2</th>
                    <th scope="col">Light Intensity</th>
                    <th scope="col">Relay Status</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @isset($datas)
                    @foreach($datas as $key =>$d)
                    <tr>
                      <th scope="row">{{ $key + 1 }}</th>
                      <td>{{ $d -> TotalValue }}</td>
                      <td>{{ $d -> ValueKelembapan1 }}</td>
                      <td>{{ $d -> ValueKelembapan2 }}</td>
                      <td>{{ $d -> ValueCahaya }}</td>
                      <td>{{ $d -> StatusRelay }}</td>
                      <td>{{ $d -> Tanggal }} | {{ $d -> Waktu }}</td>
                      <td>
                        <!-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal" data-id="{{ $d -> id_Data }}">
                          <i class="bi bi-info-circle"></i>
                        </button> -->
                        <!-- <form role="form" method="POST" action="{{ route('DeleteData', ['id' => $d->id_Data]) }}"> -->
                          <!-- @csrf -->
                          <button type="submit" onclick="delete_data('{{ $d -> id_Data }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal">
                              <i class="bi bi-trash-fill"></i>
                          </button>
                      <!-- </form> -->
                      </td>
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


  //   function delete_data(id) {
  //   swal.fire({
  //     title: "Hapus Data",
  //     text: "Apakah Anda yakin ingin menghapus data ini?",
  //     icon: "warning",
  //     buttons: true,
  //     dangerMode: true,
  //   })
  //   .then((willDelete) => { 
  //     if (willDelete.value) {
  //       $.ajax({
  //         type: 'POST',
  //         url: '{{ route("DeleteData") }}', 
  //         data: {
  //           '_token': '{{ csrf_token() }}',
  //           'id': id,
  //         },
  //         success: function(data) {
  //           console.log(data);
  //           if (data.status == "sukses") {
  //             swal("Data berhasil dihapus", {
  //               icon: "success",
  //             })
  //             .then(() => {
  //               location.reload();
  //             });
  //           } else {
  //             swal("Gagal menghapus data", {
  //               icon: "error",
  //             });
  //           }
  //         },
  //         error: function() {
  //           swal("Terjadi kesalahan saat menghapus data", {
  //             icon: "error",
  //           });
  //         }
  //       });
  //     }
  //   });
  // }


  </script>