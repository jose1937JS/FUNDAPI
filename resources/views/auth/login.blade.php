@extends('layouts.app')

@section('content')

	<div class="fondo-login flex-center">
		<div class="animated fadeIn">
			<!-- Material form login -->
			<div class="card" style="width: 380px">

				<h4 class="card-header info-color white-text text-center py-4">
					<strong>Inicio de Sesión</strong>
				</h4>

				<!--Card content-->
				<div class="card-body px-lg-5 py-5 pt-0">

					<!-- Form -->
					<form method="POST" action="{{ route('login') }}" style="color: #757575;">

						@csrf

						<!-- Email -->
						<div class="md-form">
							<i class="fas fa-envelope prefix"></i>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
							<label for="email">E-mail</label>

							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<!-- Password -->
						<div class="md-form mt-4">
							<i class="fas fa-unlock prefix"></i>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
							<label for="password">Contaseña</label>

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="d-flex justify-content-around align-items-center">
							<div>
								<!-- Remember me -->
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<label class="form-check-label" for="remember">Recuérdame</label>
								</div>
							</div>
							<div>
								<!-- Forgot password -->
								@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">
										{{ __('Olvidé mi clave') }}
									</a>
								@endif
							</div>
						</div>

						<!-- Sign in button -->
						<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Entrar</button>

					</form>
					<!-- Form -->

				</div>

			</div>
			<!-- Material form login -->
		</div>
	</div>

@endsection