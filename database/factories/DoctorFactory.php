<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'name' => $this->faker->name,
        'speciality' => 'Physician',
        'email' => $this->faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'contact' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999),
        'yrs_of_exp' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 20),
        'profile_link' => '/images/profile-user.png',
      ];
    }
}
