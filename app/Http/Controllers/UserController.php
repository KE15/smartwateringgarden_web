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
            session(['idUser' => $dataUser->id_User, 'username' => $dataUser->Username]);
            return redirect() -> route('index');

        }
        
        return redirect('login');
        
    }

    public function logout(Request $request){
        $request->session()-> invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
