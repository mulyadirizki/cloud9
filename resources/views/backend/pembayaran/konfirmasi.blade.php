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
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-bars"></i> Data <small>Pembayaran</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="tab-content" id="myTabContent">
              <div class="row">

                <div class='col-sm-4'>
                    Perumahan
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker'>
                            <select name="perumahan" id="perumahan" class="form-control">
                              <option value="0">Pilih Perumahan</option>
                              @foreach($perumahan as $value) 
                                <option value="{{ $value->id }}"> {{ strtoupper($value->nama_perumahan) }}</option>
                              @endforeach;
                            </select>
                        </div>
                    </div>
                </div>

                <div class='col-sm-4'>
                    Bulan Pembayaran
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker2'>
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
                </div>
              </div>
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <h2><small>Konfirmasi Pembayaran </small><span id="nama_bulan">Semua Bulan</span></h2>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="card-box table-responsive"> 
                                  <table id="data-pembayaran" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                            <th>No</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Telp/Hp</th>
                                            <th>Perumahan</th>
                                            <th>Alamat</th>
                                            <th>NET/Mbps</th>
                                            <th>Jml Tagihan</th>
                                            <th>Jml Bayar</th>
                                            <th>Bulan Pembayaran</th>
                                            <th>Tgl Bayar</th>
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
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-bars"></i> Data <small>Pelanggan</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container">
              <div class="row">

                <div class='col-sm-4'>
                  Nama Pelanggan
                  <div class="form-group">
                    <div class='input-group date'>
                      <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control">
                      <div id="pelangganList"></div>
                    </div>
                  </div>
                </div>

                <div class='col-sm-4'>
                    ID Pelanggan
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='text' class="form-control" readonly id="id_pelanggan" name="id_pelanggan" />
                        </div>
                    </div>
                </div>
                
                <div class='col-sm-4'>
                  Perumahan
                  <div class="form-group">
                      <div class='input-group date'>
                        <input type='text' class="form-control" readonly id="perumahan" name="perumahan"/>
                      </div>
                  </div>
                </div>
                
                <div class='col-sm-4'>
                  Alamat
                  <div class="form-group">
                      <div class='input-group date'>
                        <input type='text' class="form-control" readonly id="alamat" name="alamat" />
                      </div>
                  </div>
                </div>
                
                <div class='col-sm-4'>
                  NET/Mbps
                  <div class="form-group">
                    <div class='input-group date' id='datetimepicker6'>
                        <input type='text' class="form-control" readonly id="paket" name="paket" />
                    </div>
                  </div>
                </div>

                <div class='col-sm-4'>
                  Tanggal Pemasangan
                  <div class="form-group">
                    <div class='input-group date'>
                        <input type='text' class="form-control" readonly id="tgl_pemasangan" name="tgl_pemasangan"/>
                    </div>
                  </div>
                </div>

                <div class='col-sm-4'>
                  Tanggal Tagihan
                  <div class="form-group">
                    <div class='input-group date'>
                        <input type='text' class="form-control" readonly id="tgl_tagihan" name="tgl_tagihan"/>
                    </div>
                  </div>
                </div>

                <div class='col-sm-4'>
                  Jumlah Tagihan
                  <div class="form-group">
                    <div class='input-group date'>
                        <input type='text' class="form-control" readonly id="tagihan" name="tagihan"/>
                    </div>
                  </div>
                </div>

                <div class='col-sm-4'>
                  Telp/Hp
                  <div class="form-group">
                    <div class='input-group date'>
                        <input type='text' class="form-control" readonly id="telp_hp" name="telp_hp"/>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-bars"></i> Pembayaran <small>Konfirmasi</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container">
              <form id="form-pembayaran" id="form-add-update" method="post" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                <div class="row">
                  <div class='col-sm-4'>
                    Bulan
                    <div class="form-group">
                        <div class='input-group date'>
                          <select name="bulan_dibayar" id="bulan_dibayar" class="form-control">
                            <option selected>Pilih Bulan</option>
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
                  </div>

                  <div class='col-sm-4'>
                    Jumlah Dibayar
                    <div class="item form-group">
                      <div class="col-md-12">
                          <input type="text" class="form-control has-feedback-left" name="jml_dibayar" id="jml_dibayar">
                          <span class="form-control-feedback left" aria-hidden="true">Rp</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class='col-sm-4'>
                    Tgl Pembayaran
                    <div class="form-group">
                        <div class='input-group date'>
                          <input type='date' class="form-control" id="tgl_pembayaran" name="tgl_pembayaran"/>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                  <div class="col-md-1 col-sm-2 offset-md-10">
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
  <div class="clearfix"></div>
@endsection

@push('script')
  <script type="text/javascript">
    $.ajaxSetup({
      headers:{
          'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
      },
    });

    $(document).ready(function() {
      $('#nama_pelanggan').autocomplete({
        source: function(request, response){
          $.ajax({
            url: "{{ route('konfirmasi-pembayaran.search') }}",
            type: 'POST',
            dataType: 'json',
            data: {
              nama_pelanggan: request.term
            },
            success:function(data) {
              response(data);
            }
          });
        },
        select:function(event, ui){
          $('#nama_pelanggan').val(ui.item.label);

          $('#id_pelanggan').val(ui.item.id_pelanggan);
          $('#perumahan').val(ui.item.nama_perumahan);
          $('#alamat').val(ui.item.alamat);
          $('#paket').val(ui.item.paket);
          $('#tgl_pemasangan').val(ui.item.tgl_pemasangan);
          $('#tgl_tagihan').val(ui.item.tgl_tagihan);
          $('#tagihan').val(ui.item.tagihan);
          $('#telp_hp').val(ui.item.telp_hp);
          return false;
        }
      });
    })

    $('#btn-submit').click(function(event) {
      event.preventDefault();

      let id_pelanggan = $('#id_pelanggan').val();
      let jml_dibayar = $('#jml_dibayar').val();
      let bulan_dibayar = $('#bulan_dibayar').val();
      let tgl_pembayaran = $('#tgl_pembayaran').val();
      $.ajax({
        url: "{{ route('konfirmasi-pembayaran.proses') }}",
        type: 'POST',
        dataType: 'JSON',
        data:{
          id_pelanggan: id_pelanggan,
          jml_dibayar: jml_dibayar,
          bulan_dibayar: bulan_dibayar,
          tgl_pembayaran: tgl_pembayaran
        },
        success:function(hasil){
          $('#nama_pelanggan').val('');
          $('#id_pelanggan').val('');
          $('#perumahan').val('');
          $('#alamat').val('');
          $('#paket').val('');
          $('#tgl_pemasangan').val('');
          $('#tgl_tagihan').val('');
          $('#tagihan').val('');
          $('#telp_hp').val('');

          $('#form-pembayaran').trigger('reset');
          $('#data-pembayaran').DataTable().ajax.reload();
          iziToast.success({ 
              title: 'Konfirmas Pembayaran Berhasil',
              message: '{{ Session('')}}',
              position: 'bottomRight'
          });
        },
        error:function(e){
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Silhakan Pilih nama pelanggan terlebih dahulu',
          })
      }
      });
      console.log(id_pelanggan);
    });
          

    var table = $('#data-pembayaran').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "{{ route('konfirmasi-pembayaran.index') }}",
        data: function (d) {
              d.perumahan = $('#perumahan').val(),
              d.bulan = $('#bulan').val(),
              _token = "{{csrf_token()}}"
          }
      },
      columns: [
        {
          data: 'DT_RowIndex', 
          name: 'DT_RowIndex'
        },
        {data: 'id_pelanggan', name: 'id_pelanggan'},
        {data: 'nama_pelanggan', name: 'nama_pelanggan'},
        {data: 'telp_hp', name: 'telp_hp'},
        {data: 'nama_perumahan', name: 'nama_perumahan'},
        {data: 'alamat', name: 'alamat'},
        {data: 'paket', name: 'paket'},
        {data: 'tagihan', name: 'tagihan'},
        {data: 'jml_dibayar', name: 'jml_dibayar'},
        {data: 'bulan_dibayar', name: 'bulan_dibayar'},
        {data: 'tgl_pembayaran', name: 'tgl_pembayaran'},
        {data: 'status', name: 'status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });

    $('#perumahan').change(function(){
      table.draw();
    });

    $('#bulan').change(function(){
      var bulan = $('#bulan').val();
      var html = '';
      if(bulan == 1){
       html += `Bulan Januari`;
      }else if(bulan == 2){
        html += `Bulan Februari`;
      }else if(bulan == 2){
        html += `Bulan Februari`;
      }else if(bulan == 3){
        html += `Bulan Maret`;
      }else if(bulan == 4){
        html += `Bulan April`;
      }else if(bulan == 5){
        html += `Bulan Mei`;
      }else if(bulan == 6){
        html += `Bulan Juni`;
      }else if(bulan == 7){
        html += `Bulan Juli`;
      }else if(bulan == 8){
        html += `Bulan Agustus`;
      }else if(bulan == 9){
        html += `Bulan September`;
      }else if(bulan == 10){
        html += `Bulan Oktober`;
      }else if(bulan == 11){
        html += `Bulan November`;
      }else if(bulan == 22){
        html += `Bulan Desember`;
      }else{
        html += `Semua Bulan`;
      }

      $('#nama_bulan').html(html);
      table.draw();
    });

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
          type: 'delete',
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