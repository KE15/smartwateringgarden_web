<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function ReportByDate(Request $request)
    {
        $tanggalAwal = $request->input('startDate');
        $tanggalAkhir = $request->input('endDate');

        $datas = DB::table('tdata')
        ->select('ValueKelembapan1','ValueKelembapan2', 'ValueCahaya' , 'Waktu')
        ->whereBetween(DB::raw('cast(Waktu as date)'), [$tanggalAwal, $tanggalAkhir])
        ->get();

        // dd($datas);

        $value_kelembapan1 = $datas->pluck('ValueKelembapan1')->map(function ($item) {
            return (int) $item;
        });
        $value_kelembapan2 = $datas->pluck('ValueKelembapan2')->map(function ($item) {
            return (int) $item;
        });        
        $value_cahaya1 = $datas->pluck('ValueCahaya')->map(function ($item) {
            return (int) $item;
        });        
        $date = $datas->pluck('Waktu');

        // return response()->json([
        //     'status' => 'oke',
        //     'kelembapan1_data' => $value_kelembapan1,
        //     'kelembapan2_data' => $value_kelembapan2,
        //     'cahaya_data' => $value_cahaya1,
        //     'time' => $date
        // ]);

        return view('report')
            ->with('datas',$datas)
            ->with('kelembapan1_data',$value_kelembapan1)
            ->with('kelembapan2_data',$value_kelembapan2)
            ->with('cahaya_data',$value_cahaya1)
            ->with('time',$date)
            ->with('startDate',$tanggalAwal)
            ->with('endDate',$tanggalAkhir);
    }
}
