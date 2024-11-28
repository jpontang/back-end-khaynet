<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>YPI INSAN ISTIQOMAH| Kartu ujian </title>
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
			.border {
				border: 1px;
			}
			
		</style>
    </head>
    <body>
	<header>
		<table style="width:100%">
			<tr>
				<th style="width:20%"><center>
							
							<img src="#" height="80" />
				</th>
				<th style="width:80%">
						<h3 style="margin: -1px">YAYASAN PENDIDIKAN INSAN ISTIQOMAH</h3>
							<h2 style="margin: -1px">TKIT/MI/SDIT AL ISTIQOMAH</h2>
							<p style="font-size:12px; margin: -1px;">Sekretariat : Rakha Insan Istiqomah Jl Sawo Raya No. 1 Telp. 021-5538227</p>
				</th></center>
			</tr>
			
		</table>
		<hr>
	</header>
	<section>
		<center>
		<h4 style="margin: 5px"><strong>JADWAL UJIAN SEKOLAH</strong></h4>
		</center>
		@foreach($siswa as $s)
		<table class="left" style=' font-size:12px; width:100%;' >
			<tr>
				<th class="left" style="width:30%">	
				Nomor Induk	
				</th>
				<th class="left"  style="width:80%">	
					: 	 {{$s->nomor_induk}}
				</th>
			</tr>
			<tr>
				<th class="left" style="width:30%">	
					Nama Lengkap		
				</th>
				<th class="left"  style="width:80%">	
					: 	{{$s->nm_siswa}}		
				</th>
			</tr>
			<tr>
				<th class="left" style="width:30%">	
					Sekolah			
				</th>
				<th class="left" style="width:80%">	
					: {{$s->nama_unit}}
				</th>
			</tr>
			<tr>
				<th class="left" style="width:30%">	
					Kelas				
				</th>
				<th class="left" style="width:80%">	
					: {{$s->nama_kelas}}
				</th>
			</tr>
			
		</table>
		@endforeach
	</section>
	<section class="jadwal">
	<!-- {{$jadwal}}
	 -->
		<table class="left" border="1"  style='font-family:"Courier New", Courier, monospace; font-size:60%; width:100%;'>
			<tr>
				<th style="width:20%">Hari</th>
				<th style="width:10%">jam</th>
				<th style="width:60%">Mata Pelajaran</th>
				<th style="width:10%">Paraf</th>
			</tr>
			@foreach($jadwal as $j)
			<tr >
			
				<td style=" padding-top: 5px;  padding-bottom: 5px;">
				<?php 
						$inputHari =$j->hari;
						$OutHari = '';
					
						switch ($inputHari) {             
									case 'sunday':$OutHari ='Minggu';break; //formulir   
									case 'Monday':$OutHari ='Senin';break; //formulir
									case 'Tuesday':$OutHari ='Selasa';break; //PPDB
									case 'Wednesday':$OutHari ='Rabu';break; //SPP
									case 'Thursday':$OutHari ='Kamis';break; //DPP
									case 'Friday':$OutHari ='Jumat';break; //DPP
									case 'Saturday':$OutHari ='Jumat';break; //DPP
					
								default:
									$OutHari ='Tidak di ketahui';
									break;
							}
							echo $OutHari.' '.$j->tgl_ujian
						?>
					
				</td>	
				<td >
					{{$j->wkt}}
				</td>
				<td >{{$j->judul}}</td>
				<td ></td>					
			</tr>
			
			@endforeach	

				
		</table>
		
	</selection>

	<section>        
					<div class="row">
						<div class="col-xs-6">
						<p><strong>Catatan :</strong></p>
							<ol>
								<li>Kartu jadwal ujian tidak boleh Hilang / Rusak</li>
								<li>Kartu ini harus dibawa saat ujian berlansung</li>
								<li>Kartu jadwal ujian ini digunakan untuk paraf absensi selama ujian berlangsung</li>
							</ol>
						</div>
						<div class="col-xs-4 text-center">							
							<strong>Mengetahu,</strong>	
							<strong>KEPSEK</strong>	
							<br>
							<br>
							<strong>(......................)</strong>	
						</div>
					</div>
            </section>       
    </body>
</html>