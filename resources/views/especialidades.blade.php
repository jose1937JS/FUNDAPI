@extends('layouts.app')

@section('content')

<main class="animated fadeIn">
	<div class="container mb-5">
		<div class="card">
			<div class="card-body">

				<div class="d-flex justify-content-between mb-4 align-items-center">
					<h2 class="mb-4">Especialidades Médicas</h2>
					<button class="btn px-3 btn-primary" data-toggle="modal" data-target="#modal">
						<i class="fas fa-plus mr-2"></i>Añadir
					</button>
				</div>

				@if (session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="fas fa-check mr-2"></i>{{ session('success') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif

				<div class="card-columns">

					@foreach ($especialidades as $espe)
						<div class="card my-3 hoverable">
							<div class="card-body">
								<h5 class="card-title text-center">{{ $espe->specialty }}</h5>
								<p class="card-text">{{ $espe->description }}</p>
							</div>
							<div class="card-footer d-flex justify-content-end py-2">
								<button data-toggle="modal" data-target="#editar" class="btn px-3 btn-warning btn-md editar-btn" data-idespecialidad="{{ $espe->id }}">
									<i class="fas fa-edit"></i>
								</button>
								<button data-toggle="modal" data-target="#borrar" class="btn px-3 btn-danger btn-md borrar-btn" data-idespecialidad="{{ $espe->id }}">
									<i class="fas fa-trash"></i>
								</button>
							</div>
						</div>
					@endforeach

				</div>
			</div>
		</div>
	</div>
</main>

@endsection


<!-- STORE MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header px-5 grey lighten-3">
				<h5 class="modal-title" id="exampleModalLabel">Registrar Especialidad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('specialties.store') }}" method="post">

				@csrf

				<div class="modal-body px-5 grey lighten-5">

					<div class="row form-group">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-briefcase-medical prefix"></i>
								<input type="text" class="form-control" name="especialidad" required id="especialidad">
								<label for="especialidad">Especialidad</label>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-book-reader prefix"></i>
								<textarea type="text" class="md-textarea form-control" name="descripcion" required id="descripcion"></textarea>
								<label for="descripcion">Descripción</label>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer grey lighten-3 px-5 ">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal EDITAR PRODUCTO -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header px-5 grey lighten-3">
				<h5 class="modal-title" id="exampleModalLabel">Editar Especialidad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="editarEspecialidadForm">
				@csrf
				@method('PUT')

				<input type="hidden" name="idespecialidad" id="idespecialidad">

				<div class="modal-body px-5 grey lighten-5">

					<div class="row">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-cubes prefix"></i>
								<input type="text" class="form-control" name="especialidad" required id="especialidadEdit">
								<label for="especialidadEdit">Especialidad</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-edit prefix"></i>
								<textarea name="descripcion" id="descripcionEdit" rows="5" class="md-textarea form-control"></textarea>
								<label for="descripcionEdit">Descripción</label>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer grey lighten-3 px-5">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal BORRAR DOTOR -->
<div class="modal fade" id="borrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header grey lighten-3">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="eliminarEspecialidadForm">
				@csrf
				@method('DELETE')

				<input type="hidden" name="idespecialidad" id="idespecialidad">

				<div class="modal-body grey lighten-5">

					<p class="lead text-center py-5">¿Está seguro de querer borrar la especialidad?</p>

				</div>
				<div class="modal-footer grey lighten-3">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-danger">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>