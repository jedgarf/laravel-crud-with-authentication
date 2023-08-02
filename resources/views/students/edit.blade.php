@extends('layout.layout')
 
@section('content')

  	<div class="row mr-1">
  		<div class="col-7">
  			<h3 class="mt-4 ml-3 mb-4"><i class="fa fa-user-plus"></i> Update Student</h3>
  		</div>
  		<div class="col-5 text-right">
  			<button class="btn btn-success mt-4 ml-3 mb-4" onclick="goto_students()"><i class="fa fa-list"></i> Student List</button>
  		</div>
  	</div>

  	<div class="container-fluid">

  		<div class="card card-default">
  			<div class="card-body">
  				<div class="row">
  					<div class="col-12">
  						@if(Session::has('student_save_msg'))
					        <div class="alert alert-primary" role="alert">
							  {{ Session::get('student_save_msg') }}
							</div>
					  	@endif
  					</div>
		  			<div class="col-12">
		  				<form method="POST" action="{{ route('validate.updateform', [$students['id']]) }}" novalidate>
			  				@csrf
			  				<div class="form-group">
			  					<label for="first_name">First Name</label>
			  					<input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{old('first_name', $students['first_name'])}}">
			  					@error('first_name')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			  				</div>
			  				<div class="form-group">
			  					<label for="last_name">Last Name</label>
			  					<input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{old('last_name', $students['last_name'])}}">
			  					@error('last_name')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			  				</div>
			  				<div class="form-group">
			  					<label for="course">Course</label>
			  					<input type="text" class="form-control @error('course') is-invalid @enderror" name="course" id="course" value="{{old('course', $students['course'])}}">
			  					@error('course')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			  				</div>
			  				<div class="form-group">
			  					<label for="email">Email</label>
			  					<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email', $students['email'])}}">
			  					@error('email')
				                    <span class="invalid-feedback" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                @enderror
			  				</div>
			  				<div class="btn-group pull-right">
			  					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
			  				</div>
		  				</form>
		  			</div>
		  		</div>
  			</div>
  		</div>
  		
  	</div>
 
@endsection