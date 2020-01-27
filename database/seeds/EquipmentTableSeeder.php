<?php

use Illuminate\Database\Seeder;
use App\Equipment;

class EquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipment = new Equipment();
        $equipment->equipment_id = 'GEG1';
        $equipment->name = 'Triaxial Apparatus';
        $equipment->country = 'Italy';
        $equipment->quantity = 1;
        $equipment->unit = "PCS";
        $equipment->unit_cost = 500000;
        $equipment->total_cost = 500000;
        $equipment->remark = 'This is a remark';
        $equipment->save();

        $equipment = new Equipment();
        $equipment->equipment_id = 'GEG2';
        $equipment->name = 'Direct Shear Apparatus';
        $equipment->country = 'Italy';
        $equipment->quantity = 1;
        $equipment->unit = "PCS";
        $equipment->unit_cost = 50000;
        $equipment->total_cost = 50000;
        $equipment->remark = 'Direct shear remark';
        $equipment->save();

        $equipment = new Equipment();
        $equipment->equipment_id = 'GEG3';
        $equipment->name = 'Unconfined Compression Test Apparatus';
        $equipment->country = 'Italy';
        $equipment->quantity = 1;
        $equipment->unit = "PCS";
        $equipment->unit_cost = 20000;
        $equipment->total_cost = 20000;
        $equipment->remark = 'This is a UCS remark';
        $equipment->save();

        $equipment = new Equipment();
        $equipment->equipment_id = 'GEG4';
        $equipment->name = 'Constant Head Permeability Apparatus';
        $equipment->country = 'UK';
        $equipment->quantity = 2;
        $equipment->unit = "PCS";
        $equipment->unit_cost = 60000;
        $equipment->total_cost = 60000;
        $equipment->remark = 'This is a permeability remark';
        $equipment->save();
    }
}
