<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use App\Models\Pelanggan;
use App\Models\Message;

class PelController extends Controller
{
    
    public function getPelangganNew(Request $request)
    {
        
        $area = Area::all();
        if ($request->ajax()) {
            return DataTables::of(DB::table('pelanggan')
            ->where('status', 0)
            ->get())
            ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id_pelanggan.'" data-original-title="Edit" class="btn btn-sm edit-post"><span class="badge badge-success">Verifikasi</span></a>';
                        $button .= '&nbsp;&nbsp;';

                        return $button;
                    })
                    ->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. $data->tagihan. '</span>';
                    })
                    ->editColumn('tv', function($data){
                        if($data->tv == 0) {
                            return  '<span class="badge badge-sm bg-gradient-warning">0</span>';
                        }else if($data->tv == 1) {
                            return  '<span class="badge badge-info">Tv Digital</span>';
                        }else if($data->tv == 2) {
                            return  '<span class="badge badge-success">Tv Box</span>';
                        }
                    })
                    ->editColumn('status', function($data){
                        if($data->status == 0){
                            return  '<span class="badge badge-danger badge-sm">Pelanggan Baru</span>';
                        }
                    })
                    ->rawColumns(['action', 'tv', 'tagihan', 'status'])
                    ->make(true);

        }
        return view('owner.pelanggan.n_pelanggan', compact('area'));
    }

    public function verifikasiPelanggan($id)
    {
        $where = array('id_pelanggan' => $id);
        $post  = Pelanggan::where($where)->first();
     
        return response()->json($post);
    }

    public function verifikasiProses(Request $request, $id)
    {
        $post = DB::table('pelanggan')->where('id_pelanggan',$id)->update([
            'nama_pelanggan' => htmlspecialchars($request->nama_pelanggan),
            'perumahan' => htmlspecialchars($request->perumahan),
            'alamat' => htmlspecialchars($request->alamat),
            'tagihan' => htmlspecialchars($request->tagihan),
            'paket' => htmlspecialchars($request->paket),
            'merk_modem' => htmlspecialchars($request->merk_modem),
            'sn_modem' => htmlspecialchars($request->sn_modem),
            'tv' => htmlspecialchars($request->tv),
            'sn' => htmlspecialchars($request->sn),
            'chip_id' => htmlspecialchars($request->chip_id),
            'tgl_pemasangan' => htmlspecialchars($request->tgl_pemasangan),
            'tgl_tagihan' => htmlspecialchars($request->tgl_tagihan),
            'telp_hp' => htmlspecialchars($request->telp_hp),
            'user_id' => htmlspecialchars($request->user_id),
            'password' => htmlspecialchars($request->password),
            'status' => '1'
        ]);

        return response()->json($post);
    }

    public function koreksiProses(Request $request)
    {
        $id = $request->id_pelanggan;
        $post = Message::insert([
                    'pelanggan_id' => $id,
                    'message' => $request->message,
                    'title_message' => 'Verifikasi Pelanggan Ditolak Owner',
                ]);
        $post = DB::table('pelanggan')->where('id_pelanggan',$id)->update([
            'status' => '4'
        ]);
        return response()->json($post);
    }

    public function getPelangganVerify(Request $request)
    {
        $area = Area::all();
        if ($request->ajax()) {
            return DataTables::of(DB::table('pelanggan')
            ->where('status', 1)
            ->get())
            ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id_pelanggan.'" data-original-title="Edit" class="btn btn-sm edit-post"><span class="badge badge-waring">Detail</span></a>';
                        $button .= '&nbsp;&nbsp;';

                        return $button;
                    })
                    ->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. $data->tagihan. '</span>';
                    })
                    ->editColumn('tv', function($data){
                        if($data->tv == 0) {
                            return  '<span class="badge badge-sm bg-gradient-warning">0</span>';
                        }else if($data->tv == 1) {
                            return  '<span class="badge badge-info">Tv Digital</span>';
                        }else if($data->tv == 2) {
                            return  '<span class="badge badge-success">Tv Box</span>';
                        }
                    })
                    ->editColumn('status', function($data){
                        if($data->status == 1){
                            return  '<span class="badge badge-success badge-sm">Terverifikasi</span>';
                        }
                    })
                    ->rawColumns(['action', 'tv', 'tagihan', 'status'])
                    ->make(true);

        }
        return view('owner.pelanggan.verify', compact('area'));
    }

    public function getPelangganNotVerify(Request $request)
    {
        $area = Area::all();
        if ($request->ajax()) {
            return DataTables::of(DB::table('pelanggan')
            ->join('message', 'message.pelanggan_id', '=', 'pelanggan.id_pelanggan')
            ->where('status', 4)
            ->get())
            ->addIndexColumn()
                    ->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. $data->tagihan. '</span>';
                    })
                    ->editColumn('tv', function($data){
                        if($data->tv == 0) {
                            return  '<span class="badge badge-sm bg-gradient-warning">0</span>';
                        }else if($data->tv == 1) {
                            return  '<span class="badge badge-info">Tv Digital</span>';
                        }else if($data->tv == 2) {
                            return  '<span class="badge badge-success">Tv Box</span>';
                        }
                    })
                    ->editColumn('status', function($data){
                        if($data->status == 4){
                            return  '<span class="badge badge-warning badge-sm">Verifikasi Ditolak</span>';
                        }
                    })
                    ->rawColumns(['tv', 'tagihan', 'status'])
                    ->make(true);

        }
        return view('owner.pelanggan.p_ditolak', compact('area'));
    }

    public function getPelangganTerputus(Request $request)
    {
        $area = Area::all();
        if ($request->ajax()) {
            return DataTables::of(DB::table('pelanggan')
            ->join('message', 'message.pelanggan_id', '=', 'pelanggan.id_pelanggan')
            ->where('status', '2')
            ->get())
            ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="delete" id="'.$data->id_pelanggan.'" class="delete btn btn-sm"><span class="badge badge-success">Verifikasi</span></button>'; 
                    $button .= '&nbsp;&nbsp;';

                    return $button;
                })
                ->editColumn('tagihan', function($data){
                    return  '<span> Rp. '. $data->tagihan. '</span>';
                })
                ->editColumn('tv', function($data){
                    if($data->tv == 0) {
                        return  '<span class="badge badge-sm bg-gradient-warning">0</span>';
                    }else if($data->tv == 1) {
                        return  '<span class="badge badge-info">Tv Digital</span>';
                    }else if($data->tv == 2) {
                        return  '<span class="badge badge-success">Tv Box</span>';
                    }
                })
                ->editColumn('status', function($data){
                    if($data->status == 2) {
                        return  '<span class="badge badge-sm badge-warning">Terputus</span>';
                    }
                })
                ->rawColumns(['action', 'tv', 'tagihan', 'status'])
                ->make(true);

        }
        return view('owner.pelanggan.p_terputus', compact('area'));
    }

    public function deletePelanggan($id)
    {
        $post = Pelanggan::where('id_pelanggan',$id)->delete();
        return response()->json($post);
    }
}
