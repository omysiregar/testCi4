<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        if (session('id_user')) {
            return redirect()->to(site_url('dashboard'));
        }
        return view('login');
    }

    public function loginProcess()
    {
        $userModel = new UserModel();
        $post = $this->request->getPost();
        $query = $userModel->getWhere(['email' => $post['username']]);
        $user = $query->getRow();
        if ($user) {
            if (password_verify($post['password'], $user->password)) {
                $params = ['id_user' => $user->id,'role' => $user->role];
                session()->set($params);

                // return redirect()->to(site_url('dashboard'));

                // Mendapatkan role pengguna dari session
                $role = session()->get('role');
                $uri = current_url();  // Mendapatkan URL saat ini

                // Membatasi akses menu 'produk' hanya untuk admin
                if ($role !== 'admin') {
                    return redirect()->to('dashboard');  // Jika bukan admin, redirect ke dashboard
                }

                // Membatasi akses menu 'dashboard' hanya untuk user selain admin
                if ($role == 'admin') {
                    return redirect()->to('produk');  // Jika admin, redirect ke menu produk
                }
            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->remove('id_user');
        return redirect()->to(site_url('login'));
    }
}
