@extends('main')

@section('title', config('app.name'))

@section('content')

	@if (session('drive') != null)

		<div class="jumbotron" style="background-color:  white;text-align: center;">
			<h1 class="display-4">Selamat Datang di AndDrive</h1>
			<p class="lead">Hello <b>{{ session('drive')->name }}</b> Silahkan Pilih file dari local atau url</p>
			<a class="btn btn-success btn-lg" data-toggle="modal" data-target="#local" href="{{ route('glogin') }}" role="button">Upload Local File</a>
			<a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#coming" href="{{ route('glogin') }}" role="button">Upload From URL</a>
			</p>
		</div>
			
	@else
		<div class="jumbotron" style="background-color:  white;text-align: center;">
			<h1 class="display-4">Selamat Datang di AndDrive</h1>
			<p class="lead">Tempat upload file local disk maupun url ke Google Drive Anda.</p>
			<p>Aplikasi ini merupakan wrapper upload ke Google Drive. Tidak hanya file local, anda juga bisa download file dari server lain ke drive anda</p>
			<p class="lead">
			<a class="btn btn-primary btn-lg" href="{{ route('glogin') }}" role="button">Login Google First</a>
			</p>
		</div>
	@endif

	<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<h4 class="alert-heading">Perhatian !</h4>
			<li><strong>AndDrive</strong> masih dalam tahap pengembangan. Pengembang tidak menyarankan mengupload data sensitif. Gunakan untuk keperluan testing saja</li>
			<li>Jika menurut anda <strong>AndDrive</strong> bermanfaat, Silahkan digunakan dengan bijak</li>
			<li>Anda bisa ikut berkontribusi dengan cara fork <span><a href="https://github.com/andriawan/AndDrive">github</a></span>. Buat perubahan dan pull request</li>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

	
	<!-- Modal local-->
	<div class="modal fade" id="local" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Upload From Local</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					{!! Form::open(['url' => route('local_upload'), 'files' => true]) !!}
						
						<div class="modal-body">
								<div class="custom-file">
										<input type="file" name="local" class="custom-file-input" id="fileupload">
										<label id="label-upload" class="custom-file-label" for="customFile">Choose file</label>
								</div>
						</div>
						<div class="modal-footer local">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button id="submit-local" class="btn btn-success">Upload</button>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
	</div>

	<!-- Modal URL-->
	<div class="modal fade" id="url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Upload From URL</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="" method="POST">
						<div class="modal-body">
								<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">URL</div>
										</div>
										<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="http://yourserver/file.txt">
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Upload</button>
						</div>
					</form>
				</div>
			</div>
	</div>

	<!-- Modal URL-->
	<div class="modal fade" id="coming" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Coming Soon!</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="" method="POST">
						<div class="modal-body">
								<h1>Dalam tahap pengembangan</h1>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
	</div>

	{{ debug_me(session()->all())}}

@endsection