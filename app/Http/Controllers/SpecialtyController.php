<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Specialty;

class SpecialtyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$especialidades = Specialty::all();

		return view('especialidades')
			->with('especialidades', $especialidades);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$especialidad = new Specialty();
		$especialidad->specialty   = $request->input('especialidad');
		$especialidad->description = $request->input('descripcion');
		$especialidad->save();

		return redirect()->route('specialties.index')->with('success', 'Nueva especialidad agregada correctamente');
	}


	public function show(Specialty $specialty)
	{
		return $specialty;
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
		$especialidad = Specialty::find($id);
		$especialidad->specialty   = $request->input('especialidad');
		$especialidad->description = $request->input('descripcion');
		$especialidad->save();

		return redirect()->route('specialties.index')->with('success', 'Has actualizado la especialidad correctamente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Specialty $specialty)
	{
		$specialty->delete();

		return redirect()->route('specialties.index')->with('success', 'La especialidad ha sido eliminada correctamente');
	}
}
