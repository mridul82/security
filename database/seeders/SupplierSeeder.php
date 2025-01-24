<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            Supplier::create([
                'supplier_code' => 'SUP' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'company_name' => $faker->company,
                
                'contact_person' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                
                'address_line1' => $faker->streetAddress,
                'address_line2' => $faker->secondaryAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'postal_code' => $faker->postcode,
                'country' => $faker->country,
                'payment_terms' => $faker->numberBetween(15, 90) . ' days',
                'credit_limit' => $faker->randomFloat(2, 1000, 10000),
                'bank_name' => $faker->company,
                'bank_account_number' => $faker->bankAccountNumber,
                'bank_iban' => $faker->iban,
                'bank_swift' => $faker->swiftBicNumber,
                'status' => $faker->randomElement(['active', 'inactive']),
                'supplier_product_type' => $faker->randomElement(['mobile', 'accessory', 'part']),
                'payment_method' => $faker->randomElement(['bank_transfer','check','cash','credit_card']),
                'currency' => $faker->currencyCode,
                'tax_rate' => $faker->randomFloat(2, 0, 25),
                'notes' => $faker->sentence,
            ]);
        }
    }
}
