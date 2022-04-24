<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Perumahan;
use DataTables;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PembayaranController extends Controller
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
            $data = DB::table('pembayaran')
            ->join('pelanggan', 'pembayaran.pelanggan_id', '=', 'pelanggan.id_pelanggan')
            ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
            ->where('status', '1')
            ->get();
            if (!empty($request->get('perumahan')) and $request->get('perumahan') != 0) {
                $data = $data->where('perumahan_id', $request->get('perumahan'));
            }
            if(!empty($request->get('bulan')) and $request->get('bulan') != 0 ){
                $data = $data->where('bulan_dibayar', $request->get('bulan'));
            }
            return Datatables::of($data)
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
                        return  '<span> Rp. '. number_format($data->tagihan) . '</span>';
                    })
                    ->editColumn('jml_dibayar', function($data){
                        return  '<span> Rp. '. number_format($data->jml_dibayar) . '</span>';
                    })
                    ->editColumn('bulan_dibayar', function($data){
                        $bulan = $data->bulan_dibayar;
                        switch($bulan){
                            case 1: $bulan="Januari";
                                break;
                            case 2: $bulan="Februari";
                                break;
                            case 3: $bulan="Maret";
                                break;
                            case 4: $bulan="April";
                                break;
                            case 5: $bulan="Mei";
                                break;
                            case 6: $bulan="Juni";
                                break;
                            case 7: $bulan="Juli";
                                break;
                            case 8: $bulan="Agustus";
                                break;
                            case 9: $bulan="September";
                                break;
                            case 10: $bulan="Oktober";
                                break;
                            case 11: $bulan="November";
                                break;
                            case 12: $bulan="Desember";
                                break;
                                
                        }
                        return $bulan;
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
                    ->editColumn('tgl_pembayaran', function($data){
                        return  Carbon::parse($data->tgl_pembayaran)->translatedFormat('d F Y');
                    })
                    ->rawColumns(['action', 'status', 'tagihan', 'jml_dibayar', 'bulan_dibayar', 'tgl_pembayaran'])
                    ->make(true);

        }
        return view('backend.pembayaran.konfirmasi', compact('perumahan'));
    }

    public function showPelanggan(Request $request)
    {
        $nama_pelanggan = $request->nama_pelanggan;
        if($nama_pelanggan != ""){
            $post = DB::table('pelanggan')
                        ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
                        ->where('nama_pelanggan','LIKE','%'.$request->nama_pelanggan.'%')
                        ->where('status', 1)
                        ->get();
                
        }

        $response = array();
        foreach($post as $data){
            $response[] = array(
                'label' => $data->nama_pelanggan,
                'id_pelanggan' => $data->id_pelanggan,
                'nama_perumahan' => $data->nama_perumahan,
                'alamat' => $data->alamat,
                'paket' => $data->paket,
                'tgl_pemasangan' => $data->tgl_pemasangan,
                'tgl_tagihan' => $data->tgl_tagihan,
                'tagihan' => number_format($data->tagihan),
                'telp_hp' => $data->telp_hp,
            );
        }

        return response()->json($response);
    }

    public function prosesPembayaran(Request $request)
    {
        $permitted_chars = '0123456789';
        $idGenerate = substr(str_shuffle($permitted_chars), 0, 4);
        $sekarang  =  new \DateTime();
        $today = $sekarang->format('ymd');
        $kodePembayaran = 'TR'. $today . $idGenerate;
        
        $petugas = Auth::user()->name;
        $post = Pembayaran::create([
            'id_pembayaran' => $kodePembayaran,
            'pelanggan_id' => $request->id_pelanggan,
            'jml_dibayar' => str_replace(".", "", $request->jml_dibayar),
            'bulan_dibayar' => $request->bulan_dibayar,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'status_pembayaran' => 1,
            'log_petugas' => $petugas,
        ]);

        return response()->json($post);
    }

    public function edit($id)
    {
        $where = array('id_pembayaran' => $id);
        $post = DB::table('pembayaran')
                    ->join('pelanggan', 'pembayaran.pelanggan_id', '=', 'pelanggan.id_pelanggan')
                    ->where($where)->first();
     
        return response()->json($post);
    }

    public function cancelKonfirmasi(Request $request)
    {

        $id = $request->data_id;
        $post = Pembayaran::where('id_pembayaran',$id)->delete();

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

    public function destroy(Request $request, $id)
    {
        $id = $request->data_id;
        $post = Pembayaran::where('id_pembayaran',$id)->delete();

        return response()->json($post);
    }

    public function cekPembayaran(Request $request)
    {
        $perumahan = Perumahan::all();
        if ($request->ajax()) {
            $data = DB::table('pelanggan')
            ->leftJoin('pembayaran', 'pembayaran.pelanggan_id', '=', 'pelanggan.id_pelanggan')
            ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
            ->where('status', '1')
            ->get();
            if (!empty($request->get('perumahan')) and $request->get('perumahan') != 0) {
                $data = $data->where('perumahan_id', $request->get('perumahan'));
            }

            if (!empty($request->get('bulan')) and ($request->get('bulan') != 0)) {
                $data = DB::table('pelanggan')
                ->leftJoin('pembayaran', 'pembayaran.pelanggan_id', '=', 'pelanggan.id_pelanggan')
                ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
                ->where('perumahan_id', $request->get('perumahan'))
                ->whereIn('bulan_dibayar', [null])
                ->get();
            }
            return Datatables::of($data)
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
                        return  '<span> Rp. '. number_format($data->tagihan) . '</span>';
                    })
                    ->editColumn('jml_dibayar', function($data){
                        return  '<span> Rp. '. number_format($data->jml_dibayar) . '</span>';
                    })
                    ->editColumn('bulan_dibayar', function($data){
                        $bulan = $data->bulan_dibayar;
                        if($bulan == null){
                            return  '<span> Belum Bayar </span>';
                        }else{
                            switch($bulan){
                                case 1: $bulan="Januari";
                                    break;
                                case 2: $bulan="Februari";
                                    break;
                                case 3: $bulan="Maret";
                                    break;
                                case 4: $bulan="April";
                                    break;
                                case 5: $bulan="Mei";
                                    break;
                                case 6: $bulan="Juni";
                                    break;
                                case 7: $bulan="Juli";
                                    break;
                                case 8: $bulan="Agustus";
                                    break;
                                case 9: $bulan="September";
                                    break;
                                case 10: $bulan="Oktober";
                                    break;
                                case 11: $bulan="November";
                                    break;
                                case 12: $bulan="Desember";
                                    break;
                                    
                            }
                            return $bulan;
                        }
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
                    ->editColumn('tgl_pembayaran', function($data){
                        return  Carbon::parse($data->tgl_pembayaran)->translatedFormat('d F Y');
                    })
                    ->rawColumns(['action', 'status', 'tagihan', 'jml_dibayar', 'bulan_dibayar', 'tgl_pembayaran'])
                    ->make(true);

        }
        return view('backend.pembayaran.c_pembayaran', compact('perumahan'));
    }
}
