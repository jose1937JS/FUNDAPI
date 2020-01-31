<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\DoctorSpecialty;
use App\DoctorPhone;
use App\Specialty;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$especialidades = Specialty::all();
		$doctores = Doctor::all();

		// dd($doctores[0]->doctor_phones);

		return view('doctor')
			->with('especialidades', $especialidades)
			->with('doctores', $doctores);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->input();
		$cedula    = $data['cedula'];
		$nombre    = $data['nombre'];
		$apellido  = $data['apellido'];
		$horario   = $data['horario'];
		$especialidades = $data['especialidades'];

		$telefonos = collect($data)->filter(function($v, $k) use ($data){
			if (!is_array($v)) {
				if (preg_match("/telefono-/", $k)) {
					return $v;
				}
			}
		});

		$doctor           = new Doctor();
		$doctor->dni      = $cedula;
		$doctor->name     = $nombre;
		$doctor->lastname = $apellido;
		$doctor->schedule = $horario;
		$doctor->save();

		$lastDoctorId = $doctor->lastid();

		foreach( $especialidades as $idspe ){
			$docSpe = new DoctorSpecialty();
			$docSpe->doctor_id    = $lastDoctorId;
			$docSpe->specialty_id = $idspe;
			$docSpe->save();
		}

		foreach ($telefonos as $tel) {
			$docPhone = new DoctorPhone();
			$docPhone->phone = $tel;
			$docPhone->doctor_id = $lastDoctorId;
			$docPhone->save();
		}

		return redirect()->route('doctors.index')->with('success', 'Se ha agregado el doctor correctamente');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Doctor  $doctor
	 * @return \Illuminate\Http\Response
	 */
	public function show(Doctor $doctor)
	{
		$doctorData = [
			'doctor'      => $doctor,
			'specialties' => $doctor->specialties,
			'phones'      => $doctor->doctor_phones
		];

		return $doctorData;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Doctor  $doctor
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Doctor $doctor)
	{
		$data = $request->input();
		$cedula    = $data['cedula'];
		$nombre    = $data['nombre'];
		$apellido  = $data['apellido'];
		$horario   = $data['horario'];
		$especialidades = $data['especialidades'];

		$telefonos = collect($data)->filter(function($v, $k){
			if (!is_array($v)) {
				if (preg_match("/telefono-/", $k)) {
					return $v;
				}
			}
		});

		$tels = [];
		foreach ($telefonos as $key => $value) {
			$tels[] = $value;
		}

		$doctor->dni      = $cedula;
		$doctor->name     = $nombre;
		$doctor->lastname = $apellido;
		$doctor->schedule = $horario;
		$doctor->save();

		DoctorSpecialty::where('doctor_id', $doctor->id)->delete();
		foreach( $especialidades as $idspe ){
			$docspe = new DoctorSpecialty();
			$docspe->doctor_id    = $doctor->id;
			$docspe->specialty_id = $idspe;
			$docspe->save();
		}

		$docPhones = DoctorPhone::where('doctor_id', $doctor->id)->get();
		for ($i = 0; $i < count($tels); $i++) {
			$docPhones[$i]->phone     = $tels[$i];
			$docPhones[$i]->doctor_id = $doctor->id;
			$docPhones[$i]->save();
		}

		return redirect()->route('doctors.index')->with('success', 'Se ha actualizado la  información del doctor correctamente.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Doctor  $doctor
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Doctor $doctor)
	{
		DoctorPhone::where('doctor_id', $doctor->id)->delete();
		DoctorSpecialty::where('doctor_id', $doctor->id)->delete();

		$doctor->delete();

		return redirect()->route('doctors.index')->with('success', 'El doctor ha sido eliminado correctamente.');
	}


// Recursos par aser mostrados por la api
	public function get_all()
	{
		return Doctor::all();
	}

	public function get_one($id)
	{
		return Doctor::find($id);
	}
}
