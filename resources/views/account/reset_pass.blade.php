@extends('template/t_account')
@section('title', 'Reset Password for Admin Only')

@section('container')

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="{{ route('admin.reset_pass_process') }}">
					@csrf
					<span class="login100-form-title p-b-43">
                        Reset Admin Password
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
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="new password">
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type=submit>
							Reset
						</button>
					</div>
					
				</form>

				<div class="login100-more" style="background-image: url('account/images/bg-02.jpg');">
				</div>
			</div>
		</div>
	</div>

@endsection