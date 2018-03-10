@extends('notification::layouts.app')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
	                Dashboard
	                <a href="{{route("contacts.create")}}"
	                   class="btn btn-success btn-sm text-light float-right"><i
				                class="fas fa-plus"></i>Create Contact</a>
                </div>
	            @include("notification::components.status")
	            <table class="table">
	                <thead>
	                    <th>Name</th>
	                    <th>Actions</th>
	                </thead>
	                <tbody>
	                @foreach($contacts as $contact)
		                <tr>
			                <td>{{$contact->full_name}}</td>
			                <td>
				                <div class="btn-group btn-group-sm">
					                <a href="#" class="btn btn-info">Edit</a>
					                <button class="btn btn-danger">Delete</button>
				                </div>
			                </td>
		                </tr>
	                @endforeach
	                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
