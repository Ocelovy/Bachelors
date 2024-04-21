<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmbulanceTableSeeder extends Seeder
{
    public function run()
    {
        $ambulances = [
            ['name' => 'gynekologická ambulancia'],
            ['name' => 'ambulancia zubného lekárstva'],
            ['name' => 'ambulancia maxilofaciálnej chirurgie'],
            ['name' => 'ambulancia čeľustnej ortopédie'],
            ['name' => 'ambulancia vnútorného lekárstva'],
            ['name' => 'angiologická ambulancia'],
            ['name' => 'ambulancia diabetológie a porúch látkovej premeny a výživy'],
            ['name' => 'endokrinologická ambulancia'],
            ['name' => 'gastroenterologická ambulancia'],
            ['name' => 'geriatrická ambulancia'],
            ['name' => 'hematologická a transfúziologická ambulancia'],
            ['name' => 'infektologická ambulancia'],
            ['name' => 'ambulancia tropickej medicíny'],
            ['name' => 'ambulancia klinickej farmakológie'],
            ['name' => 'kardiologická ambulancia'],
            ['name' => 'ambulancia klinickej onkológie'],
            ['name' => 'ambulancia radiačnej onkológie'],
            ['name' => 'ambulancia pracovného lekárstva'],
            ['name' => 'nefrologická ambulancia'],
            ['name' => 'pneumologicko-ftizeologická ambulancia'],
            ['name' => 'reumatologická ambulancia'],
            ['name' => 'algeziologická ambulancia'],
            ['name' => 'chirurgická ambulancia'],
            ['name' => 'ambulancia kardiochirurgická'],
            ['name' => 'ambulancia neurochirurgická'],
            ['name' => 'ambulancia úrazovej chirurgie'],
            ['name' => 'ambulancia plastickej chirurgie'],
            ['name' => 'ambulancia cievnej chirurgie'],
            ['name' => 'ortopedická ambulancia'],
            ['name' => 'urologická ambulancia'],
            ['name' => 'mamologická ambulancia'],
            ['name' => 'otorinolaryngologická ambulancia'],
            ['name' => 'ambulancia hrudníkovej chirurgie'],
            ['name' => 'oftalmologická ambulancia'],
            ['name' => 'dermatovenerologická ambulancia'],
            ['name' => 'neurologická ambulancia'],
            ['name' => 'psychiatrická ambulancia'],
            ['name' => 'ambulancia detskej psychiatrie'],
            ['name' => 'ambulancia klinickej psychológie'],
            ['name' => 'ambulancia klinickej logopédie'],
            ['name' => 'ambulancia liečebnej pedagogiky'],
            ['name' => 'ambulancia lekárskej genetiky'],
            ['name' => 'ambulancia klinickej imunológie a alergológie'],
            ['name' => 'ambulancia fyziatrie, balneológie a liečebnej rehabilitácie'],
            ['name' => 'ambulancia akupunktúry'],
            ['name' => 'ambulancia telovýchovného lekárstva'],
            ['name' => 'ambulancia andrológie'],
            ['name' => 'ambulancia pediatrickej endokrinológie a diabetológie a porúch látkovej premeny a výživy'],
            ['name' => 'ambulancia pediatrickej chirurgie'],
            ['name' => 'ambulancia pediatrickej gastroenterológie, hepatológie a výživy'],
            ['name' => 'ambulancia pediatrickej gynekológie'],
            ['name' => 'ambulancia pediatrickej hematológie a onkológie'],
            ['name' => 'ambulancia pediatrickej kardiológie'],
            ['name' => 'ambulancia pediatrickej nefrológie'],
            ['name' => 'ambulancia pediatrickej neurológie'],
            ['name' => 'ambulancia pediatrickej oftalmológie'],
            ['name' => 'ambulancia pediatrickej pneumológie a ftizeológie'],
            ['name' => 'ambulancia pediatrickej reumatológie'],
            ['name' => 'ambulancia pediatrickej urológie'],
            ['name' => 'ambulancia paliatívnej medicíny'],
            ['name' => 'ambulancia nukleárnej medicíny'],
            ['name' => 'ambulancia dentálnej hygieny'],
            ['name' => 'špecializovaná ambulancia Horskej záchrannej služby'],
            ['name' => 'špecializovaná ambulancia Hasičského záchranného zboru'],
            ['name' => 'ambulancia mimo strediska'],
        ];

        DB::table('ambulances')->insert($ambulances);
    }
}
