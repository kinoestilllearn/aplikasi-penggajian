<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\presensi>
 */
class PresensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pegawai_id'   => 1,
            'waktu_masuk'  => '2021-01-01 ' . $this->faker->time('H:i:s', '09:00:00'),
            'waktu_keluar' => '2021-01-01 ' . $this->faker->time('H:i:s', '22:00:00'),
            'keterangan'   => $this->faker->word(),
        ];
    }
}
