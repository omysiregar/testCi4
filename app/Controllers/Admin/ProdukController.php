<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();

        $data['title'] = 'Produk';
        $data['produk'] = $produkModel->orderBy('produk_id', 'DESC')->findAll();
        return view('admin/produk/index', $data);
    }


    public function store()
    {
        // Validasi
        if (!$this->validate([
            'nama_produk' => 'required|max_length[100]',
            'harga' => 'required|decimal',
            'jumlah_stok' => 'required|integer',
            'description' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'description' => $this->request->getPost('description'),
            'harga' => $this->request->getPost('harga'),
            'jumlah_stok' => $this->request->getPost('jumlah_stok'),
        ];
        $productModel = new ProdukModel();
        // Simpan
        if ($productModel->insert($data)) {
            return redirect()->to('produk')->with('success', 'Berhasil menambah data');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal Tersimpan');
        }
    }
    public function ubah()
    {
        // Validasi
        $produk_id = $this->request->getPost('id_produk');
        if (empty($produk_id)) {
            return redirect()->back()->withInput()->with('error', 'Data yang ingin di edit bermasalah');
        }
        if (!$this->validate([
            'nama_produk' => 'required|max_length[100]',
            'harga' => 'required|decimal',
            'jumlah_stok' => 'required|integer',
            'description' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Update data produk
        $productModel = new ProdukModel();
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'description' => $this->request->getPost('description'),
            'harga' => $this->request->getPost('harga'),
            'jumlah_stok' => $this->request->getPost('jumlah_stok'),
        ];

        if ($productModel->update($produk_id, $data)) {
            return redirect()->to('produk')->with('success', 'Berhasil memperbaharui data');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal Tersimpan');
        }
    }

    public function delete($id)
    {
        $productModel = new ProdukModel();

        // Cek apakah data ada sebelum menghapus
        if ($productModel->find($id)) {
            $productModel->delete($id);
            return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus');
        } else {
            return redirect()->to('/produk')->with('error', 'Produk tidak ditemukan');
        }
    }
}
