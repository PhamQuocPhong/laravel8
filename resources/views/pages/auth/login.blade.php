@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div id="login">
	<div class="container">
	  <div class="row">
	    <div class="col-md-6 col-sm-offset-3 form">
	    	<h2 class="text-center"><b> ログイン画面 </b></h2>

	    	<!-- show errors -->
        	@include("components.notice_error")
        	<!-- show errors -->

        	<!-- show success -->
        	@include("components.notice_success")
        	<!-- show success -->

		    <form method="POST" target="_self" action="{{ route('login')}}" class="form">
		        @csrf
			    <div class="form-group">
				    <label for="exampleInputEmail1">Email</label>
				    <input type="email" class="form-control" name="email" placeholder="Enter email" maxlength="30" >
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" name="password" placeholder="Password" maxlength="20" >
				  </div>
				  <div class="btn-action">
				  	<button type="submit" class="btn btn-default">ログイン</button>
				  </div>
			</form>
	    </div>
	  </div>
	</div>
</div>

@endsection