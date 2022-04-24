@extends('backend.default')

@push('meta')
    <meta name="description" content="Website Konfirmasi Pembayaran" />
    <meta name="keywords" content="Website Konfirmasi Pembayaran" />
    <meta name="author" content="CV" />
@endpush

@push('title')
    <title>CloudNine | Paket</title>
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
        
        <button type="button" class="btn btn-add btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg">Tambah Perumahan</button>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data<small>Perumahan</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="data-perumahan" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Perumahan</th>
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

    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Data Perumahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <div class="modal-body">
                            <div class="x_content">
                                <br />
                                <form id="form-add-update" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" id="id">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Perumahan <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="nama_perumahan" name="nama_perumahan" required="required" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <button class="btn btn-primary" data-dismiss="modal" type="button">Cancel</button>
                                            <button class="btn btn-primary" type="reset">Reset</button>
                                            <button type="submit" id="btn-submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Jika menghapus Data Area maka</b></p>
                    <p>*data tersebut hilang selamanya, apakah anda yakin?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                        Data</button>
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

        var table = $('#data-perumahan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('data-perumahan.index') }}",
                data:{
                    _token:"{{csrf_token()}}"
                },
                type:"GET"
            },
            columns: [
                {
                  data: 'DT_RowIndex', 
                  name: 'DT_RowIndex'
                },
                {data: 'nama_perumahan', name: 'nama_perumahan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('.btn-add').on('click', function() {
            $('#btn-submit').val("create-post"); 
            $('#modal-add').modal('show');
            $('#form-add-update').trigger('reset');
            $('#id').val();
        })

        $('#btn-submit').click(function(event) {
            event.preventDefault();

            let id = $('#id').val();
            let nama_perumahan = $('#nama_perumahan').val();

            $.ajax({
                url: "{{ route('data-perumahan.store') }}",
                type: 'POST',
                data: {
                    id: id,
                    nama_perumahan: nama_perumahan,
                },
                dataType: 'JSON',

                success:function(hasil) {
                    setTimeout(function () {
                        $('#modal-add').modal('hide'); 
                        $('#form-add-update').trigger("reset");
                        var oTable = $('#example').dataTable();
                        oTable.fnDraw(false); 
                    });
                    iziToast.success({ 
                        title: 'Data Berhasil Disimpan',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                },

                error:function(e){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Mohon periksa kembali isian data anda',
                    })
                }
            });

            $('#data-perumahan').DataTable().ajax.reload();
        });

        $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
            $.get('data-perumahan/' + data_id + '/edit ', function (data) {
                $('#modal-judul').html("Edit Post");
                $('#btn-submit').val("edit-post");
                $('#modal-add').modal('show');

                $('#id').val(data.id);
                $('#nama_perumahan').val(data.nama_perumahan);
            })
        });

        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        $('#tombol-hapus').click(function () {
            $.ajax({
                url: "data-perumahan/" + dataId, 
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); 
                },
                success: function (data) { 
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); 
                        var oTable = $('#data-perumahan').dataTable();
                        oTable.fnDraw(false); 
                    });
                    iziToast.success({ 
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('delete')}}',
                        position: 'bottomRight'
                    });
                },
                error:function(e){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Gagal dihapus',
                        text: 'Data Perumahan gagal di hapus, Nama perumahan tersebut digunakan di data pelanggan',
                    })
                    $('#konfirmasi-modal').modal('hide'); 
                }
            })
            $('#data-perumahan').DataTable().ajax.reload();
        });
    </script>
@endpush