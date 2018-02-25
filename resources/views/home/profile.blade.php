@extends('main')

@section('title', config('app.name'))

@section('content')

	@if (session('drive') != null)

		<div class="jumbotron" style="background-color:  white;text-align: center;">
			<img src="{{ session('drive')->picture }}" alt="{{ session('drive')->name }}" width="200" height="200" class="img-thumbnail">
      <h1 class="display-4" style="padding-top:20px;">{{ session('drive')->name }}</h1>
      <p>{{ session('drive')->email }}</p>
		</div>
			
	@else
		<h1>Please, Login First</h1>
	@endif

	

	{{ var_dump(session()->all())}}

@endsection