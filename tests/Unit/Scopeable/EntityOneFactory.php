<?php

namespace berthott\Scopeable\Tests\Unit\Scopeable;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntityOneFactory extends Factory
{
    protected $model = EntityOne::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
