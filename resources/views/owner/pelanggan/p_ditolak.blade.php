@extends('owner.default')

@push('meta')
    <meta name="description" content="Website Konfirmasi Pembayaran" />
    <meta name="keywords" content="Website Konfirmasi Pembayaran" />
    <meta name="author" content="CV" />
@endpush

@push('title')
    <title>CloudNine | Data Pelanggan</title>
@endpush

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cloud<small> Nine</small></h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data<small>Pelanggan</small></h2>
                        <div class="form-group float-right row">
                            <select name="perumahan" id="perumahan" class="form-control">
                                <option selected value="Pilih Area">Pilih Perumahan</option>
                                @foreach($perumahan as $value) 
                                    <option value="{{ $value->id }}"> {{ strtoupper($value->nama_perumahan) }}</option>
                                @endforeach;
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="data-pelanggan" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID Pelanggan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Alamat</th>
                                                <th>Tagihan</th>
                                                <th>NET/Mbps</th>
                                                <th>TV</th>
                                                <th>Serial Number</th>
                                                <th>Chip ID</th>
                                                <th>Tgl Pemasangan</th>
                                                <th>Tgl Tagihan</th>
                                                <th>Merk Modem</th>
                                                <th>Telp/Hp</th>
                                                <th>User ID</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Alasan Ditolak</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
        });

        var table = $('#data-pelanggan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('getPelangganNotVerify') }}",
                type:"GET",
                data: function (d) {
                    d.perumahan = $('#perumahan').val(),
                    _token = "{{csrf_token()}}"
                }
            },
            columns: [
                {data: 'id_pelanggan', name: 'id_pelanggan'},
                {data: 'nama_pelanggan', name: 'nama_pelanggan'},
                {data: 'alamat', name: 'alamat'},
                {data: 'tagihan', name: 'tagihan'},
                {data: 'paket', name: 'paket'},
                {data: 'tv', name: 'tv'},
                {data: 'sn', name: 'sn'},
                {data: 'chip_id', name: 'chip_id'},
                {data: 'tgl_pemasangan', name: 'tgl_pemasangan'},
                {data: 'tgl_tagihan', name: 'tgl_tagihan'},
                {data: 'merk_modem', name: 'merk_modem'},
                {data: 'telp_hp', name: 'telp_hp'},
                {data: 'user_id', name: 'telp_hp'},
                {data: 'password', name: 'password'},
                {data: 'status', name: 'status'},
                {data: 'message', name: 'message'},
            ]
        });

        $('#perumahan').change(function(){
            table.draw();
        });

    </script>
@endpush