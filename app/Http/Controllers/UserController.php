<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    // public function index(){
    //     return view('index');
    // }

    public function loginAuth(Request $request)
    {
        $reqUser = $request->input('username');
        $reqPass = $request->input('password');

        error_log($reqUser .''. $reqPass);

        $dataUser = DB::table('tUser')
        ->where('Username', $reqUser)
        ->first();

        if ($dataUser && $reqPass == $dataUser->Password) {
            $request->session()->regenerate();
            session(['idUser' => $dataUser->id_User, 'username' => $dataUser->Username, 'name' => $dataUser->Nama]);
            return redirect() -> route('index');

        }
        
        return redirect('login');
        
    }

    public function logout(Request $request){
        $request->session()-> invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function callProfil(Request $request){
        $idProfil = $request->input('id');

        $dataProfil = DB::table('tUser')
        ->where('id_User', $idProfil)
        ->get();

        // $NameProfil = $dataProfil->pluck('Nama');
        // $UsernameProfil = $dataProfil->pluck('Username');
        // $PasswordProfil = $dataProfil->pluck('Password');
        // $PhoneProfil = $dataProfil->pluck('NoTelp');
        // $ChatIdProfil = $dataProfil->pluck('Chat_id');

        return response()->json([
            'dataprofil' => $dataProfil]);

        // return response()->json([
        //     'status' => 'oke',
        //     'name_data'=> $NameProfil,
        //     'username_data' => $UsernameProfil,
        //     'password_data' => $PasswordProfil,
        //     'phone_data' => $PhoneProfil,
        //     'chatid_data' => $ChatIdProfil
        // ]);


        // return view('profil')
        //     ->with('dataProfil',$dataProfil)
        //     ->with('name_data',$NameProfil)
        //     ->with('username_data',$UsernameProfil)
        //     ->with('password_data',$PasswordProfil)
        //     ->with('phone_data',$PhoneProfil)
        //     ->with('chatid_data',$ChatIdProfil);

    }
}
