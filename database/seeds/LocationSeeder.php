<?php

use App\City;
use App\Province;
use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $row) {
            Province::create([
                'province_id' => $row['province_id'],
                'name' => $row['province'],

            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($row['province_id'])->get();
            foreach ($daftarKota as $rows) {
                City::create([
                    'province_id' => $rows['province_id'],
                    'city_id' => $rows['city_id'],
                    'name' => $rows['city_name'],
                ]);
            }
        }
    }
}
