@extends('layouts.app')

@section('content')

<main class="animated fadeIn">
	<div class="container mb-5">
		<div class="card">
			<div class="card-body">

				<div class="d-flex justify-content-between mb-4 align-items-center">
					<h2 class="mb-4">Servicios</h2>
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

				@forelse ($services as $service)

					<div class="card my-5 hoverable">
						<div class="card-header d-flex justify-content-between grey lighten-3">
							<h4>{{ $service->name }}</h4>
							<button data-idservice="{{ $service->id }}" class="btn btn-md btn-danger px-3 eliminarservicio" data-toggle="modal" data-target="#borrar">
								<i class="fas fa-trash"></i>
							</button>
						</div>
						<div class="card-body">
							<p class="lead">VEF {{ $service->amount }}</p>
							<p>{{ $service->description }}</p>

							<table class="table table-bordered table-sm table-hover my-4">
								<caption>
									<span>Especialistas</span>
									<button data-idservicio="{{ $service->id }}" data-toggle="modal" data-target="#especialista" class="btn btn-sm px-2 btn-primary addespecialista">
										<i class="fas fa-plus"></i>
									</button>
								</caption>
								<thead>
									<th>Doctor</th>
									<th>Especialidad</th>
									<th>Horario de atención</th>
									<th class="text-center">Eliminar</th>
								</thead>
								<tbody>
									@foreach ($service->doctors as $doc)
										<tr>
											<td>{{ $doc->name }}</a></td>
											<td>
												<ul>
													@foreach ($doc->specialties as $spe)
														<li data-toggle="popover-hover" title="{{ $spe->specialty }}" data-content="{{ $spe->description }}">
															{{ $spe->specialty }}
														</li>
													@endforeach
												</ul>
											</td>
											<td>{{ $doc->schedule }}</td>
											<td class="text-center">
												<button data-toggle="modal" data-target="#eliminarespecialista" data-idespecialista="{{ $doc->id }}" data-idservicio="{{ $service->id }}" class="btn btn-sm btn-danger eliminarespecialista">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

				@empty
					<h2 class="my-5 text-center">No hay ningún servicio registrado</h2>
				@endforelse

			</div>
		</div>
	</div>
</main>


<!-- Modal AFREGAR -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registrar Servicio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">

				@csrf

				<div class="modal-body">

					<div class="row">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-briefcase-medical prefix"></i>
								<input type="text" class="form-control" name="servicio" required id="servicio">
								<label for="servicio">Nombre del servicio</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<i class="fas fa-dollar-sign prefix"></i>
								<input type="text" name="precio" class="form-control validate" placeholder="00000,00" required id="monto" pattern="^[0-9]+,[0-9]{2}$">
								<label for="monto">Precio</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col md-form">
							<div class="file-field">
								<div class="px-2 btn btn-primary btn-sm float-left">
									<span>Choose image file</span>
									<input type="file" name="icon" accept=".png, .jpg, .jpeg, .ico, .gif, .svg" required>
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Selecciona un icono para el servicio">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-edit prefix"></i>
								<textarea name="description" id="description" class="md-textarea form-control"></textarea>
								<label for="description">Descripción del servicio</label>
							</div>
						</div>
					</div>

					<div class="row no-gutters">
						<div class="col-1 d-flex justify-content-center align-items-center">
							<i class="fas fa-list-ol"></i>
						</div>
						<div class="col">
							<select class="mdb-select md-form" id="doctores" name="doctores[]" multiple searchable="Busca a un especialista">
								@foreach ($doctores as $doc)
									<option value="{{ $doc->id }}">
										Dr. {{ $doc->name.' '.$doc->lastname }} - @foreach ($doc->specialties as $espe) {{ $espe->specialty.', ' }} @endforeach
									</option>
								@endforeach
							</select>
							<label class="mdb-main-label" for="doctores">Doctores especialistas</label>
							<button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal EDITAR  -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="editarForm">
				@csrf
				@method('PUT')

				<input type="hidden" name="idproducto" id="idproducto">

				<div class="modal-body">

					<div class="row">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-cubes prefix"></i>
								<input type="text" class="form-control" name="producto" required id="productoEdit">
								<label for="productoEdit">Nombre del producto</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<i class="fas fa-dollar-sign prefix"></i>
								<input type="text" name="precio" class="form-control validate" placeholder="00000,00" required id="montoEdit" pattern="^[0-9]+,[0-9]{2}$">
								<label for="montoEdit">Precio</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-edit prefix"></i>
								<textarea name="descripcion" id="descripcionEdit" class="md-textarea form-control"></textarea>
								<label for="descripcionEdit">Descripción del producto</label>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal BORRAR  -->
<div class="modal fade" id="borrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="eliminarServcioForm">
				@csrf
				@method('DELETE')

				<div class="modal-body">

					<p class="lead text-center">¿Está seguro de querer eliminar el servicio?</p>

				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-danger">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- Modal AFREGAR -->
<div class="modal fade" id="especialista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar especialista</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('services.add_doctor_to_service') }}" method="post">

				@csrf

				<input type="hidden" name="idservicio" id="idservicio">

				<div class="modal-body">

					<div class="row no-gutters">
						<div class="col-1 d-flex justify-content-center align-items-center">
							<i class="fas fa-list-ol"></i>
						</div>
						<div class="col">
							<select class="mdb-select md-form" id="doctores" name="doctores[]" multiple searchable="Busca a un especialista">
								@foreach ($doctores as $doc)
									<option value="{{ $doc->id }}">
										Dr. {{ $doc->name.' '.$doc->lastname }} - @foreach ($doc->specialties as $espe) {{ $espe->specialty.', ' }} @endforeach
									</option>
								@endforeach
							</select>
							<label class="mdb-main-label" for="doctores">Doctores especialistas</label>
							<button type="button" class="btn-save btn btn-primary btn-sm">Save</button>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal BORRAR ESPECIALSITA -->
<div class="modal fade" id="eliminarespecialista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="eliminarEspecialistaForm">
				@csrf
				@method('DELETE')

				<div class="modal-body">

					<p class="lead text-center">¿Está seguro de querer eliminar al especialista?</p>

				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-md btn-secondary">Cerrar</button>
					<button type="submit" class="btn btn-md btn-danger">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection