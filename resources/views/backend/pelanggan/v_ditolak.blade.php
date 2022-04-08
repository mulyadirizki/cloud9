@extends('backend.default')

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
                        <h2>Data<small>Pelanggan Verifikasi Ditolak</small></h2>
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
                                                <th>Alasan Ditolak</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <div class="modal-body">
                            <div class="x_content">
                                <br />
                                <form id="form-pelanggan" id="form-add-update" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_pelanggan" id="id_pelanggan">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_pelanggan">Nama Pelanggan <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" required="required" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="area">Perumahan <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" id="perumahan" name="perumahan" required="required" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Alamat <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Tagihan <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            {{--  <input type="text" name="tagihan" id="tagihan"  data-a-sign="Rp. " data-a-dec="," data-a-sep="." class="form-control">  --}}
                                            <input type="text" class="form-control has-feedback-left" name="tagihan" id="tagihan">
                                            <span class="form-control-feedback left" aria-hidden="true">Rp</span>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">NET/Mbps <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="paket" id="paket" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Merk Modem </label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="merk_modem" id="merk_modem" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">SN Modem</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="sn_modem" id="sn_modem" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tv">TV </label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <select name="tv" id="tv" class="form-control" onchange="choseTv()">
                                                <option selected type value="0">Pilih Tv</option>
                                                <option value="1" {{ @old('tv') == 1 ? 'selected' : '' }}>TV Digital</option>
                                                <option value="2" {{ @old('tv') == 2 ? 'selected' : '' }}>TV Box</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Serial Number</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" disabled name="sn" id="sn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Chip ID</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" disabled name="chip_id" id="chip_id" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Tgl Pemasangan <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input name="tgl_pemasangan" id="tgl_pemasangan" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                            <script>
                                                function timeFunctionLong(input) {
                                                    setTimeout(function() {
                                                        input.type = 'text';
                                                    }, 60000);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Jatuh Tempo Tgl <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="tgl_tagihan" id="tgl_tagihan" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Telp/Hp <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="telp_hp" id="telp_hp" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">User ID</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="user_id" id="user_id" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Password</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />
                                            
                                            <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                                <i id="slash" class="fa fa-eye-slash"></i>
                                                <i id="eye" class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <div class="col-md-8 col-sm-6 offset-md-3">
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

    <div class="modal fade" id="modal-import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Data Pelanggan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <div class="modal-body">
                            <div class="x_content">
                                <br />
                                <form id="demo-form1" id="form-add-update" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                    {{ csrf_field() }}
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_pelanggan">File <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="file" id="files" name="files" required="required" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <div class="col-md-8 col-sm-6 offset-md-3">
                                            <button class="btn btn-primary" type="button">Cancel</button>
                                            <button type="submit" id="btn-import" class="btn btn-success">Submit</button>
                                            
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
                url:"{{ route('data-pelanggan.verifikasi-ditolak') }}",
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

        $(document).ready(function(){
            $( '#tagihan' ).mask('000.000.000', {reverse: true});
        })

        function choseTv() {
            $("#tv").removeAttr("selected");
            let status = $("#tv option:selected").val();
            let html = "";
            let select=$("#tv").children("option:selected").val();

            if(select=="0"){
                $('#sn').prop('disabled', true).val('');
                $('#chip_id').prop('disabled', true).val('');
                console.log(select)
            }else{
                $('#sn').prop('disabled', false);
                $('#chip_id').prop('disabled', false);
            }
           
        }

        $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
            $.get('ditolak/' + data_id + '/edit', function (data) {
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
                $('#merk_modem').val(data.merk_modem);
                $('#sn_modem').val(data.sn_modem);
                $('#tv').val(data.tv);
                $('#sn').val(data.sn);
                $('#chip_id').val(data.chip_id);
                $('#tgl_pemasangan').val(data.tgl_pemasangan);
                $('#tgl_tagihan').val(data.tgl_tagihan);
                $('#telp_hp').val(data.telp_hp);
                $('#user_id').val(data.user_id);
                $('#password').val(data.password);

                let select=$("#tv").children("option:selected").val();
                if(select==1 || select==2){
                    $('#sn').prop('disabled', false);
                    $('#chip_id').prop('disabled', false);
                }
                
            })
        });

        $('#btn-submit').click(function(event) {
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

            $.ajax({
                url: "{{ route('updatePelangganDitolak') }}",
                type: 'POST',
                data: {
                    id_pelanggan: id_pelanggan,
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
                },
                dataType: 'JSON',

                success:function(hasil) {
                    setTimeout(function () {
                        $('#modal-add').modal('hide'); 
                        $('#form-pelanggan').trigger("reset"); //form reset
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
            $('#data-pelanggan').DataTable().ajax.reload();
        });

        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        $('#tombol-hapus').click(function () {
            $.ajax({
                url: "ditolak/" + dataId + "/delete", 
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); 
                },
                success: function (data) { 
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); 
                        var oTable = $('#data-pelanggan').dataTable();
                        oTable.fnDraw(false); 
                    });
                    iziToast.success({ 
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('delete ')}}',
                        position: 'bottomRight'
                    });
                },
                error: function (data) { 
                    iziToast.warning({ 
                        title: 'Data Gagal Dihapus',
                        message: '{{ Session('delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
            $('#data-pelanggan').DataTable().ajax.reload();
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