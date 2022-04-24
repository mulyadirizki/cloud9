<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\PelangganImport;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Perumahan;
use App\Models\Message;
use App\Models\Pembayaran;
use DataTables;
use DateTime;
use Faker\Core\Number;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Contracts\DataTable;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $perumahan = Perumahan::all();
        if ($request->ajax()) {
            $data = DB::table('pelanggan')
            ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
            ->where('status', '0')->get();
            if (!empty($request->get('perumahan')) and $request->get('perumahan') != 0) {
                $data = $data->where('perumahan_id', $request->get('perumahan'));
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id_pelanggan.'" data-original-title="Edit" class="btn btn-sm edit-post"><i class="fa fa-edit"></i> Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id_pelanggan.'" class="delete btn btn-sm"><i class="fa fa-trash"></i> Delete</button>'; 

                        return $button;
                    })
                    ->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. number_format($data->tagihan) . '</span>';
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
                        if($data->status == 0) {
                            return  '<span class="badge badge-sm badge-danger">Pelanggan Baru</span>';
                        }
                    })
                    ->rawColumns(['action', 'tv', 'tagihan', 'status'])
                    ->make(true);

        }
        return view('backend.pelanggan.home', compact('perumahan'));
    }

    public function VerDitolak(Request $request)
    {

        $perumahan = Perumahan::all();
        if ($request->ajax()) {
            $data = DB::table('pelanggan')
                        ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
                        ->join('message', 'message.pelanggan_id', '=', 'pelanggan.id_pelanggan')
                        ->where('status', '4')->get();
            if (!empty($request->get('perumahan')) and $request->get('perumahan') != 0) {
                $data = $data->where('perumahan_id', $request->get('perumahan'));
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id_pelanggan.'" data-original-title="Edit" class="btn btn-sm edit-post"><i class="fa fa-edit"></i> Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id_pelanggan.'" class="delete btn btn-sm"><i class="fa fa-trash"></i> Delete</button>'; 

                        return $button;
                    })
                    ->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. number_format($data->tagihan) . '</span>';
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
                        if($data->status == 4) {
                            return  '<span class="badge badge-sm badge-danger">Verifikasi Ditolak</span>';
                        }
                    })
                    ->rawColumns(['action', 'tv', 'tagihan', 'status'])
                    ->make(true);

        }
        return view('backend.pelanggan.v_ditolak', compact('perumahan'));
    }

    public function editPelangganDitolak($id)
    {
        $where = array('id_pelanggan' => $id);
        $post  = Pelanggan::where($where)->first();
     
        return response()->json($post);
    }

    public function updatePelangganDitolak(Request $request)
    {
        $id = $request->id_pelanggan;
        $post = DB::table('pelanggan')->where('id_pelanggan',$id)->update([
            'nama_pelanggan' => htmlspecialchars($request->nama_pelanggan),
            'perumahan_id' => htmlspecialchars($request->perumahan_id),
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
            'status' => 4,
        ]);
        return response()->json($post);
    }

    public function deletePelangganDitolak($id) 
    {
        $post = Pelanggan::where('id_pelanggan',$id)->delete();
        $post = Message::where('pelanggan_id',$id)->where('title_message', 'Verifikasi Pelanggan Ditolak Owner')->delete();
     
        return response()->json($post);
    }

    public function pelangganVerfify(Request $request)
    {
        
        $perumahan = Perumahan::all();
        if ($request->ajax()) {
            $data = DB::table('pelanggan')
            ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
            ->where('status', '1')->get();
            if (!empty($request->get('perumahan')) and $request->get('perumahan') != 0) {
                $data = $data->where('perumahan_id', $request->get('perumahan'));
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id_pelanggan.'" data-original-title="Edit" class="btn btn-sm edit-post"><i class="fa fa-edit"></i> Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id_pelanggan.'" class="delete btn btn-sm"><i class="fa fa-trash"></i> Delete</button>'; 

                        return $button;
                    })->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. number_format($data->tagihan) . '</span>';
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
                        if($data->status == 1) {
                            return  '<span class="badge badge-sm badge-success">Terverifikasi</span>';
                        }
                    })
                    ->rawColumns(['action', 'tv', 'tagihan', 'status'])
                    ->make(true);

        }
        return view('backend.pelanggan.p_verify', compact('perumahan'));
    }

    public function editPelangganVerify($id)
    {
        $where = array('id_pelanggan' => $id);
        $post  = Pelanggan::where($where)->first();
     
        return response()->json($post);
    }

    public function updatePelangganVerify(Request $request)
    {

        $id = $request->id_pelanggan;
        $post = DB::table('pelanggan')->where('id_pelanggan',$id)->update([
            'nama_pelanggan' => htmlspecialchars($request->nama_pelanggan),
                'perumahan_id' => htmlspecialchars($request->perumahan_id),
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
                'status' => 1,
        ]);
        return response()->json($post);
    }

    public function deletePelangganVerify(Request $request, $id)
    {
        $petugas = Auth::user()->name;
        $post = Message::insert([
            'pelanggan_id' => $id,
            'title_message' => 'Delete Data Pelanggan Oleh Admin',
            'message' => htmlspecialchars($request->message),
            'log_petugas' => $petugas,
        ]);
        $post = DB::table('pelanggan')->where('id_pelanggan',$id)->update([
            'status' => '2'
        ]);
        return response()->json($post);
    }

    public function getPelTerputus(Request $request)
    {
        $perumahan = Perumahan::all();
        if ($request->ajax()) {
            $data = DB::table('pelanggan')
                        ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
                        ->join('message', 'message.pelanggan_id', '=', 'pelanggan.id_pelanggan')
                        ->where('status', '2')
                        ->get();
            if (!empty($request->get('perumahan')) and $request->get('perumahan') != 0) {
                $data = $data->where('perumahan_id', $request->get('perumahan'));
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. number_format($data->tagihan). '</span>';
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
                            return  '<span class="badge badge-sm badge-warning">Terputus</span>
                                    <span class="badge badge-sm badge-warning">Menunggu Konfirmasi Owner</span>';
                        }
                    })
                    ->rawColumns(['action', 'tv', 'tagihan', 'status'])
                    ->make(true);

        }
        return view('backend.pelanggan.p_terputus', compact('perumahan'));
    }

    public function getPerumahan(Request $request)
    {
        if ($request->ajax()) {
            return $post = DB::table('pelanggan')->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function fileImport(Request $request)
    {
        Excel::import(new PelangganImport, $request->file('file')->store('temp'));
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = $request->id_pelanggan;
        if($request->id_pelanggan) {
            $post = Pelanggan::updateOrCreate(['id_pelanggan' => $id], [
                'nama_pelanggan' => htmlspecialchars($request->nama_pelanggan),
                'perumahan_id' => htmlspecialchars($request->perumahan_id),
                'alamat' => htmlspecialchars($request->alamat),
                'tagihan' => str_replace(".", "",$request->tagihan),
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
                'status' => 0,
            ]);
            return response()->json($post);
        }else {
            $permitted_chars = '0123456789';
            $idGenerate = substr(str_shuffle($permitted_chars), 0, 4);

            $sekarang  =  new \DateTime();
            $today = $sekarang->format('ymd');

            $kodeBaru = $today . $idGenerate;
            $post = Pelanggan::create([
                'id_pelanggan' => $kodeBaru,
                'nama_pelanggan' => htmlspecialchars($request->nama_pelanggan),
                'perumahan_id' => $request->perumahan_id,
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
                'status' => 0,
            ]);

            $petugas = Auth::user()->name;
            $kodePembayaran = 'TR'. $today . $idGenerate;

            $insert2 = [
                'id_pembayaran' => $kodePembayaran,
                'pelanggan_id' => $kodeBaru,
                'jml_dibayar' => '0',
                'bulan_dibayar' => '0',
                'status_pembayaran' => '0',
                'log_petugas' => $petugas,
            ];
            $post = Pembayaran::updateOrCreate(['id_pembayaran' => $kodePembayaran], $insert2);
            return response()->json($post);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id_pelanggan' => $id);
        $post  = Pelanggan::where($where)->first();
     
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Pelanggan::where('id_pelanggan',$id)->delete();
     
        return response()->json($post);
    }

}
