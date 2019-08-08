<form id="form_add_new_user" autocomplete="off" action="<?php echo base_url('set_opr/add_new_post');?>" method="POST">
	<div class="hljs-wrapper">
		<div class="col" style="padding: 20px;">
			<div class="form-row">
					<div class="form-input col-md-7">
						<label>Nama User</label>
						<div class="input-group input-daterange">
							<input type="text" class="form-control form-control-sm" name="nama_depan" id="nama_depan" placeholder="Nama Depan">
							<input type="text" class="form-control form-control-sm form-control-sm" name="nama_belakang" id="nama_belakang" placeholder="Nama Belakang">
						</div>
					</div>
			</div>
			<div class="form-row m-t-10 m-b-10">
					<div class="form-input col-md-4">
						<label>Email/Username/Nomor HP</label>
						<input type="text" autocomplete="nope" class="form-control form-control-sm" name="email_login_user" id="email_login_user">
					</div>
					<div class="form-input col-md-3">
						<label>Password</label>
						<input type="text" autocomplete="new-password" class="form-control form-control-sm" name="password_login_user" id="password_login_user">
					</div>
					<div class="form-input col-md-5">
						<label>Akses</label>
						<div class="row col">
							<div class="checkbox checkbox-css checkbox-inline">
								<input type="checkbox" value="3" id="data_pemilih" name="data_pemilih">
								<label for="data_pemilih">Data Pemilih</label>
							</div>
							<div class="checkbox checkbox-css checkbox-inline">
								<input type="checkbox" value="4" id="cek_kehadiran" name="cek_kehadiran" checked="">
								<label for="cek_kehadiran">Cek Kehadiran</label>
							</div>
						</div>
					</div>
			</div>
			<div class="form-row m-t-10 m-b-10">
				<div class="col">
					<button class="btn btn-warning btn-md" onclick="close_add_user()">Tutup</button>
					<button type="submit" class="btn btn-primary btn-md pull-right">Simpan</button>
				</div>
			</div>
		</div>
	</div>
</form>