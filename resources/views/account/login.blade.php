@extends('template/t_account')
@section('title', 'Login')

@section('container')

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="{{ route('user.login') }}">
					@csrf
					<span class="login100-form-title p-b-43">
                        BBI Warehouse Material System Login
					</span>
					
					@if ($notification = Session::get('failed'))
					<div class="alert alert-danger" role="alert">
						<strong>{{ $notification }}</strong>
					</div>
					@endif

					@if ($notification = Session::get('success'))
					<div class="alert alert-success" role="alert">
						<strong>{{ $notification }}</strong>
					</div>
					@endif
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="username">
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="password">
					</div>

					<div class="flex-sb-m w-full p-t-9 p-b-32">
						<div>
							<a href="/forget_pass" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type=submit>
							Login
						</button>
					</div>
					
				</form>

				<div class="login100-more" style="background-image: url('account/images/background-login.jpg');">
				</div>
			</div>
		</div>
	</div>

@endsection