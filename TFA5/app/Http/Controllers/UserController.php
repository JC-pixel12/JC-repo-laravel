<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            [
                'id' => 1,
                'username' => 'admin',
                'full_name' => 'Alex Rivera',
                'role' => 'Administrator',
            ],
            [
                'id' => 2,
                'username' => 'cashier01',
                'full_name' => 'Sofia Cruz',
                'role' => 'Cashier',
            ],
            [
                'id' => 3,
                'username' => 'cashier02',
                'full_name' => 'Miguel Torres',
                'role' => 'Cashier',
            ],
            [
                'id' => 4,
                'username' => 'manager01',
                'full_name' => 'Isabella Ramos',
                'role' => 'Manager',
            ],
            [
                'id' => 5,
                'username' => 'staff01',
                'full_name' => 'Daniel Flores',
                'role' => 'Staff',
            ],
        ];

        return view('users', compact('users'));
    }
}
