<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties')->insert([
			[
				'specialty'   => 'Alergología',
				'description' => 'Se entiende por Alergología la especialidad médica que comprende el conocimiento, diagnóstico y tratamiento de la patología producida por mecanismos inmunológicos, con las técnicas que le son propias; con especial atención a la alergia.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Cardiología',
				'description' => 'La cardiología es la especialidad médica que se ocupa de las afecciones del corazón y del aparato circulatorio. Se incluye dentro de las especialidades médicas, es decir que no abarca la cirugía, aún cuando muchas enfermedades cardiológicas son de sanción quirúrgica, por lo que un equipo cardiológico suele estar integrado por cardiólogo, cirujano cardíaco y fisiatra, integrando además a otros especialistas cuando el terreno del paciente así lo requiere.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Cirugía Cardiaca',
				'description' => 'La cirugía cardiovascular es una especialidad médica de clase quirúrgica que, mediante el uso de la mano y el instrumento, pretende resolver o mejorar aquellas patologías cardíacas que no son tratables con fármacos ni con intervenciones menores tales como cateterismos, stents, etc.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Cirugía General',
				'description' => 'La cirugía general es la especialidad médica de clase quirúrgica que abarca las operaciones del tracto gastrointestinal, sistema biliar, bazo, páncreas, hígado, la mama así como las hernias de la pared abdominal. Así mismo incluye la cirugía de la glándulas endócrinas (tiroides y glándulas suprarrenales).También se encarga de la cirugía torácica no cardiovascular.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Cirugía Plástica',
				'description' => 'La cirugía plástica es la especialidad médica que tiene como función llevar a la normalidad funcional y anatómica la cobertura corporal, es decir la forma del cuerpo. Mediante cirugía busca reconstruir las deformidades y corregir las deficiencias funcionales mediante la transformación del cuerpo humano.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Cirugía de Mama',
				'description' => 'Operación quirúrgica para extraer el cáncer de mama (seno), pero no la mama misma. Los tipos de cirugía para salvar la mama incluyen la tumorectomía (extracción del tumor), la cuadrantectomía (extracción de un cuarto o cuadrante de la mama) y la mastectomía segmentaria (extracción del cáncer así como parte del tejido de la mama alrededor del tumor y del revestimiento de los músculos del tórax debajo del tumor).',
				'created_at' => now()
			],
			[
				'specialty'   => 'Cirugía Maxilofacial',
				'description' => 'La cirugía maxilofacial se ocupa de la patología de la cara y los maxilares, así como de la región cervical',
				'created_at' => now()
			],
			[
				'specialty'   => 'Cirugía Vascular',
				'description' => 'Especialidad dedicada al estudio de las enfermedades de las arterias, venas y linfáticos y se encarga de su tratamiento médico-quirúrgico.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Dermatología',
				'description' => 'La dermatología es la especialidad médica encargada del estudio de la piel, su estructura, función y enfermedades.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Endocrinología y Nutrición',
				'description' => 'La endocrinología es la especialidad médica encargada del estudio de la función normal, la anatomía y los desórdenes producidos por alteraciones de las glándulas endocrinas, que son aquellas que vierten su producto a la circulación sanguínea (denominados hormonas). Son glándulas endocrinas las siguientes: hipófisis, tiroides, paratiroides, páncreas, glándulas sexuales (ovarios y testículos) y glándulas suprarrenales.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Gastroenterología-Digestivo',
				'description' => 'La gastroenterología es la rama del Aparato Digestivo que comprende el diagnóstico y tratamiento de pacientes con afecciones del esófago, estómago, intestino delgado, colon, recto y páncreas',
				'created_at' => now()
			],
			[
				'specialty'   => 'Genética',
				'description' => 'La genética es el campo de las ciencias biológicas que trata de comprender cómo la herencia biológica es transmitida de una generación a la siguiente, y cómo se efectúa el desarrollo de las características que controlan estos procesos.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Geriatría',
				'description' => 'La Geriatría es la especialidad médica que se ocupa de los aspectos preventivos, curativos y de la rehabilitación de las enfermedades del adulto en senectud. La definición de Geriatría suele ir acompañada de la de Gerontología -el estudio de los fenómenos asociados al envejecimiento-, para su mejor diferenciación.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Ginecología',
				'description' => 'Ginecología significa literalmente La ciencia de la mujer, pero en medicina ésta es la especialidad médica y quirúrgica que trata las enfermedades del sistema reproductor femenino (útero, vagina y ovarios) y de la reproducción.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Hematología',
				'description' => 'La Hematología es la especialidad médica que se dedica al tratamiento de los pacientes con enfermedades hematológicas, para ello se encarga del estudio e investigación de la sangre y los órganos hematopoyéticos (médula ósea, ganglios linfáticos, bazo, etc) tanto sanos como enfermos. Las enfermedades hematológicas afectan la producción de sangre y sus componentes, como los glóbulos rojos, la hemoglobina, las proteínas plasmáticas, el mecanismo de coagulación, etc.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Enfermedades del hígado (Hepatología)',
				'description' => 'Enfermedades del hígado – hepatología es una rama de la medicina que se hace cargo del diagnóstico y tratamiento de pacientes con enfermedades del hígado, vías biliares y vesícula biliar, tanto primarias como secundarias (aquellos casos donde existe una enfermedad de otro órgano que repercute en el hígado, vías biliares o vesícula biliar).',
				'created_at' => now()
			],
			[
				'specialty'   => 'Enfermedades Infecciosas',
				'description' => 'Área médica que se encarga del estudio de las enfermedades infecciosas que son la manifestación clínica consecuente a una infección provocada por un microorganismo —como bacterias, hongos, virus, protozoos, etc.— o por priones.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Medicina Interna',
				'description' => 'La medicina interna es una especialidad médica que se dedica a la atención integral del adulto enfermo, sobre todo a los problemas clínicos de la mayoría de los pacientes que se encuentran ingresados en un hospital.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Nefrología',
				'description' => 'La nefrología es la especialidad médica que se ocupa del estudio de la función renal, para la prevención, detección precoz y tratamiento de enfermedades que afectan a los riñones.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Neumología',
				'description' => 'La neumología es la especialidad médica encargada del estudio de las enfermedades del aparato respiratorio.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Neurología',
				'description' => 'La neurología es la especialidad médica que trata los trastornos del sistema nervioso. Específicamente se ocupa de la prevención, diagnóstico, tratamiento y rehabilitación de todas las enfermedades que involucran al sistema nervioso central, el sistema nervioso periférico y el sistema nervioso autónomo, incluyendo sus envolturas (meninges), vasos sanguíneos y tejidos como los músculos.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Neurocirugía',
				'description' => 'La neurocirugía es la especialidad médica que se encarga del manejo quirúrgico y no quirúrgico (incluyendo la prevención, diagnóstico, evaluación, tratamiento, cuidados intensivos, y rehabilitación) de determinadas patologías de los sistemas nerviosos central, periférico y vegetativo, incluyendo sus estructuras vasculares.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Oftalmología',
				'description' => 'La oftalmología es la especialidad médico-quirúrgica que se relaciona con el diagnóstico y tratamiento de los defectos y de las enfermedades del aparato de la visión.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Otorrinolaringología',
				'description' => 'La otorrinolaringología (ORL) es la especialidad medica que se encarga de la prevención, diagnostico y tratamiento, tanto medico como quirúrgico, de las enfermedades de: el oído, las vías aéreo-digestivas superiores(boca, nariz y senos paranasales, faringe y laringe) y las estructuras próximas de la cara y el cuello.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Oncología',
				'description' => 'La oncología es la especialidad médica dedicada con el diagnóstico y tratamiento del cáncer.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Pediatría',
				'description' => 'La pediatría es la especialidad médica que estudia al niño y sus enfermedades.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Proctología',
				'description' => 'La proctología es la parte de la medicina encargada del estudio y tratamiento de las enfermedades de la región anal.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Psiquiatría',
				'description' => 'La psiquiatría es la especialidad médica que se ocupa del estudio, diagnóstico, tto, prevención y rehabilitación de los trastornos mentales y del comportamiento debido a disfunciones o enfermedades neurológicas o de otros sistemas orgánicos; a factores psicológicos o a disfunciones socioculturales y del contexto medioambiental de los individuos.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Rehabilitación y M. Deportiva',
				'description' => 'Esta actividad medica, establece el conjunto de procedimientos medicos, psicologicos y sociales, para ayudar a una persona a conseguir el mas completo potencial fisico, el mayor grado de independencia en las actividades de la vida diaria , a la vez que establece los mecanismos de prevención para evitar lesiones y enfermedades.',
				'created_at' => now()
			],
			[
				'specialty'   => 'Reumatología',
				'description' => 'La Reumatología es la especialidad médica que abarca todas las enfermedades del aparato locomotor (músculo esqueléticas) y las que afectan tejido conectivo',
				'created_at' => now()
			],
			[
				'specialty'   => 'Traumatología',
				'description' => 'La traumatología se ocupa de las lesiones traumáticas de columna y extremidades que afectan a: sus huesos (fracturas, epifisiólisis), ligamentos y articulaciones (esguinces, luxaciones, artritis traumáticas), músculos y tendones (roturas fibrilares, hematomas, contusiones, tendinitis); y piel (heridas).',
				'created_at' => now()
			],
			[
				'specialty'   => 'Urología',
				'description' => 'La urología es la especialidad médico-quirúrgica que se ocupa del estudio, diagnóstico y tratamiento de las patologías que afectan al aparato urinario y retroperitoneo de ambos sexos y al aparato reproductor masculino, sin límite de edad.',
				'created_at' => now()
			]
		]);


		DB::table('enterprises')->insert([
			[
				'logo'    => 'public/mdb-transparent.png',
				'name'    => 'Google Inc',
				'address' => 'AVenida los Llanos Calle oasis',
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda nam ullam, aspernatur. Sint blanditiis, facere sequi sunt fugiat saepe corrupti.',
				'manager' => 'Jose Lopez',
				'rif'     => 'J-asddsa',
				'mission' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti alias architecto exercitationem, placeat voluptatibus? Vitae unde porro dignissimos quos ipsam accusamus! Ullam molestias ab voluptate nihil quisquam officiis possimus provident.lorem',
				'vision'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti alias architecto exercitationem, placeat voluptatibus? Vitae unde porro dignissimos quos ipsam accusamus! Ullam molestias ab voluptate nihil quisquam officiis possimus provident.lorem'
			]
		]);

		$lastid = DB::table('enterprises')->select(DB::raw('max(id) as id'))->get();

		DB::table('enterprise_emails')->insert([
			[
				'email' => 'empresagoogle@support.com',
				'enterprise_id' => $lastid[0]->id
			]
		]);

		DB::table('enterprise_phones')->insert([
			[
				'phone' => '0424-222-22-69',
				'enterprise_id' => $lastid[0]->id
			]
		]);
    }
}
