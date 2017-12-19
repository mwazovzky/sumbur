<?php

use App\Furniture;
use Illuminate\Database\Seeder;

class FurnitureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Furniture::class)->create([
            'name' => 'Полка',
            'description' => 'Описание полки',
        ]);

        factory(Furniture::class)->create([
            'name' => 'Шкаф',
            'description' => 'Описание шкафа',
        ]);

        factory(Furniture::class)->create([
            'name' => 'Коробка',
            'description' => 'Описание коробки',
        ]);
    }
}
