<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_produk'   => 'Produk A',
                'description'   => 'Deskripsi untuk Produk A',
                'harga'         => 10000,
                'jumlah_stok'   => 50,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_produk'   => 'Produk B',
                'description'   => 'Deskripsi untuk Produk B',
                'harga'         => 15000,
                'jumlah_stok'   => 30,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('produk')->insertBatch($data);
    }
}
