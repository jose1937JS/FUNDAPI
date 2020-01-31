$(() => {

	let host = location.host;
	let pathname = location.href;

	// manejar la clase active del navbar
	if( pathname.endsWith('services') ){
		$('.collapsible-header.active').removeClass('active');
		$('#services').addClass('active');
	}
	else if( pathname.endsWith('doctors') ){
		$('.collapsible-header.active').removeClass('active');
		$('#doctors').addClass('active');
	}
	else if( pathname.endsWith('specialties') ){
		$('.collapsible-header.active').removeClass('active');
		$('#specialties').addClass('active');
	}
	else if( pathname.endsWith('enterprise') ){
		$('.collapsible-header.active').removeClass('active');
		$('#enterprise').addClass('active');
	}


	// inicializacion de componentes

	// SideNav Button Initialization
	$(".button-collapse").sideNav({
		breakpoint: 1024
	});
	// SideNav Scrollbar Initialization
	var sideNavScrollbar = document.querySelector('.custom-scrollbar');
	var ps = new PerfectScrollbar(sideNavScrollbar);

	// $('#dtProductos').DataTable();
	// $('#dtDoctores').DataTable();
	$('.dataTables_length').addClass('bs-select');
	$('.mdb-select').materialSelect();
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover-hover"]').popover({
		trigger: 'hover',
		placement: 'top'
	});


	// Funciones para editar y borrar las especialidades
	// Llenar el formualrio con los valores del producto filtrados por el id
	$('.btn-editar').click(function(e){

		let idproducto = $(this).data('idproducto');
		$('#editarForm').attr('action', `http://${host}/products/${idproducto}`);

		$.get(`http://${host}/products/${idproducto}`)
		.done((data) => {
			$('#productoEdit').val(data.name);
			$('#montoEdit').val(data.ammount);
			$('#descripcionEdit').val(data.description);
			$('#idproducto').val(idproducto);
		})
		.fail((error) => {
			console.error(error);
			toastr.error('Algo ha ocurrido');
		});
	});

	$('.btn-borrar').click(function(e){
		let idproducto = $(this).data('idproducto');
		$('#eliminarForm').attr('action', `http://${host}/products/${idproducto}`);
	});


	// agregar mas telefonos al doctor
	let i = 0;
	$('#addTelefono').click(function(){
		i++;
		$('#extraTel').append(`
			<div class="col-4">
				<div class="md-form">
					<i class="fas fa-phone prefix"></i>
					<input type="text" class="form-control validate" name="telefono-${i}" id="telefono-${i}" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}$">
					<label for="descripcion">Teléfono-${i}</label>
				</div>
			</div>
		`);
	});


	// Funciones para editar y borrar las especialidades

	$('.editar-btn').click(function(e){
		let idespecialidad = $(this).data('idespecialidad');
		$('#editarEspecialidadForm').attr('action', `http://${host}/specialties/${idespecialidad}`);

		$.get(`http://${host}/specialties/${idespecialidad}`)
		.done((data) => {
			$('#especialidadEdit').val(data.specialty);
			$('#descripcionEdit').val(data.description);
			$('#idespecialidad').val(idespecialidad);
		})
		.fail((error) => {
			console.error(error);
			toastr.error('Algo ha ocurrido');
		});
	});

	$('.borrar-btn').click(function(e){
		let idespecialidad = $(this).data('idespecialidad');
		$('#eliminarEspecialidadForm').attr('action', `http://${host}/specialties/${idespecialidad}`);
	});


	// Funciones para editar y borrar las especialidades
	$('.btneditar').click(function(e) {
		let iddoctor = $(this).data('iddoctor');
		$('#editarDoctorForm').attr('action', `http://${host}/doctors/${iddoctor}`);

		$.get(`http://${host}/doctors/${iddoctor}`)
		.done((data) => {

			$('#cedulaEdit').val(data.doctor.dni);
			$('#nombreEdit').val(data.doctor.name);
			$('#apellidoEdit').val(data.doctor.lastname);
			$('#horarioEdit').val(data.doctor.schedule);

			let i = 0;
			$('#extraTelEdit').html('')
			for (phones of data.phones) {
				i++;
				$('#extraTelEdit').append(`
					<div class="col-4">
						<div class="md-form">
							<i class="fas fa-phone prefix"></i>
							<input type="text" value="${phones.phone}" class="form-control validate" name="telefono-${i}" id="telefono-${i}" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}$">
							<label for="descripcion">Teléfono-${i}</label>
						</div>
					</div>
				`);
			}
		})
		.fail((error) => {
			console.error(error);
			toastr.error('Algo ha ocurrido');
		});
	});

	$('.btnborrar').click(function() {
		let iddoctor = $(this).data('iddoctor');
		$('#eliminarDoctorForm').attr('action', `http://${host}/doctors/${iddoctor}`);
	});



	$('.addespecialista').click(function() {
		let idservicio = $(this).data('idservicio');
		$('#idservicio').val(idservicio);
	});

	$('.eliminarespecialista').click(function() {
		let idespecialista = $(this).data('idespecialista');
		let idservicio     = $(this).data('idservicio');
		$('#eliminarEspecialistaForm').attr('action', `http://${host}/services/delete_doctor_from_service/${idespecialista}/${idservicio}`);
	});


	$('.eliminarservicio').click(function() {
		let idservicio = $(this).data('idservice');
		$('#eliminarServcioForm').attr('action', `http://${host}/services/${idservicio}`);
	});



	// Funciones para editar y borrar la empresa
	$('.editarEmpresa').click(function(e) {

		let idempresa = $(this).data('idempresa');
		$('#editarEmpresaForm').attr('action', `http://${host}/enterprise/${idempresa}`);

		$.get(`http://${host}/enterprise/${idempresa}`)
		.done((data) => {

			$('#empresa').val(data.empresa.name);
			$('#rif').val(data.empresa.rif);
			$('#ceo').val(data.empresa.manager);
			$('#direccion').val(data.empresa.address);
			$('#description').val(data.empresa.description);
			$('#mision').val(data.empresa.mission);
			$('#vision').val(data.empresa.vision);

			if (data.telefonos.length > 1) {

				let t = 0;
				$('#extraTelEmpresa').html('');
				for (phone of data.telefonos) {
					t++;
					$('#extraTelEmpresa').append(`
						<div class="row">
							<div class="col">
								<div class="md-form">
									<i class="fas fa-phone prefix"></i>
									<input type="text" class="form-control validate" value="${phone.phone}" name="telefono-${t}" id="telefono-${t}" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}$">
									<label for="telefono-${t}">Teléfono-${t}</label>
								</div>
							</div>
						</div>
					`);
				}
			}
			else {
				$('#telefono-0').val(data.telefonos[0].phone);
			}

			if (data.correos.length > 1) {
				let u = 0;
				$('#extraCorEmpresa').html('');
				for (correo of data.correos) {
					u++;
					$('#extraCorEmpresa').append(`
						<div class="row">
							<div class="col">
								<div class="md-form">
									<i class="fas fa-envelope prefix"></i>
									<input type="email" value="${correo.email}" class="form-control validate" name="correo-${u}" id="correo-${u}">
									<label for="correo-${u}">Correo-${u}</label>
								</div>
							</div>
						</div>
					`);
				}
			}
			else {
				$('#correo-0').val(data.correos[0].email);
			}

			$('#logoempresa').attr('src', `http://${host}/storage/${data.empresa.logo}`);
		})
		.fail((error) => {
			console.error(error.responseJSON);
			toastr.error('Algo ha ocurrido');
		});
	});

	$('#fileInput').change((e) => {

		// imagen de preview
		let file   = e.target.files[0]
		let reader = new FileReader()

		reader.onload = (ev) => {
			$('#logoempresa').attr('src', ev.target.result)
		}

		reader.readAsDataURL(file)
	})


	let j = 0;
	$('#addTelEmpresa').click(function(){
		j++;
		$('#extraTelEmpresa').append(`
			<div class="row">
				<div class="col">
					<div class="md-form">
						<i class="fas fa-phone prefix"></i>
						<input type="text" class="form-control validate" name="telefono-${j}" id="telefono-${j}" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}$">
						<label for="telefono-${j}">Teléfono-${j}</label>
					</div>
				</div>
			</div>
		`);
	});

	let k = 0;
	$('#addCorreoEmpresa').click(function(){
		k++;
		$('#extraCorEmpresa').append(`
			<div class="row">
				<div class="col">
					<div class="md-form">
						<i class="fas fa-envelope prefix"></i>
						<input type="email" class="form-control validate" name="correo-${k}" id="correo-${k}">
						<label for="correo-${k}">Correo-${k}</label>
					</div>
				</div>
			</div>
		`);
	});

});