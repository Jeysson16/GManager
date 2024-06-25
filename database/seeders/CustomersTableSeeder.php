<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'first_name' => 'Kaory',
                'last_name' => 'González',
                'email' => 'kaory@email.com',
                'phone' => '912345678',
                'address' => 'Av. Libertad 123, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jhon',
                'last_name' => 'Ramírez',
                'email' => 'jhon@email.com',
                'phone' => '923456789',
                'address' => 'Calle Principal 456, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Alonzo',
                'last_name' => 'Pérez',
                'email' => 'alonzo@email.com',
                'phone' => '934567890',
                'address' => 'Jr. Bolívar 789, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Wilson',
                'last_name' => 'Vargas',
                'email' => 'wilson@email.com',
                'phone' => '945678901',
                'address' => 'Av. Progreso 101, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Chanel',
                'last_name' => 'Flores',
                'email' => 'chanel@email.com',
                'phone' => '956789012',
                'address' => 'Calle Los Pinos 234, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Chino',
                'last_name' => 'Castillo',
                'email' => 'chino@email.com',
                'phone' => '967890123',
                'address' => 'Jr. Huamachuco 567, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Elmer',
                'last_name' => 'Díaz',
                'email' => 'elmer@email.com',
                'phone' => '978901234',
                'address' => 'Av. 28 de Julio 890, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Favio',
                'last_name' => 'Ortega',
                'email' => 'favio@email.com',
                'phone' => '989012345',
                'address' => 'Calle San Martín 678, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Juana Cruz',
                'last_name' => 'Carrasco',
                'email' => 'juana@email.com',
                'phone' => '990123456',
                'address' => 'Jr. Ayacucho 123, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ronal Aguirre',
                'last_name' => 'López',
                'email' => 'ronal@email.com',
                'phone' => '901234567',
                'address' => 'Av. América 345, Trujillo, Perú',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
