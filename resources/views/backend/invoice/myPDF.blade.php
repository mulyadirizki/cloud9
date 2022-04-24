<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Cetak invoice</title>
	<style type="text/css">
		
		@page {
			size: A4;
		}
		
  
        body{
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
            font-family: 'Times New Roman', Times, serif;
        }

		* {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}

		.header{
			position: relative;
		}

		.header .h-p1{
			font-size: 12pt;
			line-height: normal;
			margin-top: 80px;
		}

		.content{
			margin-top: -20px;
		}

		.content .sub-cont-1{
			position: relative;
		}

		.content .sub-p1{
			line-height: normal;
			right: 0;
		}

		.content .sub-p1 .sp-1{
			margin-left: 46px;
		}

		.content .sub-p1 .sp-2{
			margin-left: 26px;
		}

		.content .sub-p2{
			line-height: normal;
			right: 73px;
			position: absolute;
			top: -16px;
		}

		
		.content .sub-cont-2{
			position: relative;
			margin-top: -20px;
		}

		.content .sub-p3{
			line-height: normal;
		}
		.content .sub-p3 .sp-3{
			margin-left: 21px;
		}

		.content .sub-p3 .sp-6{
			margin-left: 3px;
		}

		.content .sub-p3 .sp-4{
			margin-left: 17px;
		}

		.content .sub-p4{
			position: absolute;
			right: 31px;
			top: -17px;
		}

		.content .sub-p6{
			line-height: normal;
			margin-top: -10px;
		}

		.content .sub-p7{
			line-height: normal;
			margin-top: -10px;
		}

		.content .sub-cont-4{
			margin-top: -18px;
		}

		.content .sub-cont-5{
			position: relative;
			margin-top: -20px;
		}

		.content .sub-cont-5 .sub-p9{
			position: absolute;
			left: 180px;
			top: 2px;
		}

		.content .sub-cont-5 .sub-p10{
			position: absolute;
			right: 0;
			top: -18px;
		}

		.head-img {
			position: relative;
		}

		.head-img .img-gti{
			width: 32%;
			position: absolute;
			top: 10px;
		}
		.head-img .img-fiber{
			position: absolute;
			right: 0;
			width: 28%;
		}
		.head-img .img-palapa{
			position: absolute;
			right: 20px;
			top: 25px;
			width: 22%;
		}
	</style>
</head>
<body>
	@foreach ($data as $key => $item)
		<div class="page">
			<div class="header">
				<div class="head-img">
					<img class="img-gti" src="{{ ('assets/images/print-img/gti.png') }}" alt="grahakomindo">
					<img class="img-fiber" src="{{ ('assets/images/print-img/fiber.png') }}" alt="fiberme">
					<img class="img-palapa" src="{{ ('assets/images/print-img/palapa.png') }}" alt="palapa">
				</div>
				<p class="h-p1">
					Ruko Marbela 2 Blok D2 No 10 <br>
					BUKTI PEMBAYARAN TAGIHAN INTERNET & TV
				</p>
			</div>
			<div class="content">
				<div class="sub-cont-1">
					<p class="sub-p1">
						NAMA 	<span class="sp-1">:</span> {!! $item->nama_pelanggan !!} <br>
						ALAMAT 	<span class="sp-2">:</span> {!! $item->nama_perumahan. ' ' .$item->alamat !!}
					</p>
					<p class="sub-p2">
						No : <?php $kode = sprintf("%04s", $key+1); echo $kode; ?> <br>
					</p>
				</div>
				<div class="sub-cont-2">
					<p class="sub-p3">
						Segmentasi  <span class="sp-3">:</span> INTERNET <br>
						ID. Pelanggan <span class="sp-6">:</span> {!! $item->id_pelanggan !!} <br>
						Bulan Tagihan : 01-30 <?php 
												if($bulan==1) { 
													echo 'Januari'; 
												} else if($bulan==2){
													echo 'Februari';
												}else if($bulan==3){
													echo 'Maret';
												}else if($bulan==4){
													echo 'April';
												}else if($bulan==5){
													echo 'Mei';
												}else if($bulan==6){
													echo 'Juni';
												}else if($bulan==7){
													echo 'Juli';
												}else if($bulan==8){
													echo 'Agustus';
												}else if($bulan==9){
													echo 'September';
												}else if($bulan==10){
													echo 'Oktober';
												}else if($bulan==11){
													echo 'November';
												}else if($bulan==12){
													echo 'Desember';
												}else{
													$sekarang  =  new DateTime();  
                    								$today = $sekarang->format('F');
													echo $today;
												}
											?> <?php $sekarang  =  new DateTime();  
													$today = $sekarang->format('Y');
													echo $today; ?>  <br>
						Telepon/HP	<span class="sp-4">:</span> {!! $item->telp_hp !!} 
					</p>
					<p class="sub-p4">
						TOTAL TAGIHAN BULAN INI : Rp. {!! number_format($item->tagihan) !!}
					</p>
				</div>
				<div class="sub-cont-4">
					<p class="sub-p5">
						PT. Grahakomindo menyatakan struk ini sebagai bukti pembayaran yang sah. <br>
					</p>
					<p class="sub-p6">
						LAYANAN INFORMASI DAN GANGGUAN   : <br>
						0853 5226 8868, 0852 7481 6958, 0821 7375 1950
					</p>
					<p class="sub-p7">
						Terima kasih kami ucapkan kepada semua pelanggan setia Grahakomindo yang sudah bergabung dengan kami.
					</p>
				</div>
				<div class="sub-cont-5">
					<p class="sub-p8">
						Kolector<br><br><br>
						_____________________
					</p>
					<p class="sub-p9">
						Batam, ………/………./<?php $sekarang  =  new DateTime();$today = $sekarang->format('Y'); echo $today; ?>
					</p>
					<p class="sub-p10">
						Pelanggan <br><br><br>
						_____________________
					</p>
				</div>
			</div>
		</div>
		<br><br>
		<div id="line"></div>
	@endforeach
</body>
</html>