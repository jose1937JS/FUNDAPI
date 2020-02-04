<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;
use App\Doctor;
use App\DoctorService;

class ServiceController extends Controller
{
	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$doctores = Doctor::all();
		$services = Service::all();

		return view('servicio')
			->with('services', $services)
			->with('doctores', $doctores);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $req)
	{
		$service = new Service();

		$service->name        = $req->input('servicio');
		$service->description = $req->input('description');
		$service->amount      = $req->input('precio');

		if ( $req->file('icon')) {
			$filepath      = $req->file('icon')->store('public');
			$service->icon = str_replace('public', 'storage', $filepath);
		}

		$service->save();

		$lastid = $service->lastid();

		$iddoctores = $req->input('doctores');

		foreach ($iddoctores as $key => $docid) {
			$docser = new DoctorService();
			$docser->doctor_id  = $docid;
			$docser->service_id = $lastid;
			$docser->save();
		}

		return redirect()->route('services.index')->with('success', 'Se ha agregado el servicio correctamente');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return Service::find($id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Service $service)
	{
		DoctorService::where('service_id', $service->id)->delete();

		$service->delete();

		return redirect()->route('services.index')->with('success', 'El servicio se ha eliminado correctamente.');
	}


	public function add_doctor_to_service(Request $req)
	{
		$iddoctores = $req->input('doctores');

		foreach ($iddoctores as $key => $docid) {
			$docser = new DoctorService();
			$docser->doctor_id  = $docid;
			$docser->service_id = $req->input('idservicio');
			$docser->save();
		}
		return redirect()->route('services.index')->with('success', 'Se ha añadido a un especialista en el servicio correctamente.');
	}

	public function delete_doctor_from_service($idespecialista, $idservicio)
	{
		DoctorService::where(['doctor_id' => $idespecialista, 'service_id' => $idservicio])->delete();
		return redirect()->route('services.index')->with('success', 'Has eliminado correctamente al especialista del servicio.');
	}


	public function get_all()
	{
		return Service::all();
	}

	public function get_one($id)
	{
		return Service::find($id);
	}
}
