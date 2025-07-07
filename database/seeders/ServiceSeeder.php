<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Cuci Kering',
                'description' => 'Pakaian sehari-hari, bed cover, selimut',
                'price' => 6000,
                'unit' => 'kg',
                'duration_hours' => 48,
            ],
            [
                'name' => 'Cuci Setrika',
                'description' => 'Pakaian rapi siap pakai',
                'price' => 8000,
                'unit' => 'kg',
                'duration_hours' => 48,
            ],
            [
                'name' => 'Dry Clean',
                'description' => 'Jas, gaun, pakaian premium',
                'price' => 25000,
                'unit' => 'pcs',
                'duration_hours' => 72,
            ],
            [
                'name' => 'Express 24 Jam',
                'description' => 'Selesai dalam 24 jam',
                'price' => 12000,
                'unit' => 'kg',
                'duration_hours' => 24,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
