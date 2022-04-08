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
                        <h2>Data<small>Pelanggan Dihapus</small></h2>
                        <div class="form-group float-right row">
                            <select name="area" id="area" class="form-control">
                                <option selected value="Pilih Area">Pilih Area</option>
                                @foreach($area as $value) 
                                    <option value="{{ $value->id }}"> {{ strtoupper($value->nama_area) }}</option>
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
                                                <th>Merk Modem</th>
                                                <th>SN Modem</th>
                                                <th>TV</th>
                                                <th>Serial Number</th>
                                                <th>Chip ID</th>
                                                <th>Tgl Pemasangan</th>
                                                <th>Jatuh Tempo Tgl</th>
                                                <th>Telp/Hp</th>
                                                <th>User ID</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Alasan Dihapus</th>
                                                <th>Operator</th>
                                                <th>Action</th>
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
                url:"{{ route('getPelangganTerputus') }}",
                data:{
                    _token:"{{csrf_token()}}"
                },
                type:"GET"
            },
            columns: [
                {data: 'id_pelanggan', name: 'id_pelanggan'},
                {data: 'nama_pelanggan', name: 'nama_pelanggan'},
                {data: 'alamat', name: 'alamat'},
                {data: 'tagihan', name: 'tagihan'},
                {data: 'paket', name: 'paket'},
                {data: 'merk_modem', name: 'merk_modem'},
                {data: 'sn_modem', name: 'sn_modem'},
                {data: 'tv', name: 'tv'},
                {data: 'sn', name: 'sn'},
                {data: 'chip_id', name: 'chip_id'},
                {data: 'tgl_pemasangan', name: 'tgl_pemasangan'},
                {data: 'tgl_tagihan', name: 'tgl_tagihan'},
                {data: 'telp_hp', name: 'telp_hp'},
                {data: 'user_id', name: 'user_id'},
                {data: 'password', name: 'password'},
                {data: 'status', name: 'status'},
                {data: 'message', name: 'message'},
                {data: 'log_petugas', name: 'log_petugas'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#area').on('change', function(){
            let select=$("#area").children("option:selected").val();
            var  areaID = $(this).val();
            $.ajax({
                url: "{{ route('areaPelanggan') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    areaID: areaID,
                },
                success: function(data) {
                    console.log(data);
                    $('#data-pelanggan tbody').children().remove();
                    var tableROW =  '<tr>';
                    $.each(data, function(i, item){
                        tableROW += '<tr>';
                            tableROW += 	'<td class="text-center">'+item.id_pelanggan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.nama_pelanggan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.alamat+'</td>';
                            tableROW += 	'<td class="text-center">'+item.tagihan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.paket+'</td>';
                            tableROW += 	'<td class="text-center">'+item.merk_modem+'</td>';
                            tableROW += 	'<td class="text-center">'+item.sn_modem+'</td>';
                            tableROW += 	'<td class="text-center">'+item.tv+'</td>';
                            tableROW += 	'<td class="text-center">'+item.sn+'</td>';
                            tableROW += 	'<td class="text-center">'+item.chip_id+'</td>';
                            tableROW += 	'<td class="text-center">'+item.tgl_pemasangan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.tgl_tagihan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.telp_hp+'</td>';
                            tableROW += 	'<td class="text-center">'+item.user_id+'</td>';
                            tableROW += 	'<td class="text-center">'+item.password+'</td>';
                            tableROW += 	'<td class="text-center"><a href="javascript:void(0)" data-toggle="tooltip" data-id="'+item.id+'" data-status="'+item.id+'" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a><button class="delete btn btn-danger btn-sm" data-id="'+item.id+'" data-status="'+item.id+'" type="button"><i class="far fa-trash-alt"></i> Delete</button> </td>';
                        tableROW += '</tr>';
                    });
                    $('#data-pelanggan tbody').html(tableROW);
                    if(select=="Pilih Area"){
                        $('#data-pelanggan').DataTable().ajax.reload();
                    }
                }
                
            });
        });

        $(document).on('click', '.delete', function () {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
              
            swalWithBootstrapButtons.fire({
                title: 'Hapus Pelanggan?',
                text: "Verifikasi persetujuan hapus pelanggan",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    dataId = $(this).attr('id');
                    $.ajax({
                        url: "terputus/"+ dataId + "/delete",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {id_pelanggan: dataId},
                        success:function(hasil) {
                            swalWithBootstrapButtons.fire(
                                'Berhasil',
                                'Pelanggan Berhasil dihapus',
                                'success'
                            )
                        },
        
                        error:function(e){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Server Error',
                            })
                        }
                    });
                    console.log(dataId);
                    $('#data-pelanggan').DataTable().ajax.reload();
                } else if (
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                  )
                }
            })
        });

    </script>
@endpush