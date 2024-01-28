@extends('layouts.main')

@section('dashboard')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<div class="pagetitle">
      <h1>Device Setting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Device Setting</li>
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
                <h5 class="card-title">Device Setting</h5>

                <!-- Multi Columns Form -->
                <form action="" method="POST">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">ID Device</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="idDevice" value="{{ session('idDevice') }}" disabled>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Device</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="NamaDevice">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" id="KetDevice"></textarea>
                  </div>
                </div>

                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Options</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                      <label class="form-check-label" for="gridRadios1">
                        Automatic
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                      <label class="form-check-label" for="gridRadios2">
                        Schedule
                      </label>
                    </div>
                  </div>
                </fieldset>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form><!-- End General Form Elements -->

                </div>
            </div>
          </div>
        </div><!-- End Left side columns -->

         
        <!-- Right side columns -->
        


        

        <!-- <div class="col-lg-12">
        @if(session('success'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        </div> -->

        

      </div>
    </section>

  </main>
  @endsection
  <script>

    getDetailDevice()

    function getDetailDevice(){
        $.ajax({
        url:'{{ route("getDetailDevice") }}',
        type:'GET',
        data:{
            '_token':'<?php echo csrf_token() ?>',
            'idDevice' : "{{ session('idDevice') }}"
        },
        dataType: 'json',
        success:function(data){
            console.log(data);
                if(data.datasDevice.length > 0){
                $('#NamaDevice').val(data.datasDevice[0].NamaDevice);
                $('#KetDevice').val(data.datasDevice[0].KeteranganDevice);
                $('#isSchedule').text(data.datasDevice[0].is_Schedule);
                $('#DebitAir').text(data.datasDevice[0].Debit_air);
                $('#VolumeAir').text(data.datasDevice[0].Volume_air);
            }
            
        }
        });
    }

  </script>