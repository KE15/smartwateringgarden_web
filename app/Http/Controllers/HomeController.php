<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function renderChartHome(Request $request)
    {
        $timetoday = date('Y-m-d'); 
        // $timetoday = '2023-09-14'; 

        $datas = DB::table('tdata')
        ->select('TotalValue', 'ValueKelembapan1','ValueKelembapan2', 'ValueCahaya' , 'Waktu')
        ->where(DB::raw('cast(Waktu as date)'), $timetoday)
        ->get();
        $value_avgkelembapan = $datas->pluck('TotalValue');
        $value_kelembapan1 = $datas->pluck('ValueKelembapan1');
        $value_kelembapan2 = $datas->pluck('ValueKelembapan2');
        $value_cahaya1 = $datas->pluck('ValueCahaya');
        $date = $datas->pluck('Waktu');

        return response()->json([
            'status' => 'oke',
            'avgkelembapan_data'=> $value_avgkelembapan,
            'kelembapan1_data' => $value_kelembapan1,
            'kelembapan2_data' => $value_kelembapan2,
            'cahaya_data' => $value_cahaya1,
            'time' => $date
        ]);
    }

    public function DatasToday()
    {   
        // $timetoday = '2023-09-14';
        $timetoday = date('Y-m-d'); 
        $datas = DB::table('tdata')
        ->select('TotalValue', 'ValueKelembapan1', 'ValueKelembapan2', 'ValueCahaya', 'id_Device')
        ->where(DB::raw('cast(Waktu as date)'), $timetoday)
        ->orderBy('id_Data', 'desc')
        ->take(1)
        ->get();

        $dataslogsiram = DB::table('tlog_Siram')
        ->select('id_LogSiram', DB::raw('cast(Waktu as time(0)) as Waktu'), 'id_Data')
        ->where(DB::raw('cast(Waktu as date)'), $timetoday)
        ->orderBy('id_LogSiram', 'desc')
        ->get();

        return response()->json([
            'datas' => $datas,
            'dataslog' => $dataslogsiram]);
            // ->with('datas',$datas)
            // ->with('dataslog', $dataslogsiram);

    }

    public function DetailLogSiram(Request $request)
    {
        $idData = $request->input('id');

        $data = DB::table('tdata')
        ->select('id_Data','TotalValue', 'ValueKelembapan1', 'ValueKelembapan2', 'ValueCahaya', DB::raw('cast(Waktu as time(0)) as Jam'), DB::raw('cast(Waktu as date) as Tanggal'))
        ->where('id_Data', $idData)
        ->get();

        return response()->json([
            'data' => $data
        ]);

    }

}
