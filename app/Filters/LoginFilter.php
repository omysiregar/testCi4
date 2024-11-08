<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah pengguna sudah login
        if (!session('id_user')) {
            return redirect()->to(site_url('login'));
        }

        $role = session('role');
        // print_r($role);
        // Cek apakah pengguna berada di halaman yang sesuai dengan role
        $currentPath = $request->getPath();

        // Jika pengguna adalah admin
        if ($role === 'admin') {
            // Cegah loop redirect jika pengguna sudah di halaman produk
            if ($currentPath !== 'produk' && strpos($currentPath, 'produk') !== 0) {
                return redirect()->to('produk');
            }
        }
        // Jika pengguna bukan admin (misalnya, role client)
        else {
            // Cegah loop redirect jika pengguna sudah di halaman dashboard
            if ($currentPath !== 'dashboard') {
                return redirect()->to('dashboard');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah request
    }
}
