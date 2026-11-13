<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Carbon;

class PosSystemSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $customers = [
            [
                'full_name' => 'Juan Dela Cruz',
                'email' => 'juan@gmail.com',
                'phone' => '09171234567',
            ],
            [
                'full_name' => 'Maria Santos',
                'email' => 'maria@gmail.com',
                'phone' => '09181234567',
            ],
            [
                'full_name' => 'Pedro Reyes',
                'email' => 'pedro@gmail.com',
                'phone' => '09191234567',
            ],
            [
                'full_name' => 'Ana Garcia',
                'email' => 'ana@gmail.com',
                'phone' => '09201234567',
            ],
            [
                'full_name' => 'Jose Mendoza',
                'email' => 'jose@gmail.com',
                'phone' => '09211234567',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(
                ['email' => $customer['email']],
                array_merge($customer, [
                    'created_at' => $now,
                ])
            );
        }

        $users = [
            [
                'username' => 'admin',
                'full_name' => 'Alex Rivera',
            ],
            [
                'username' => 'cashier01',
                'full_name' => 'Sofia Cruz',
            ],
            [
                'username' => 'cashier02',
                'full_name' => 'Miguel Torres',
            ],
            [
                'username' => 'manager01',
                'full_name' => 'Isabella Ramos',
            ],
            [
                'username' => 'staff01',
                'full_name' => 'Daniel Flores',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                array_merge($user, [
                    'created_at' => $now,
                ])
            );
        }
    }
}