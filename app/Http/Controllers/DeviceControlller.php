<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class DeviceControlller extends Controller
{
    public function UpdateDevice(Request $request){
        $idDevice = $request->input('idDevice');
        $NameDevice = $request->input('nameDevice');
        $infoDevice = $request->input('infoDevice');

        DB::table('tdevice')
        ->where('id_Device', $idDevice)
        ->update(['NamaDevice' => $NameDevice,
                'KeteranganDevice' => $infoDevice]);

        return redirect() -> route('index');

    }
}
