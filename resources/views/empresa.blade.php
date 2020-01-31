@extends('layouts.app')

@section('content')

<main class="animated fadeIn">
	<div class="container mb-5">

		<div style="position: fixed; z-index: 1; bottom: 45px; right: 24px;">
			<button data-idempresa="1" data-toggle="modal" data-target="#editar" class="btn-floating btn-lg red editarEmpresa">
				<i class="fas fa-pencil-alt"></i>
			</button>
		</div>


		<div class="card">
			<div class="card-body">
				<div class="view zoom d-flex justify-content-center">
					<img src="{{ asset('storage/$empresa[0]->logo') }}" class="img-fluid">
				</div>
				<div class="card-text my-4">
					<h3 class="text-center">{{ $empresa[0]->name }}</h3>
					<p class="text-center">{{ $empresa[0]->rif }} <br> {{ $empresa[0]->address}}</p>
				</div>

				<h5 class="text-center mt-4">CEO</h5>
				<p class="text-center lead">{{ $empresa[0]->manager }}</p>
				<p class="text-center lead">{{ $empresa[0]->description }}</p>

				<h5 class="text-center">Mision</h5>
				<p class="lead text-center">{{ $empresa[0]->mission }}</p>

				<h5 class="text-center mt-4">Vision</h5>
				<p class="lead text-center">{{ $empresa[0]->vision }}</p>

				<h5 class="text-center mt-4">Contacto</h5>
				<div class="row mt-3">
					<div class="col text-right">
						@foreach ($telefonos as $tel)
							<p><i class="fas fa-phone"></i> {{ $tel->phone }}</p>
						@endforeach
					</div>
					<div class="col">
						@foreach ($correos as $email)
							<p><i class="fas fa-envelope"></i> {{ $email->email }}</p>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</main>


<!-- Modal -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar información de la empresa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="editarEmpresaForm" enctype="multipart/form-data">
				@csrf
				@method('put')

				<div class="modal-body">

					<div class="row form-group">
						<div class="col-4">
							<div class="d-flex justify-content-center">
								<img id="logoempresa" class="img-fluid">
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<div class="file-field">
									<div class="px-2 btn btn-primary btn-sm float-left">
										<span>Buscar</span>
										<input type="file" id="fileInput" name="logo" accept=".png, .jpg, .jpeg, .ico, .gif, .svg" required>
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text" placeholder="Cambiar logo de la empresa">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-building prefix"></i>
								<input type="text" name="empresa" id="empresa" class="form-control" required>
								<label for="empresa">Nombre de la empresa</label>
							</div>
						</div>
						<div class="col">
							<div class="md-form">
								<i class="fas fa-building prefix"></i>
								<input type="text" name="rif" id="rif" class="form-control validate" required>
								<label for="rif">RIF</label>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-5">
							<div class="md-form">
								<i class="fas fa-user-tie prefix"></i>
								<input type="text" name="ceo" id="ceo" class="form-control" required>
								<label for="ceo">Persona encargada</label>
							</div>
						</div>

						<div class="col">
							<div class="md-form">
								<i class="fas fa-road prefix"></i>
								<input type="text" name="direccion" id="direccion" class="form-control" required>
								<label for="direccion">Dirección de la empresa</label>
							</div>
						</div>
					</div>

					<div class="row form-group">
					</div>

					<div class="row form-group">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-edit prefix"></i>
								<textarea name="description" id="description" class="md-textarea form-control" required></textarea>
								<label for="description">Descripción de la empresa</label>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-edit prefix"></i>
								<textarea name="mision" id="mision" class="md-textarea form-control" required></textarea>
								<label for="mision">Misión</label>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col">
							<div class="md-form">
								<i class="fas fa-edit prefix"></i>
								<textarea name="vision" id="vision" class="md-textarea form-control" required></textarea>
								<label for="vision">Visión</label>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-5">
							<div class="md-form">
								<i class="fas fa-phone prefix"></i>
								<input type="text" class="form-control validate" id="telefono-0" name="telefono" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}$" required>
								<label for="telefono-0">Telefono</label>
							</div>
						</div>
						<div class="col-1">
							<div class="d-flex justify-content-end align-items-end">
								<button type="button" id="addTelEmpresa" class="btn btn-sm px-3 btn-primary"><i class="fas fa-plus"></i></button>
							</div>
						</div>
						<div class="col-5">
							<div class="md-form">
								<i class="fas fa-envelope prefix"></i>
								<input type="email" class="form-control validate" id="correo-0" name="correo" required>
								<label for="correo-0">Correo Electrónico</label>
							</div>
						</div>
						<div class="col-1">
							<div class="d-flex justify-content-end align-items-end">
								<button type="button" id="addCorreoEmpresa" class="btn btn-sm px-3 btn-primary"><i class="fas fa-plus"></i></button>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col" id="extraTelEmpresa"></div>
						<div class="col" id="extraCorEmpresa"></div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection