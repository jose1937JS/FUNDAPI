<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enterprise;
use App\EnterprisePhone;
use App\EnterpriseEmail;

class EnterpriseController extends Controller
{

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


	public function update(Request $request, $id)
	{
		$empresa   = Enterprise::find($id);
		$data      = $request->input();

		if ( $request->file('logo')) {
			$filepath      = $request->file('logo')->store('public');
			$empresa->logo = str_replace('public', 'storage', $filepath);
		}

		$empresa->name        = $data['empresa'];
		$empresa->address     = $data['direccion'];
		$empresa->description = $data['description'];
		$empresa->manager     = $data['ceo'];
		$empresa->rif         = $data['rif'];
		$empresa->mission     = $data['mision'];
		$empresa->vision      = $data['vision'];

		$empresa->save();

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


		// $entPhones = EnterprisePhone::where('enterprise_id', $empresa->id)->get();
		EnterprisePhone::where('enterprise_id', $empresa->id)->delete();

		for ($i = 0; $i < count($tels); $i++) {
			$newPhones = new EnterprisePhone();
			$newPhones->phone         = $tels[$i];
			$newPhones->enterprise_id = $empresa->id;
			$newPhones->save();
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

		$entEmails = EnterpriseEmail::where('enterprise_id', $empresa->id)->delete();

		for ($i = 0; $i < count($emails); $i++) {
			$newEmails = new EnterpriseEmail();
			$newEmails->email         = $emails[$i];
			$newEmails->enterprise_id = $empresa->id;
			$newEmails->save();
		}

		return redirect()->route('enterprise.index')->with('success', 'Se ha actualizado la información de la empresa correctamente.');
	}


	public function get_all()
	{
		$empresa = Enterprise::find(1);

		$enterprise = [
			'telefonos' => $empresa->enterprise_phones,
			'correos'   => $empresa->enterprise_emails,
			'empresa'   => $empresa
		];

		return $empresa;
	}
}
