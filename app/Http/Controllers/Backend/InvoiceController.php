<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Perumahan;
use DataTables;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Carbon;

class InvoiceController extends Controller
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
            ->where('status', '1')
            ->get();
            if (!empty($request->get('perumahan')) and $request->get('perumahan') != 0) {
                $data = $data->where('perumahan_id', $request->get('perumahan'));
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id_pelanggan.'" data-original-title="Edit" class="btn btn-sm edit-post"><i class="fa fa-print"></i> Print</a>';
                        $button .= '&nbsp;&nbsp;';

                        return $button;
                    })
                    ->editColumn('tagihan', function($data){
                        return  '<span> Rp. '. number_format($data->tagihan) . '</span>';
                    })
                    ->editColumn('status', function($data){
                        if($data->status == 1) {
                            return  '<span class="badge badge-sm badge-success">Terverifikasi</span>';
                        }
                    })
                    ->rawColumns(['action', 'tagihan', 'status'])
                    ->make(true);

        }
        return view('backend/invoice/c_invoice', compact('perumahan'));
    }

    public function printAll(Request $request)
    {
        $perumahan = Perumahan::all();
        $bulan = $request->get('bulan')[0];
        if (!empty($request->get('perumahan')) and $request->get('perumahan') != 0) {
            $data = DB::table('pelanggan')
                    ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
                    ->where('status', '1')
                    ->where('perumahan_id', $request->get('perumahan'))
                    ->get();        
            $pdf = PDF::loadview('backend/invoice/myPDF', compact(['perumahan', 'data', 'bulan']));
            $pdf ->setPaper('a4','landscape');
            return $pdf->stream();
        }else{
            $data = DB::table('pelanggan')
                    ->join('perumahan', 'pelanggan.perumahan_id', '=', 'perumahan.id')
                    ->where('status', '1')
                    ->get();
                    $pdf = PDF::loadview('backend/invoice/myPDF', compact(['perumahan', 'data', 'bulan']));
                    $pdf ->setPaper('a4','landscape');
                    return $pdf->stream();
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
}
