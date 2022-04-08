<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Area;
use App\Models\Pembayaran;
use DataTables;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(DB::table('pembayaran')
            ->join('pelanggan', 'pembayaran.pelanggan_id', '=', 'pelanggan.id_pelanggan')
            ->get())
            ->addIndexColumn()
                    ->addColumn('action', function($data){
                        if($data->status_pembayaran == 0){
                            $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id_pembayaran.'" data-original-title="Edit" class="btn btn-sm btn-konfirmasi"><i class="fa fa-check-square-o"></i> Konfirmasi</a>';
                            $button .= '&nbsp;&nbsp;';
                            return $button;
                        }else{
                            $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id_pembayaran.'" data-original-title="Edit" class="btn btn-sm btn-warning btn-cancel"><i class="fa fa-undo"></i> Cancel Konfirmasi</a>';
                            $button .= '&nbsp;&nbsp;';
                            return $button;
                        }
                    })
                    ->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. $data->tagihan. '</span>';
                    })
                    ->editColumn('status', function($data){
                        $sekarang  =  new \DateTime();  
                        $today = $sekarang->format('Y-m-d');
                        if(($today == $data->tgl_tagihan) && $data->status_pembayaran == 0 ){
                            $button = '<span class="badge badge-danger">Belum Bayar</span>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<span class="badge badge-warning">Jatuh Tempo</span>';

                            return $button;
                        }else if($data->status_pembayaran == 1){
                            return '<span class="badge badge-success">Sudah Bayar</span>';
                        }else{
                           return '<span class="badge badge-danger">Belum Bayar</span>';
                        }
                    })
                    ->rawColumns(['action', 'status', 'tagihan'])
                    ->make(true);

        }
        return view('backend.pembayaran.konfirmasi');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    public function updateStatus(Request $request)
    {

        $id = $request->data_id;
        $petugas = Auth::user()->name;
        $insert2 = [
            'id_pembayaran' => $id,
            'jml_dibayar' => $request->jml_dibayar,
            'bulan_dibayar' => $request->bulan_dibayar,
            'status_pembayaran' => '1',
            'log_petugas' => $petugas,
        ];
        $post = Pembayaran::updateOrCreate(['id_pembayaran' => $id], $insert2);

        return response()->json($post);
    }

    public function cancelKonfirmasi(Request $request)
    {

        $id = $request->data_id;
        $petugas = Auth::user()->name;
        $insert2 = [
            'id_pembayaran' => $id,
            'jml_dibayar' => '0',
            'status_pembayaran' => '0',
            'log_petugas' => $petugas,
        ];
        $post = Pembayaran::updateOrCreate(['id_pembayaran' => $id], $insert2);

        return response()->json($post);
    }

    public function filterBulan(Request $request)
    {
        if ($request->ajax()) {
            return $dataPelanggan = DB::table('pembayaran')
                                ->where('bulan_dibayar', $request->bulanID)
                                ->get();
            $data = [];
            foreach ($dataPelanggan as $key => $value) {
                $data[$key]['id_pelanggan'] = $value->id_pelanggan;
                $data[$key]['nama_pelanggan'] = strtoupper($value->nama_pelanggan);
                $data[$key]['alamat'] = strtoupper($value->alamat);
                $data[$key]['tagihan'] = strtoupper($value->tagihan);
                $data[$key]['paket'] = strtoupper($value->paket);
                $data[$key]['merk_modem'] = strtoupper($value->merk_modem);
                $data[$key]['sn_modem'] = strtoupper($value->sn_modem);
                $data[$key]['tv'] = strtoupper($value->tv);
                $data[$key]['sn'] = strtoupper($value->sn);
                $data[$key]['chip_id'] = strtoupper($value->chip_id);
                $data[$key]['tgl_pemasangan'] = strtoupper($value->tgl_pemasangan);
                $data[$key]['tgl_tagihan'] = strtoupper($value->tgl_tagihan);
                $data[$key]['telp_hp'] = strtoupper($value->telp_hp);
                $data[$key]['user_id'] = strtoupper($value->user_id);
                $data[$key]['password'] = strtoupper($value->password);
            }

    	}
    }
}
