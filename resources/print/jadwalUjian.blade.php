<html>
    <head>
        <meta charset="UTF-8">
        <title>YPI INSAN ISTIQOMAH| Bukti PMB </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		   
        <!-- AdminLTE App -->
		<style>
			table, th, td {
			
			border-collapse: collapse;
			}
			th, td {
			padding: 2px;
			}
			p {
			display: block;
			margin-top: 1em;
			margin-bottom: 1em;
			margin-left: 0;
			margin-right: 0;
			}
			th.center {
			text-align: center;
			}

			th.left {
			text-align: left;
			}

			th.right {
			text-align: right;
			} 

			th.justify {
			text-align: justify;
			} 
		</style>
    </head>
    <body>
	<header>
		<table style="width:100%">
			<tr>
				<th style="width:20%"><center>
							@php
							$image = public_path('old_assets/img/logo_istiqomah.png');
							$imageData = base64_encode(file_get_contents($image));
							$src = 'data:' . mime_content_type($image). ';base64,'.$imageData;
							@endphp
							<img src="{{$src}}" height="100" />
				</th>
				<th style="width:80%">
						<h3 style="margin: -1px">YAYASAN PENDIDIKAN INSAN ISTIQOMAH</h3>
							<h2 style="margin: -1px">TKIT/MI/SDIT AL ISTIQOMAH</h2>
							<p style="font-size:12px">Sekretariat : Rakha Insan Istiqomah Jl Sawo Raya No. 1 Telp. 021-5911784<br>
							TKIT 1.(5913802), TKIT2. (5913591), MI/SDI (5538227), SDIT1 (5913591), SDIT2 (5911784)</p>
				</th></center>
			</tr>
			<hr>
		</table>
	</header>
	<section>
		<center>
		<h4><strong>DATA CALON SISWA JALUR MANDIRI</strong></h4>
		</center>
		@foreach($siswa as $s)
		<table class="left" style="width:100%">
			<tr>
				<th class="left" style="width:30%">	
				Nomor	
				</th>
				<th class="left"  style="width:80%">	
					: {{$s->nomor_induk}}		
				</th>
			</tr>
			<tr>
				<th class="left" style="width:30%">	
					Nama Lengkap		
				</th>
				<th class="left"  style="width:80%">	
					: {{$s->nm_lengkap}}			
				</th>
			</tr>
			<tr>
				<th class="left" style="width:30%">	
					Jenis Kelamin			
				</th>
				<th class="left" style="width:80%">	
					: {{$s->kelamin}}		
				</th>
			</tr>
			<tr>
				<th class="left" style="width:30%">	
					Tanggal Lahir</p>				
				</th>
				<th class="left" style="width:80%">	
					: {{$s->tgl_lahir}}		
				</th>
			</tr>
			<tr>
				<th class="left" style="width:30%">	
					Asal Sekolah			
				</th>
				<th class="left" style="width:80%">	
					: {{$s->asal_sekolah}}
				</th>
			</tr>
			<tr>
				<th class="left" style="width:30%">	
					Pilihan Sekolah Tujuan				
				</th>
				<th class="left" style="width:80%">	
					: {{$s->nama_unit}}
				</th>
			</tr>
			
		</table>
		@endforeach
	</section>

	<section>        
					<div class="row">
						<div class="col-xs-2">
							<p><strong>Catatan :</strong></p>
						</div>
						<div class="col-xs-6">
							<ol>
								<li>Kartu Tanda Bukti tidak boleh Hilang / Rusak</li>
								<li>Kartu ini harus dibawa saat Observasi</li>
								<li>Kartu Tanda Bukti ini digunakan untuk DAFTAR ULANG</li>
							</ol>
						</div>
						<div class="col-xs-4 text-center">
							
							<br />
							<br />
							<br />
							<br />
							<strong></strong>	
						</div>
					</div>
            </section>
            
    
    </body>
</html>