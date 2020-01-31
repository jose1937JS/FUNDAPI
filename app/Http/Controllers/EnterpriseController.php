<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enterprise;
use App\EnterprisePhone;
use App\EmailEnterprise;

class EnterpriseController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$empresa = Enterprise::all();

		return view('empresa')
			->with('empresa', $empresa)
			->with('telefonos', $empresa[0]->enterprise_phones)
			->with('correos', $empresa[0]->enterprise_emails);
	}

	public function show(Enterprise $enterprise)
	{
		$empresa = [
			'telefonos' => $enterprise->enterprise_phones,
			'correos'   => $enterprise->enterprise_emails,
			'empresa'   => $enterprise
		];

		return $empresa;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Enterprise $empresa)
	{
		$data = $request->input();

		$filepath = $request->file('logo')->store('public');
		$empresa->logo        = str_replace('public', 'storage', $filepath);
		$empresa->name        = $data['empresa'];
		$empresa->address     = $data['direccion'];
		$empresa->description = $data['description'];
		$empresa->manager     = $data['ceo'];
		$empresa->rif         = $data['rif'];
		$empresa->mission     = $data['mision'];
		$empresa->vision      = $data['vision'];

		$lastid = $empresa->lastid();

		$telefonos = collect($data)->filter(function($v, $k) use ($data){
			if (!is_array($v)) {
				if (preg_match("/telefono/", $k)) {
					return $v;
				}
			}
		});

		$tels = [];
		foreach ($telefonos as $key => $value) {
			$tels[] = $value;
		}

		$entPhones = EnterprisePhone::where('enterprise_id', $empresa->id)->get();
		for ($i = 0; $i < count($tels); $i++) {
			$entPhones[$i]->phone         = $tels[$i];
			$entPhones[$i]->enterprise_id = $empresa->id;
			$entPhones[$i]->save();
		}

		$correos = collect($data)->filter(function($v, $k) use ($data){
			if (!is_array($v)) {
				if (preg_match("/correo/", $k)) {
					return $v;
				}
			}
		});

		$emails = [];
		foreach ($correos as $key => $value) {
			$emails[] = $value;
		}

		$entEmails = EmailEnterprise::where('enterprise_id', $empresa->id)->get();
		for ($i = 0; $i < count($emails); $i++) {
			$entEmails[$i]->email         = $tels[$i];
			$entEmails[$i]->enterprise_id = $empresa->id;
			$entEmails[$i]->save();
		}

		return redirect()->route('enterprise.index')->with('success', 'Se ha actualizado la información de la empresa correctamente.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// public function destroy($id)
	// {
	// 	dd($id);
	// }
}
