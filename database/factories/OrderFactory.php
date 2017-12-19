<?php

use App\Order;
use App\Status;
use App\Process;
use App\Furniture;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $process = Process::all()[rand(0, 1)];
    $status = Status::all()[rand(0, 2)];
    $item = Furniture::count() ?
        Furniture::inRandomOrder()->first()->id :
        factory(Furniture::class)->create();
    return [
        'process' => $process,
        'status' => $status,
        'furniture_id' => $item->id,
    ];
});
