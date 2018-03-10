@extends('notification::layouts.app')

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
	                New Contact
                </div>
	            @include("notification::components.status")
	            <div class="card-body">
		            {{Form::open(["route"=>"contacts.store", "method"=>"POST"])}}
		            {{Form::token()}}
		
		            <div class="form-group">
			            {{Form::label("first_name", "First Name")}}
			            {{Form::text("first_name",null,["class"=>"form-control"])}}
			            @if ($errors->has('first_name'))
				            <span class="invalid-feedback">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
			            @endif
		            </div>
		
		            <div class="form-group">
			            {{Form::label("last_name", "Last Name")}}
			            {{Form::text("last_name",null,["class"=>"form-control"])}}
			            @if ($errors->has('last_name'))
				            <span class="invalid-feedback">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
			            @endif
		            </div>
		            
		            <channels></channels>
		            
		
		            <div class="form-group">
			            <input type="submit" value="Create"
			                   class="btn btn-success" />
			            <a class="btn btn-info text-light">Back</a>
		            </div>
		
		            {{Form::close()}}
	            </div>
            </div>
        </div>
    </div>
</div>
@endsection
