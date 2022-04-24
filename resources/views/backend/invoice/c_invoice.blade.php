@extends('backend.default')

@push('meta')
    <meta name="description" content="Website Konfirmasi Pembayaran" />
    <meta name="keywords" content="Website Konfirmasi Pembayaran" />
    <meta name="author" content="CV" />
@endpush

@push('title')
    <title>CloudNine | Print Invoice</title>
@endpush

@section('content')
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Print Invoice</h3>
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
            <h2><i class="fa fa-bars"></i> Print <small>Invoice</small></h2>
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
                            <option selected value="0">Pilih Bulan</option>
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

              <button type="button" class="btn btn-printAll btn-danger btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-print"></i> Print All</button>

              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <?php 
                    $sekarang  =  new DateTime();  
                    $today = $sekarang->format('m');
                    if($today == '04') { ?>
                      <h2><small>Print Invoice </small><span id="nama_bulan">Bulan April</span></h2>
                  <?php }else if($today == '05' ){ ?>
                      <h2><small>Print Invoice </small><span id="nama_bulan">Bulan Mei</span></h2>
                  <?php } ?>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="card-box table-responsive"> 
                                  <table id="cek-pembayaran" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                      <thead>
                                        <tr>
                                          <th>No</th>
                                          <th>ID Pelanggan</th>
                                          <th>Nama Pelanggan</th>
                                          <th>Perumahan</th>
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
  </div>
@endsection

@push('script')
  <script type="text/javascript">
    $.ajaxSetup({
      headers:{
          'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
      },
    });

    var table = $('#cek-pembayaran').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('invoice.index') }}",
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
          {data: 'nama_perumahan', name: 'nama_perumahan'},
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
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
    $('.btn-printAll').click(function(){

      var data = '';
      var perumahan = $('#perumahan').val();
      var bulan = $('#bulan').val();
      $.ajax({
          type: 'GET',
          url: 'invoice/print-all',
          data: {perumahan:perumahan, bulan:bulan},
          responseType: 'arraybuffer',
          xhrFields: {
              responseType: 'blob'
          },
          success: function(response){
            var blob = new Blob([response], {type: 'application/pdf'});
            var link = document.createElement("a");
            var objectURL = window.URL.createObjectURL(blob);
            link.href = objectURL;
            link.target = '_blank';
            (document.body || document.documentElement).appendChild(link);
            link.click();
            console.log(perumahan);
          },
          error: function(blob){
            console.log(blob);
          }
      });
    }) 

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
      var sekarang  =  new Date();  
      var today = sekarang.format('F');
        html += `Bulan `+today;
    }

    $('#nama_bulan').html(html);
    table.draw();
    });

  </script>
@endpush