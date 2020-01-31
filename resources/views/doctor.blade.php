@extends('layouts.app')

@section('content')

<main class="animated fadeIn">
	<div class="container mb-5">
		<div class="card">
			<div class="card-body">

				<div class="d-flex justify-content-between mb-4 align-items-center">
					<h2 class="mb-4">Doctores</h2>
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

				<table class="table table-bordered table-hover table-sm" id="">
					<thead>
						<tr>
							<th>Cédula</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Especialidad</th>
							<th>Teléfono</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>

						@forelse($doctores as $doctor)

							<tr>
								<td>{{ $doctor->dni }}</td>
								<td>{{ $doctor->name }}</td>
								<td>{{ $doctor->lastname }}</td>
								<td>
									<ul>
										@foreach ($doctor->specialties as $spe)
											<li data-toggle="popover-hover" title="{{ $spe->specialty }}" data-content="{{ $spe->description }}">
												{{ $spe->specialty }}
											</li>
										@endforeach
									</ul>
								</td>
								<td>
									<ul>
										@foreach ($doctor->doctor_phones as $phone)
											<li>{{ $phone->phone }}</li>
										@endforeach
									</ul>
								</td>
								<td class="d-flex justify-content-center">
									<button data-iddoctor="{{ $doctor->id }}" class="px-2 btn btn-sm btn-warning btneditar" data-toggle="modal" data-target="#editar">
										<i class="fas fa-edit"></i>
									</button>
									<button data-iddoctor="{{ $doctor->id }}" class="px-2 btn btn-sm btn-danger btnborrar" data-toggle="modal" data-target="#borrar">
										<i class="fas fa-trash"></i>
									</button>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="6">No hay data disponible en la tabla</td>
							</tr>
						@endforelse
					</tbody>
				</table>

			</div>
		</div>
	</div>
</main>


<!-- Modal agrear doctor -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header px-5 grey lighten-3">
				<h5 class="modal-title" id="exampleModalLabel">Registrar doctor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('doctors.store') }}" method="post">

				@csrf

				<div class="modal-body p-5 grey lighten-5">

					<div class="row">
						<div class="col-3">
							<div class="md-form">
								<i class="fas fa-id-card prefix"></i>
								<input type="text" class="form-control validate" name="cedula" required id="cedula" pattern="^[0-9]{7,8}$">
								<label for="cedula">Cédula</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<i class="fas fa-user prefix"></i>
								<input type="text" class="form-control" name="nombre" required id="nombre">
								<label for="nombre">Nombre</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<i class="fas fa-user prefix"></i>
								<input type="text" class="form-control" name="apellido" required id="apellido">
								<label for="apellido">Apellido</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-calendar prefix"></i>
								<textarea name="horario" id="horario" class="md-textarea form-control"></textarea>
								<label for="horario">Horario de atención al público</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-5">
							<div class="md-form">
								<i class="fas fa-phone prefix"></i>
								<input type="text" class="form-control validate" name="telefono-0" id="telefono" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}$">
								<label for="telefono">Teléfono-0</label>
							</div>
						</div>
						<div class="col-1 d-flex align-items-center">
							<button class="btn btn-sm btn-primary" type="button" id="addTelefono">
								<i class="fas fa-plus" data-toggle="tooltip" data-tittle="Agregar un nuevo teléfono"></i>
							</button>
						</div>
						<div class="col">
							<select class="mdb-select md-form" id="especialidades" name="especialidades[]" multiple searchable="Busca una especialidad">
								@foreach ($especialidades as $esp)
									<option value="{{ $esp->id }}">
										{{ $esp->specialty }}
									</option>
								@endforeach
							</select>
							<label class="mdb-main-label" for="especialidades">Selecciona la especialización</label>
							<button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
						</div>
					</div>

					<div class="row" id="extraTel"></div>

				</div>
				<div class="modal-footer px-5 grey lighten-3">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal EDITAR  -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header px-5 grey lighten-3">
				<h5 class="modal-title" id="exampleModalLabel">Editar Doctor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="editarDoctorForm">
				@csrf
				@method('PUT')

				<div class="modal-body py-5 px-5 grey lighten-5">

					<div class="row">
						<div class="col-3">
							<div class="md-form">
								<i class="fas fa-id-card prefix"></i>
								<input type="text" class="form-control validate" name="cedula" required id="cedulaEdit" pattern="^[0-9]{7,8}$">
								<label for="cedulaEdit">Cédula</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<i class="fas fa-user prefix"></i>
								<input type="text" class="form-control" name="nombre" required id="nombreEdit">
								<label for="nombreEdit">Nombre</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<i class="fas fa-user prefix"></i>
								<input type="text" class="form-control" name="apellido" required id="apellidoEdit">
								<label for="apellidoEdit">Apellido</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-calendar prefix"></i>
								<textarea name="horario" id="horarioEdit" class="md-textarea form-control" required></textarea>
								<label for="horarioEdit">Horario de atención al público</label>
							</div>
						</div>
					</div>

					<div class="row no-gutters">
						<div class="col-1 d-flex justify-content-center align-items-center">
							<i class="fas fa-list-ol fa-2x"></i>
						</div>
						<div class="col">
							<select class="mdb-select md-form" id="especialidadesEdit" name="especialidades[]" multiple searchable="Busca una especialidad" required>
								@foreach ($especialidades as $esp)
									<option value="{{ $esp->id }}">
										{{ $esp->specialty }}
									</option>
								@endforeach
							</select>
							<label class="mdb-main-label" for="especialidadesEdit">Selecciona la especialización</label>
							<button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
						</div>
					</div>

					<div class="row" id="extraTelEdit"></div>

				</div>
				<div class="modal-footer px-5 grey lighten-3">
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
				<h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="eliminarDoctorForm">
				@csrf
				@method('DELETE')

				<div class="modal-body grey lighten-5 py-5">

					<p class="lead text-center">¿Está seguro de querer eliminar al doctor?</p>

				</div>
				<div class="modal-footer grey lighten-3">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-danger">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection