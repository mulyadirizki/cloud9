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
        <h3>Konfirmasi Pembayaran</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
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

    <div class="">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-bars"></i> Data <small>Konfirmasi Pembayaran</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="tab-content" id="myTabContent">
              <div class="form-group  row">
                <div class="col-md-3 col-sm-3">
                  <select name="bulan" id="bulan" class="form-control">
                    <option selected value="Pilih Bulan">Pilih Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Okotber</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
              </div>
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="x_title">
                        <h2><small>Konfirmasi PembayaranBulan</small> Januari</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive"> 
                                    <table id="data-pembayaran" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID Pelanggan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>NET/Mbps</th>
                                                <th>Tgl Pemasangan</th>
                                                <th>Tgl Tagihan</th>
                                                <th>Jml Tagihan</th>
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
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                Food truck fixie locavore, accusamus mcsweeneys marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                    booth letterpress, commodo enim craft beer mlkshk aliquip
              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                xxFood truck fixie locavore, accusamus mcsweeneys marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                    booth letterpress, commodo enim craft beer mlkshk 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
@endsection

@push('script')
    <script type="text/javascript">
      $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
      });

      $('#bulan').on('change', function(){
        let select=$("#bulan").children("option:selected").val();
        var  bulanID = $(this).val();
        $.ajax({
          url: "{{ route('filterBulan') }}",
          type: 'POST',
          dataType: 'JSON',
          data: {
            bulanID: bulanID,
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

        console.log(bulanID);
      });

      $('#bulan').on('change', function() {
        var table = $('#data-pembayaran').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              url:"{{ route('konfirmasi-pembayaran.index') }}",
              data:{
                  _token:"{{csrf_token()}}"
              },
              type:"GET"
          },
          columns: [
              {data: 'id_pelanggan', name: 'id_pelanggan'},
              {data: 'nama_pelanggan', name: 'nama_pelanggan'},
              {data: 'paket', name: 'paket'},
              {data: 'tgl_pemasangan', name: 'tgl_pemasangan'},
              {data: 'tgl_tagihan', name: 'tgl_tagihan'},
              {data: 'tagihan', name: 'tagihan'},
              {data: 'telp_hp', name: 'telp_hp'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
        });
      });
      
      $('#bulan').on('change', function() {
        $(document).on('click', '.btn-konfirmasi', function(){
          var data_id = $(this).data('id');
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Konfirmasi Pembayaran',
            html: `<div class="item form-group">
                    <label class="col-form-label col-md-5 col-sm-5 label-align">Jumlah Dibayar <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" class="form-control has-feedback-left" name="jml_dibayar" id="jml_dibayar">
                        <span class="form-control-feedback left" aria-hidden="true">Rp</span>
                    </div>
                  </div>`,
            inputAttributes: {
                autocapitalize: 'off'
            },
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Konfirmasi',
            cancelButtonText: 'cancel',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                let jml_dibayar = $('#jml_dibayar').val();
                let bulan_dibayar=$("#bulan").children("option:selected").val();
                $.ajax({
                    url: "{{ route('updateStatus') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                      data_id: data_id,
                      jml_dibayar: jml_dibayar,
                      bulan_dibayar: bulan_dibayar,
                    },
                    success:function(hasil) {
                        swalWithBootstrapButtons.fire(
                          'Berhasil!',
                          'Konfirmasi pembayaran berhasil dilakukan',
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
                $('#data-pembayaran').DataTable().ajax.reload();
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelled',
                'Konfirmasi pembayaran dicancel',
                'error'
              )
            }
          })
        })
      })

      $(document).ready(function(){
        $( '#jml_dibayar' ).mask('000.000.000', {reverse: true});
      });

      $(document).on('click', '.btn-cancel', function() {
        var data_id = $(this).data('id');
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
          title: 'Yakin Membatalkan ?',
          text: 'Pembatalan konfirmasi pembayaran',
          inputAttributes: {
              autocapitalize: 'off'
          },
          icon: 'question',
          showCancelButton: true,
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Konfirmasi',
          reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: "{{ route('cancelKonfirmasi') }}",
            data: {
              data_id: data_id
            },
            success: function (data) {
              swalWithBootstrapButtons.fire(
                'Berhasil!',
                'Pembatalan konfirmasi pembayaran berhasil dilakukan',
                'success'
              )
            } 
          });
          
        console.log(data_id);
        $('#data-pembayaran').DataTable().ajax.reload();
        } else if (
          result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Pembatalan Konfirmasi pembayaran dicancel',
              'error'
            )
          }
        })
      });

    </script>
@endpush