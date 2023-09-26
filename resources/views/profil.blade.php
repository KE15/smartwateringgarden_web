@extends('layouts.main')

@section('dashboard')
<div class="pagetitle">
      <h1>Profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Profil</li>
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
                <h5 class="card-title">My Profil</h5>

                <!-- Multi Columns Form -->
                <form class="row g-3">
                    <div class="col-md-12" hidden>
                        <label for="inputName5" class="form-label">My ID</label>
                        <input type="text" class="form-control" id="MyId" value="{{ session('idUser') }}">
                    </div>
                    <div class="col-md-12">
                        <label for="inputName5" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="Name" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Username</label>
                        <input type="text" class="form-control" id="Username" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" disabled>
                        <!-- <button id="togglePassword" onclick="togglePasswordVisibility()">Tampilkan Password</button> -->
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="PhoneNumber" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="inputZip" class="form-label">Chat Id</label>
                        <input type="text" class="form-control" id="ChatId" disabled>
                    </div>
                    <!-- <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div> -->
                </form><!-- End Multi Columns Form -->

                </div>
            </div>
          </div>
        </div><!-- End Left side columns -->

    </section>

  </main>
</div>

<script>
callMyProfil();

function callMyProfil(){
    $.ajax({
          url:'{{ route("callProfil") }}',
          type:'GET',
          data:{
            '_token':'<?php echo csrf_token() ?>',
            'id' : document.getElementById("MyId").value,
            // 'id': id,
            
          },
          dataType: 'json',
          success:function(data){
            console.log(data);
            // if(data.datas.length > 0){
              $('#Name').val(data.dataprofil[0].Nama);
              $('#Username').val(data.dataprofil[0].Username);
              $('#Password').val(data.dataprofil[0].Password);
              $('#PhoneNumber').val(data.dataprofil[0].NoTelp);
              $('#ChatId').val(data.dataprofil[0].Chat_id);
            // }
            
          }
        });
}

// function togglePasswordVisibility() {
//     var passwordInput = document.getElementById('Password');
//     var toggleButton = document.getElementById('togglePassword');

//     if (passwordInput.type === 'password') {
//         passwordInput.type = 'text';
//         toggleButton.textContent = 'Sembunyikan Password';
//     } else {
//         passwordInput.type = 'password';
//         toggleButton.textContent = 'Tampilkan Password';
//     }
// }

</script>

@endsection

  