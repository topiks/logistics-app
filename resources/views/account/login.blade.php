@extends('template/t_account')
@section('title', 'Login')

@section('container')

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
                        BBI Warehouse Material System Login
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="username">
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="password">
					</div>

					<div class="flex-sb-m w-full p-t-9 p-b-32">
						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
				</form>

				<div class="login100-more" style="background-image: url('account/images/bg-02.jpg');">
				</div>
			</div>
		</div>
	</div>

@endsection