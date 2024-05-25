<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AbsenController extends Controller
{
    public function show(Request $request) {
        if (request()->ajax()) {
            $data = Absen::query();
            $data->orderBy('status_hadir','ASC');
            return DataTables::of($data)
                ->addColumn('action', function($data) {
                    if($data->status_hadir == 0){
                        $stat = 'Belum Hadir';
                        return '<a href="#" class="btn btn-sm btn-warning btn-hadir" data-id="' . $data->id . '">'. $stat .'</a>';
                    }else if($data->status_hadir == 1){
                        $stat = 'Sudah Hadir';
                        return '<span style="padding:0.3rem;border-radius:5px;background-color:#71fb46;font-weight: bold">'.$stat.'</span>';
                    }

            })
            ->rawColumns(['action'])->make();
        }
        return view('welcome');
        // return response()->json(['data' => $data]);
    }

    public function store($id)
    {
        if (request()->ajax()) {
            $data = Absen::find($id);

            if($data){

                $data->status_hadir = '1';
                $data->save();

                if($data){
                    return response()->json([
                        'success' => $data,
                        'message'=>'Data berhasil di update.',
                        'status'=>200
                    ]);
                }else{
                    return response()->json([
                        'success' => null,
                        'message'=>'Data tidak berhasil di update.',
                        'status'=>404
                    ]);
                }
            }else{
                return response()->json([
                    'success' => null,
                    'message'=>'Data tidak ditemukan.',
                    'status'=>404
                ]);
            }
        }
    }

    public function hadir(Request $request){
        if (request()->ajax()) {
            $data = Absen::query();
            $data->where('status_hadir','=','1');
            $data->orderBy('updated_at','DESC');

            return DataTables::of($data)
                ->addColumn('action', function($data) {
                    if($data->status_hadir == 0){
                        $stat = 'Belum Hadir';
                        return '<span style="padding:0.3rem;border-radius:5px;background-color:#red;font-weight: bold">'.$stat.'</span>';
                    }else if($data->status_hadir == 1){
                        $stat = 'Sudah Hadir';
                        return '<span style="padding:0.3rem;border-radius:5px;background-color:#71fb46;font-weight: bold">'.$stat.'</span>';
                    }

            })
            ->rawColumns(['action'])->make();
        }
        return view('list');
    }

    public function vip(Request $request){
        if (request()->ajax()) {
            $data = Absen::query();
            $data->where('status_hadir','=','1');
            $data->where('status_tamu','=','VIP');
            $data->orderBy('updated_at','DESC');

            return DataTables::of($data)
                ->addColumn('action', function($data) {
                    if($data->status_hadir == 0){
                        $stat = 'Belum Hadir';
                        return '<span style="padding:0.3rem;border-radius:5px;background-color:#red;font-weight: bold">'.$stat.'</span>';
                    }else if($data->status_hadir == 1){
                        $stat = 'Sudah Hadir';
                        return '<span style="padding:0.3rem;border-radius:5px;background-color:#71fb46;font-weight: bold">'.$stat.'</span>';
                    }

            })
            ->addColumn('updated_at', function($date) {
                return $date->updated_at->format('d-M-Y H:i');
            })
            ->rawColumns(['action'])->make();
        }
        return view('listvip');
    }
}
