<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_pegawai'       => fake()->unique()->numerify('################'),
            'nama'             => fake()->name(),
            'departemen_id'    => rand(1, 14),
            'posisi_id'        => rand(1, 6),
            'status_pegawai'   => fake()->randomElement(['tetap', 'kontrak', 'HL']),
            'masa_kerja_tahun' => fake()->numberBetween(0, 10),
            'tempat_lahir'     => fake()->city(),
            'tanggal_lahir'    => fake()->dateTimeBetween('-50 years', '-20 years'),
            'jenis_kelamin'    => fake()->randomElement(['L', 'P']),
            'gaji_pokok'       => fake()->randomFloat(2, 5000000, 80000000),
            'tunjangan_tetap'  => fake()->randomFloat(2, 500000, 5000000),
        ];
    }
}
