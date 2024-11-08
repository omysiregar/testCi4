<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $dataAdmin = [
            'email'    => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role'     => 'admin',
        ];

        $dataClient = [
            'email'    => 'client@example.com',
            'password' => password_hash('client123', PASSWORD_DEFAULT),
            'role'     => 'client',
        ];

        $this->db->table('users')->insert($dataAdmin);
        $this->db->table('users')->insert($dataClient);
    }
}
