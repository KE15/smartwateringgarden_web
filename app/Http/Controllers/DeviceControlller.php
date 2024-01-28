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
        $Debitair = $request->input('debitAir');
        $VolumeAir = $request->input('volumeAir');

        $isSchedule = $request->input('gridRadios');

        DB::table('tdevice')
        ->where('id_Device', $idDevice)
        ->update(['NamaDevice' => $NameDevice,
                'KeteranganDevice' => $infoDevice,
                'Debit_air'=> $Debitair,
                'Volume_air' => $VolumeAir,
                'is_Schedule' => $isSchedule]);

        return redirect() -> route('index');

    }

    public function AutoSchedule(Request $request)
    {
        // Periksa nilai is_scheduling dari permintaan
        $idDevice = $request->input('idDevice');
        $isScheduling = $request->input('is_scheduling') ? 1 : 0;

        // Simpan nilai is_scheduling ke dalam database
        DB::table('tdevice')
        ->where('id_Device', $idDevice)
        ->update(['is_Schedule' => $isScheduling]);

        return response()->json(['message' => 'Data updated successfully'], 200);
    }

    public function getDetailDevice(Request $request)
    {
        $idDevice = $request->input('idDevice');


        $getScheduleValue = DB::table('tdevice')
        ->select('NamaDevice, KeteranganDevice, is_Schedule, Debit_air, Volume_air')
        ->where('id_Device', $idDevice)
        ->get();

        return response()->json([
            'datasDevice' => $getScheduleValue]
        );
    }

    public function scheduleAdd(Request $request)
    {
        $idDevice = $request->input('idDevice');
        $waktuJadwal = $request->input('waktuJadwal');


        $addSchedule = DB::table('tschedule')->insertGetId([
            'Schedule' => $waktuJadwal,
            'id_Device' => $idDevice
        ]);

        if ($addSchedule) {
            // Registrasi berhasil, arahkan pengguna ke halaman login
            return redirect('/schedule')->with('success', 'Success add schedule');
        } else {
            // Registrasi gagal, dapatkan pesan kesalahan atau lakukan sesuatu yang sesuai
            return response()->json(['error' => 'Registration failed']);
        }
    }

    public function getSchedule(Request $request)
    {
        $idDevice = $request->session()->get('idDevice');

        $getSchedule = DB::table('tschedule')
        ->select('id_Schedule', 'Schedule', 'last_executed', 'id_Device')
        ->where('id_Device', $idDevice)
        ->get();

        return view('schedule')
            ->with('datas',$getSchedule);
    }

    public function DeleteSchedule(Request $request)
    {
        try {
            
            $id = $request->input('id');
            DB::table('tschedule')->where('id_Schedule', $id)->delete();

            return response()->json([
                'status' => 'sukses',
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => 'gagal: ' . $th->getMessage(),
            ], 500);
        }
    }
}
