@extends('layout.layout')
 
@section('content')
 

    @if(Session::has('student_save_msg'))
        <div class="alert alert-warning" role="alert">
		  {{ Session::get('student_save_msg') }}
		</div>
  	@endif

  	<h3 class="mt-4 ml-3 mb-4">Student List</h3>

  	<div class="row mt-4 ml-1 mr-1 mb-4">
  		<div class="col-6">
  			@if(count($students) > 0)
	            <button class="btn btn-danger" onclick="multipleDeleteConfirm()">Remove Selected</button>
	        @else
	            <button class="btn btn-danger disabled-element" disabled>Remove Selected</button>
	        @endif
  		</div>
  		<div class="col-6 text-right">
  			<button class="btn btn-primary" onclick="goto_create()"><i class="fa fa-user-plus"></i> Add Student</button>
  		</div>
  	</div>

	<div class="table-responsive">
	  <table class="table table-hover">
	    <thead>
		    <tr>
		      <th scope="col">
		      	@if(count($students) > 0)
	            	<input type="checkbox" id="select-all" onchange="selectAllStudent($(this))">
		        @else
		            <input type="checkbox" id="select-all-disabled" class="disabled-element" disabled>
		        @endif
		      </th>
		      <th scope="col">Student ID</th>
		      <th scope="col">First Name</th>
		      <th scope="col">Last Name</th>
		      <th scope="col">Course</th>
		      <th scope="col">Email</th>
		      <th scope="col">Action/s</th>
		    </tr>
		 </thead>
		 <tbody>
		 	@foreach ($students as $student)
		 		<tr>
			      <td><input type="checkbox" class="single-select" id="select-{{ $student['id'] }}" value="{{ $student['id'] }}"></td>
			      <td>{{ $student['student_id'] }}</rd>
			      <td>{{ $student['first_name'] }}</td>
			      <td>{{ $student['last_name'] }}</td>
			      <td>{{ $student['course'] }}</td>
			      <td>{{ $student['email'] }}</td>
			      <td> <a class="btn btn-success btn-sm mb-2" title="Update" href="students/edit/{{ $student['id'] }}"><i class="fa fa-edit"></i></a> <button class="btn btn-danger btn-sm mb-2" title="Delete" onclick="deleteConfirm({{ $student['id'] }}, '{{ $student['student_id'] }}')"><i class="fa fa-trash"></i></button> </td>
			    </tr>
		 	@endforeach
		  </tbody>
	  </table>
	</div>
 
@endsection