<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use CodeIgniter\API\ResponseTrait;

class ProductController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $productModel = new ProdukModel();
        $products = $productModel->findAll();

        return $this->respond(['products' => $products], 200);
    }

    public function show($id = null)
    {
        $productModel = new ProdukModel();
        $product = $productModel->find($id);

        if ($product) {
            return $this->respond(['product' => $product], 200);
        } else {
            return $this->failNotFound('Product not found');
        }
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required'
        ];

        if ($this->validate($rules)) {
            $productModel = new ProdukModel();
            $data = [
                'nama_produk' => $this->request->getVar('nama'),
                'harga' => $this->request->getVar('harga'),
                'description' => $this->request->getVar('deskripsi'),
                'jumlah_stok' => $this->request->getVar('stok')
            ];

            $productModel->save($data);

            return $this->respondCreated(['status' => true, 'message' => 'Product created successfully']);
        } else {
            return $this->respond(['status' => false, 'errors' => $this->validator->getErrors()], 422);
        }
    }

    public function update($id = null)
    {
        $rules = [
            'nama' => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required'
        ];

        if ($this->validate($rules)) {
            $productModel = new ProdukModel();
            $data = [
                'nama_produk' => $this->request->getVar('nama'),
                'harga' => $this->request->getVar('harga'),
                'description' => $this->request->getVar('deskripsi'),
                'jumlah_stok' => $this->request->getVar('stok')
            ];

            if ($productModel->update($id, $data)) {
                return $this->respond(['status' => true, 'message' => 'Product updated successfully'], 200);
            } else {
                return $this->failNotFound('Product not found');
            }
        } else {
            return $this->respond(['status' => false, 'errors' => $this->validator->getErrors()], 422);
        }
    }

    public function delete($id = null)
    {
        $productModel = new ProdukModel();
        $product = $productModel->find($id);

        if ($product) {
            $productModel->delete($id);
            return $this->respondDeleted(['status' => true, 'message' => 'Product deleted successfully']);
        } else {
            return $this->failNotFound('Product not found');
        }
    }
}
