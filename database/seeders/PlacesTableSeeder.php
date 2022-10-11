<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = [
            [
                'name' => 'OUSL, Matara',
                'is_favourite' => 1,
                'description' => 'Matara Regional Center of "The Open University of Sri Lanka".',
                'image' => 'Empty',
                'latitude' => '',
                'longitude' => '',
                'address' => 'OUSL, Akuressa Road, Nupe, Matara',
                'distance' => '1.6 km',
                'by_car' => '0hr 14',
                'by_public_transport' => '0hr 25'
            ],
            [
                'name' => 'OUSL, Nawala',
                'is_favourite' => 0,
                'description' => 'Nawala Regional Center of "The Open University of Sri Lanka".',
                'image' => 'Empty',
                'latitude' => '',
                'longitude' => '',
                'address' => 'OUSL, Nawala, Nugegoda',
                'distance' => '156 km',
                'by_car' => '2hr 20',
                'by_public_transport' => '3hr 15'
            ]
        ];

        foreach ($places as $key => $value){
            Place::create($value);
        }
    }
}
