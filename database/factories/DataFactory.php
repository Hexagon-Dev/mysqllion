<?php

namespace Database\Factories;

use App\Models\Data;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Data::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'login' => Str::random(14),
            'name' => Str::random(14),
            'email' => Str::random(10) . '@gmail.com',
            'address' => Str::random(15),
            'occupation' => Str::random(20),
            'skill' => Str::random(14),
            'school' => Str::random(10),
            'degree' => Str::random(10),
            'food' => Str::random(10),
            'color' => Str::random(8),
        ];
    }
}
