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
							
							<img src="#" height="100" />
				</th>
				<th style="width:80%">
						<h3 style="margin: -1px">YAYASAN PENDIDIKAN INSAN ISTIQOMAH</h3>
							<h2 style="margin: -1px">TKIT/MI/SDIT AL ISTIQOMAH</h2>
							<p style="font-size:12px">Sekretariat : Rakha Insan Istiqomah Jl Sawo Raya No. 1 Telp. 021-5538227</p>
				</th></center>
			</tr>
			<hr>
		</table>
	</header>
	<section>
		<center>
		<h4><strong>JADWAL UJIAN SEKOLAH</strong></h4>
		</center>
		@foreach($siswa as $s)
		<table class="left" style="width:100%"  >
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
		<br>
	<!-- {{$jadwal}}
	 -->
		<table class="left" border="1" style="width:100%">
			<tr>
				<th style="width:15%">Hari</th>
				<th style="width:15%">jam</th>
				<th style="width:60%">Mata Pelajaran</th>
				<th style="width:10%">Paraf</th>
			</tr>
			@foreach($jadwal as $j)
			<tr>
				<td>{{$j->hari}} 
					{{$j->tgl_ujian}}
				</td>
				

				<td>
				<?php
					 $arr = $j->soal;
					//  unset($arr[1]);//
					$r = json_decode($arr,true);
					$t = JSON.parse($arr);

					// unset($r[1]);
					

						// $jsonobj = '[{"Peter":35,"Ben":37},{"k":35,"B":37}]';
						
						// var_dump(json_decode($jsonobj));
						
					?>
					
				
					
					</td>
				<td>{{$arr}}</td>
				<td></td>			
			</tr>	
			@endforeach		
		</table>
		
		<br>
		<p id="demo"></p>

				<script>
				var obj = JSON.parse('{"firstName":"Johnsss", "lastName":"Doe"}');

				document.getElementById("demo").innerHTML = obj.firstName;
				</script>
	</selection>

	<section>        
					<div class="row">
						<div class="col-xs-2">
							<p><strong>Catatan :</strong></p>
						</div>
						<div class="col-xs-6">
							<ol>
								<li>Kartu jadwal ujian tidak boleh Hilang / Rusak</li>
								<li>Kartu ini harus dibawa saat ujian berlansung</li>
								<li>Kartu jadwal ujian ini digunakan untuk paraf absensi selama ujian berlangsung</li>
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