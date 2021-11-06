<?php

use Illuminate\Database\Seeder;
use App\Unit;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Kilogram', 'Gram', 'Box', 'Barrel', 'Carton', 'Bushel', 'Case', 'Centimeter', 'Container  40-Foot', 'Container  20-Foot', 'Cubic Foot', 'Cubic Inch', 'Cubic Meter', 'Cubic Yard', 'Degrees Celsius', 'Degrees Fahrenheit', 'Dozen', 'Dram', 'Fluid Ounce', 'Foot', 'Chain', 'Furlong', 'Gallon', 'Gill', 'Grain', 'Ampere', 'Gross', 'Hectare', 'Hertz', 'Inch', 'Kiloampere', 'Bag', 'Kilohertz', 'Kilometer', 'Kiloohm', 'Kilovolt', 'Kilowatt', 'Liter', 'Long Ton', 'Megahertz', 'Meter', 'Metric Ton', 'Mile', 'Milliampere', 'Milligram', 'Millihertz', 'Milliliter', 'Millimeter', 'Milliohm', 'Millivolt', 'Milliwatt', 'Nautical Mile', 'Ohm', 'Ounce', 'Pack', 'Pallet', 'Pair', 'Parcel', 'Perch', 'Piece', 'Pint', 'Plant', 'Pole', 'Pound', 'Quart', 'Quarter', 'Rod', 'Roll', 'Set', 'Sheet', 'Short Ton', 'Square Centimeter', 'Square Foot', 'Square Inch', 'Square Meter', 'Square Mile', 'Square Yard', 'Stone', 'Strand', 'Ton', 'Tonne', 'Tray', 'Cubic Centimeter', 'Volt', 'Watt', 'Wp', 'Yard', 'HD Bag', 'Plastic  Can', 'Tin Cans', 'Pet Bottles', 'Jar', 'Tin', 'Glass'
        ];

        if (@$datas) {
            foreach ($datas as $data) {
                DB::table('unit')->insert([
                    'name' => $data,
                    'sign_date' => date('y-m-d h:m:s'),
                ]);
            }
        }
    }
}
