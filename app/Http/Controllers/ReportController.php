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
        ->select('id_Data', 'TotalValue', 'AdcTotal', 'ValueKelembapan1', 'AdcKelembapan1', 'ValueKelembapan2', 'AdcKelembapan2', 
                    DB::raw('ROUND(ValueCahaya, 2) as ValueCahaya'), 
                    'StatusRelay' , 'StatusKeterangan',
                    DB::raw('cast(Waktu as time(0)) as Waktu') , DB::raw('cast(Waktu as date) as Tanggal'))
        ->whereBetween(DB::raw('cast(Waktu as date)'), [$tanggalAwal, $tanggalAkhir])
        ->get();


        $value_kelembapan1 = $datas->pluck('ValueKelembapan1')->map(function ($item) {
            return (int) $item;
        });
        $value_kelembapan2 = $datas->pluck('ValueKelembapan2')->map(function ($item) {
            return (int) $item;
        });        
        $value_cahaya1 = $datas->pluck('ValueCahaya')->map(function ($item) {
            return (int) $item;
        });        
        $date = $datas->pluck('Tanggal');

        return view('report')
            ->with('datas',$datas)
            ->with('kelembapan1_data',$value_kelembapan1)
            ->with('kelembapan2_data',$value_kelembapan2)
            ->with('cahaya_data',$value_cahaya1)
            ->with('tanggal',$date)
            ->with('startDate',$tanggalAwal)
            ->with('endDate',$tanggalAkhir);
    }

    public function DeleteData(Request $request)
    {
        try {
            // $id = $request->input('id');
            // DB::table('tdata')->where('id_Data', $id)->delete();

            // $cekDBLog = DB::table('tlog_siram')
            // ->where('id_Data', $id)
            // ->get();

            // if($cekDBLog->count() > 0){
            //     DB::table('tlog_Siram')->where('id_Data', $id)->delete();
            // }
            
            $id = $request->input('id');
            DB::table('tlog_siram')->where('id_Data', $id)->delete();

            $cekDataUtama = DB::table('tdata')
            ->where('id_Data', $id)
            ->get();

            if($cekDataUtama->count() > 0){
                DB::table('tdata')->where('id_Data', $id)->delete();
            }

            return response()->json([
                'status' => 'sukses',
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => 'gagal: ' . $th->getMessage(),
            ], 500);
        }
    }

    public function DeleteDataByDate(Request $request)
    {
        try {
            
            $delete_StartDate = $request -> input('delete_startDate');
            $delete_EndtDate = $request -> input('delete_endDate');
            error_log($delete_StartDate.' '.$delete_EndtDate);

            DB::table('tlog_siram')
            ->whereIn('id_Data', function ($query) use ($delete_StartDate, $delete_EndtDate) {
                    $query->select('id_Data')
                    ->from('tdata')
                    ->whereBetween('Waktu', [$delete_StartDate.' 00:00:00', $delete_EndtDate.' 23:59:59']);
            })
            ->delete();

            DB::table('tdata')
            ->whereBetween('Waktu', [$delete_StartDate.' 00:00:00', $delete_EndtDate.' 23:59:59'])
            ->delete();
            
            return response()->json([
                'status' => 'sukses',
            ], 200);
        } catch (\Exception $th) {
            error_log('error delete '.$th->getMessage());
            return response()->json([
                'status' => 'gagal: ' . $th->getMessage(),
            ], 500);
        }
    }

}
