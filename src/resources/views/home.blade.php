@extends('notification::layouts.app')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @include("notification::components.status")
	
	                You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
