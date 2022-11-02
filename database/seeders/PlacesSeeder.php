<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlacesSeeder extends Seeder
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
                'user_id' => 1,
                'name' => 'OUSL. Matara',
                'is_favourite' => 1,
                'description' => 'Matara Regional Center of the Open University of Sri Lanka.',
                'image' => 'Empty',
                'coordinates' => '5.9507227,80.5322112',
                'province' => 'Southern Province',
                'address' => 'OUSL, Akuressa Road, Matara.',
                'distance' => '1.0 km',
                'by_car' => '0 hr 4',
                'by_public_transport' => 'N/A',
            ],
            [
                'user_id' => 2,
                'name' => 'OUSL. Nawala',
                'is_favourite' => 1,
                'description' => 'Nawala Regional Center of the Open University of Sri Lanka.',
                'image' => 'Empty',
                'coordinates' => '6.8829660,19.8867366',
                'province' => 'Western Province',
                'address' => 'OUSL, Akuressa Road, Matara.',
                'distance' => '156 km',
                'by_car' => '2 hr 19',
                'by_public_transport' => '3 hr 9',
            ],
            [
                'user_id' => 1,
                'name' => 'Workplace',
                'is_favourite' => 0,
                'description' => 'My Workplace.',
                'image' => 'Empty',
                'coordinates' => '6.6873200,79.8631623',
                'province' => 'Western Province',
                'address' => 'IFS Sri Lanka Office, Colombo',
                'distance' => '156 km',
                'by_car' => '2 hr 19',
                'by_public_transport' => '3 hr 9',
            ]
        ];

        foreach ($places as $key => $value) {
            Place::create($value);
        }
    }
}
