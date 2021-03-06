@extends('layouts.app')
@section('content')
	<div class="d-flex min-vh-75 align-items-center">
		<div class="container">
			<div class="row justify-content-center">
				@include('components.validate')
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<p class="m-0 fw-bold">{{__('Login')}}</p>
						</div>
						<div class="card-body">
							<form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="form-group mb-3">
									<input type="text" placeholder="{{__('E-Mail Address')}}" id="email" class="form-control" name="email" required autofocus>
									@if ($errors->has('email'))
										<span class="text-danger">{{ $errors->first('email') }}</span>
									@endif
								</div>

								<div class="form-group mb-3">
									<input type="password" placeholder="{{__('Password')}}" id="password" class="form-control"
										   name="password" required>
									@if ($errors->has('password'))
										<span class="text-danger">{{ $errors->first('password') }}</span>
									@endif
								</div>

								<div class="form-group mb-3">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember"> {{__('Remember Me')}}
										</label>
									</div>
								</div>

								<div class="d-grid mx-auto">
									<button type="submit" class="btn btn-dark btn-block">{{(__('Login'))}}</button>
								</div>
							</form>

							@include('frontend.auth.social-auth')
							<hr>
							<div class="d-flex justify-content-between">
								<a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
								@if(config('envi.register'))
									<a class="btn btn-link text-decoration-none" href="{{ route('register') }}">{{ __('Register') }}</a>
								@endif
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection