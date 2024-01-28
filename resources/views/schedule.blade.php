@extends('layouts.main')

@section('dashboard')
<div class="pagetitle">
      <h1>Schedule</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Schedule</li>
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
                <h5 class="card-title">Schedule Watering</h5>
                <p>In this page you can make your own schedule for your plant</p>

                <!-- Multi Columns Form -->
                <form class="row g-3" action="{{ route('scheduleAdd') }}" method="POST">
                @csrf
                    <div class="col-md-12" hidden>
                        <label for="inputName5" class="form-label">My ID</label>
                        <input type="text" class="form-control" id="idDevice" name="idDevice" value="{{ session('idDevice') }}">
                    </div>
                    <div class="row mb-3">
                        <label for="inputTime" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="waktuJadwal">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add Schedule</button>
                    </div>
                    <!-- <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div> -->
                </form><!-- End Multi Columns Form -->

                </div>
            </div>
          </div>
        </div><!-- End Left side columns -->

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Tables</h5>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Schedule</th>
                    <th scope="col">last Executed</th>
                    <th scope="col">ID Device</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @isset($datas)
                    @foreach($datas as $key =>$d)
                    <tr>
                      <th scope="row">{{ $key + 1 }}</th>
                      <td>{{ $d -> Schedule }}%</td>
                      <td>{{ $d -> last_executed }}</td>
                      <td>{{ $d -> id_Device }}</td>
                      <td>
                          <button type="submit" onclick="delete_schedule('{{ $d -> id_Schedule }}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal">
                              <i class="bi bi-trash-fill"></i>
                          </button>
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

        <div class="col-lg-12">
        @if(session('success'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        </div>

    </section>

  </main>
</div>

<script>


function delete_schedule(id){
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
            url: '{{ route("DeleteSchedule") }}', 
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
</script>

@endsection

  