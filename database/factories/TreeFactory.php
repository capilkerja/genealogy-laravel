<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Tree;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tree::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'     => $this->faker->randomElement([1]),
            'company_id'  => Company::where('id', 1)->first()->id,
            'name'        => $this->faker->word(),
            'description' => $this->faker->text(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
            // 'current_tenant' => $this->faker->randomElement(['1', '2']),
        ];
    }
}
