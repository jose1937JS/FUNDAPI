@extends('layouts.app')

@section('content')


	<div class="d-flex justify-content-center">
		<div class="card mt-5" style="width: 600px">
			<div class="card-body">
				<form action="{{ route('services.store') }}" method="post">
					@csrf

					<div class="form-row mb-4">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-user prefix"></i>
								<input type="text" name="name" id="name" class="form-control">
								<label for="name">chikistrikis</label>
							</div>
						</div>
					</div>

					<div class="form-row mb-4">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-user prefix"></i>
								<input type="text" name="description" id="description" class="form-control">
								<label for="description">chikistrikis</label>
							</div>
						</div>
					</div>


					<div class="form-row mb-4">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-user prefix"></i>
								<input type="text" name="amount" id="amount" class="form-control">
								<label for="amount">chikistrikis</label>
							</div>
						</div>
					</div>

				 	<div class="form-row mb-4">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-user prefix"></i>
								<input type="text" name="horario" id="horario" class="form-control">
								<label for="horario">chikistrikis</label>
							</div>
						</div>
					</div>

					<div class="d-flex justify-content-end">
				 		<button type="submit" class="btn btn-primary btn-md">enviar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
@endsection