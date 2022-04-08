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
                                                <th>Tgl Pemasangan</th>
                                                <th>Tgl Tagihan</th>
                                                <th>Telp/Hp</th>
                                                <th>Status</th>
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
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Data Pelanggan Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <div class="modal-body">
                            <div class="x_content">
                                <br />
                                <form data-parsley-validate class="form-horizontal form-label-left" method="POST" id="form-tambah-edit" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div>
                                        <div class='col-sm-3'>
                                            ID Pelanggan
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker'>
                                                    <input type='text' readonly id="id_pelanggan" readonly name="id_pelanggan" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class='col-sm-3'>
                                            Nama Pelanggan
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="nama_pelanggan" name="nama_pelanggan" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-sm-3'>
                                            Perumahan
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="perumahan" name="perumahan" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-sm-3'>
                                            Alamat
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="alamat" name="alamat" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class='col-sm-3'>
                                            Tagihan
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker'>
                                                    <input type='text' readonly id="tagihan" name="tagihan" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class='col-sm-3'>
                                            NET/Mbps
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="paket" name="paket" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-sm-3'>
                                            Merk Modem
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="merk_modem" name="merk_modem" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-sm-3'>
                                            SN Modem
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="sn_modem" name="sn_modem" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class='col-sm-4'>
                                            TV
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker'>
                                                    <input type='text' readonly id="tv" name="tv" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class='col-sm-4'>
                                            Serial Number
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="sn" name="sn" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-sm-4'>
                                            Chip ID
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="chip_id" name="chip_id" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class='col-sm-4'>
                                            Tgl Pemasangan
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker'>
                                                    <input type='text' readonly id="tgl_pemasangan" name="tgl_pemasangan" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class='col-sm-4'>
                                            Tgl Tagihan
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="tgl_tagihan" name="tgl_tagihan" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-sm-4'>
                                            Telp/HP
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="telp_hp" name="telp_hp" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class='col-sm-4'>
                                            User ID
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker'>
                                                    <input type='text' readonly id="user_id" name="user_id" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class='col-sm-4'>
                                            Password
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input class="form-control" readonly type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />
                                            
                                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                                        <i id="slash" class="fa fa-eye-slash"></i>
                                                        <i id="eye" class="fa fa-eye"></i>
                                                    </span> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-sm-4'>
                                            Status
                                            <div class="form-group">
                                                <div class='input-group date' id='myDatepicker2'>
                                                    <input type='text' readonly id="status" name="status" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-8 col-sm-6 offset-md-3">
                                        <button class="btn btn-primary" data-dismiss="modal" type="button">Cancel</button>
                                        <button type="button" id="btn-koreksi" class="btn btn-warning">Koreksi</button>
                                        <button type="submit" id="btn-verifikasi" class="btn btn-success">Verifikasi</button>
                                    </div>
                                </div>
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
                    <p><b>Jika menghapus Data Pelanggan maka</b></p>
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

        var table = $('#data-pelanggan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('getPelangganNew') }}",
                data:{
                    _token:"{{csrf_token()}}"
                },
                type:"GET"
            },
            columns: [
                {data: 'id_pelanggan', name: 'id_pelanggan'},
                {data: 'nama_pelanggan', name: 'nama_pelanggan'},
                {data: 'alamat', name: 'alamat'},
                {data: 'tgl_pemasangan', name: 'tgl_pemasangan'},
                {data: 'tgl_tagihan', name: 'tgl_tagihan'},
                {data: 'telp_hp', name: 'telp_hp'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
            $.get('pelanggan/' + data_id + '/verifikasi', function (data) {
                $('#modal-judul').html("Edit Post");
                $('#btn-submit').val("edit-post");
                $('#modal-add').modal('show');
                $('#form-add-update').trigger('reset');

                $('#id_pelanggan').val(data.id_pelanggan);
                $('#nama_pelanggan').val(data.nama_pelanggan);
                $('#perumahan').val(data.perumahan);
                $('#alamat').val(data.alamat);
                $('#tagihan').val(data.tagihan);
                $('#paket').val(data.paket);
                $('#tv').val(data.tv);
                $('#sn').val(data.sn);
                $('#chip_id').val(data.chip_id);
                $('#tgl_pemasangan').val(data.tgl_pemasangan);
                $('#tgl_tagihan').val(data.tgl_tagihan);
                $('#merk_modem').val(data.merk_modem);
                $('#telp_hp').val(data.telp_hp);
                $('#user_id').val(data.user_id);
                $('#password').val(data.password);
                $('#status').val(data.status);
                
            })

            console.log(data_id);
        });

        $('#btn-verifikasi').click(function(event) {
            event.preventDefault();

            let id_pelanggan = $('#id_pelanggan').val();
            let nama_pelanggan = $('#nama_pelanggan').val();
            let perumahan = $('#perumahan').val();
            let alamat = $('#alamat').val();
            let tagihan = $('#tagihan').val();
            let paket = $('#paket').val();
            let merk_modem = $('#merk_modem').val();
            let sn_modem = $('#sn_modem').val();
            let tv = $('#tv').val();
            let sn = $('#sn').val();
            let chip_id = $('#chip_id').val();
            let tgl_pemasangan = $('#tgl_pemasangan').val();
            let tgl_tagihan = $('#tgl_tagihan').val();
            let telp_hp = $('#telp_hp').val();
            let user_id = $('#user_id').val();
            let password = $('#password').val();
            let status = $('#status').val();

            $.ajax({
                url: "pelanggan/verifikasi/store/" + id_pelanggan,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    nama_pelanggan: nama_pelanggan,
                    perumahan: perumahan,
                    alamat: alamat,
                    tagihan: tagihan,
                    paket: paket,
                    merk_modem: merk_modem,
                    sn_modem: sn_modem,
                    tv: tv,
                    sn: sn,
                    chip_id: chip_id,
                    tgl_pemasangan: tgl_pemasangan,
                    tgl_tagihan: tgl_tagihan,
                    telp_hp: telp_hp,
                    user_id: user_id,
                    password: password,
                    status: status,
                },
                success:function(hasil) {
                    setTimeout(function () {
                        $('#modal-add').modal('hide'); 
                        var oTable = $('#example').dataTable();
                        oTable.fnDraw(false); 
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Pelanggan Berhasil di Verifikasi',
                      })
                },

                error:function(e){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Verifikasi Pelanggan Gagal',
                    })
                }
            });
            $('#data-pelanggan').DataTable().ajax.reload();
        });

        $('#btn-koreksi').click(function(event) {
            setTimeout(function () {
                $('#modal-add').modal('hide'); 
                var oTable = $('#example').dataTable();
                oTable.fnDraw(false); 
            });
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })
              
              swalWithBootstrapButtons.fire({
                html: `<div class='col-sm-12'>
                    Pesan koreksi inputan kesalahan pelanggan
                    <div class="form-group">
                        <div class='input-group date' id='messages'>
                            <textarea name="message" id="message" class="form-control" ></textarea> 
                        </div>
                    </div>
                </div>`,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Kirim Pesan',
                cancelButtonText: 'cancel',
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                    let id_pelanggan = $('#id_pelanggan').val();
                    let message = $('#message').val();
                    $.ajax({
                        url: "{{ route('pelanggan.koreksiProses') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id_pelanggan : id_pelanggan,
                            message: message,
                        },
                        success:function(hasil) {
                            swalWithBootstrapButtons.fire(
                                'Terkirim',
                                'Pesan Berhasil Terkirim',
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
                    $('#data-pelanggan').DataTable().ajax.reload();
                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Pesan di cancel',
                    'error'
                  ),
                  setTimeout(function () {
                    $('#modal-add').modal('show'); 
                    var oTable = $('#example').dataTable();
                    oTable.fnDraw(false); 
                    });
                }
              })
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
                            tableROW += 	'<td class="text-center">'+item.id+'</td>';
                            tableROW += 	'<td class="text-center">'+item.nama_pelanggan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.nama_area+'</td>';
                            tableROW += 	'<td class="text-center">'+item.alamat+'</td>';
                            tableROW += 	'<td class="text-center">'+item.tagihan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.paket+'</td>';
                            tableROW += 	'<td class="text-center">'+item.tv+'</td>';
                            tableROW += 	'<td class="text-center">'+item.sn+'</td>';
                            tableROW += 	'<td class="text-center">'+item.chip_id+'</td>';
                            tableROW += 	'<td class="text-center">'+item.tgl_pemasangan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.tgl_tagihan+'</td>';
                            tableROW += 	'<td class="text-center">'+item.telp_hp+'</td>';
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

        function hideshow(){
			var password = document.getElementById("password");
			var slash = document.getElementById("slash");
			var eye = document.getElementById("eye");
			
			if(password.type === 'password'){
				password.type = "text";
				slash.style.display = "block";
				eye.style.display = "none";
			}
			else{
				password.type = "password";
				slash.style.display = "none";
				eye.style.display = "block";
			}

		}

        $("#telp_hp").keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });	

    </script>
@endpush