<?php

namespace App\Controllers;

class Customer extends BaseController
{
    // Fungsi untuk menampilkan semua data customer
    public function index()
    {
        $url = 'http://10.10.25.13:8080/customer/data';  // Ubah URL API jika perlu
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->request('GET', $url);
            $data['customer'] = json_decode($response->getBody(), true);

            return view('customer', $data);  // View untuk menampilkan data customer
        } catch (\Exception $e) {
            return view('customer', ['error' => $e->getMessage()]);
        }
    }

    // Fungsi untuk menampilkan form tambah data customer
    public function tambahCustomer()
    {
        return view('input-customer');  // View untuk menampilkan form tambah customer
    }

    // Fungsi untuk mengirim data customer ke API (Create)
    public function sendData()
    {
        $data = [
            'nik_customer' => $this->request->getPost('nik_customer'),
            'nama_customer' => $this->request->getPost('nama_customer'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
        ];

        $url = 'http://10.10.25.13:8080/customer/data';  // URL API tujuan
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_status == 200) {
                return redirect()->to('/customer')->with('success', 'Data customer berhasil disimpan!');
            } else {
                return redirect()->to('/customer')->with('error', 'Gagal menyimpan data customer! Kode Status: ' . $http_status);
            }
        }

        curl_close($ch);
    }

    // Fungsi untuk menampilkan data customer yang akan diedit
    public function edit($id)
    {
        $url = 'http://10.10.25.13:8080/customer/data/' . $id;  // URL API untuk mendapatkan data berdasarkan ID
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->request('GET', $url);
            $data['customer'] = json_decode($response->getBody(), true);

            if (!$data['customer']) {
                return redirect()->to('/customer')->with('error', 'Customer tidak ditemukan.');
            }

            return view('edit-customer', $data);  // View untuk edit customer
        } catch (\Exception $e) {
            return view('edit-customer', ['error' => $e->getMessage()]);
        }
    }

    // Fungsi untuk mengirim perubahan data customer ke API (Update)
    public function editCustomer()
    {
        $data = [
            'id_customer' => $this->request->getPost('id_customer'),
            'nik_customer' => $this->request->getPost('nik_customer'),
            'nama_customer' => $this->request->getPost('nama_customer'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
        ];

        $url = 'http://10.10.25.13:8080/customer/data';  // URL API untuk update data
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->setBody(json_encode($data))
                               ->setHeader('Content-Type', 'application/json')
                               ->request('PUT', $url);

            if ($response->getStatusCode() == 200) {
                return redirect()->to('/customer')->with('success', 'Customer berhasil diperbarui!');
            } else {
                return redirect()->to('/customer')->with('error', 'Gagal memperbarui customer!');
            }
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Fungsi untuk menghapus data customer (Delete)
    public function hapus($id)
    {
        $url = 'http://10.10.25.13:8080/customer/data/' . $id;  // URL API untuk menghapus data berdasarkan ID
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->request('DELETE', $url);

            if ($response->getStatusCode() == 200) {
                return redirect()->to('/customer')->with('success', 'Customer berhasil dihapus!');
            } else {
                return redirect()->to('/customer')->with('error', 'Gagal menghapus customer!');
            }
        } catch (\Exception $e) {
            return redirect()->to('/customer')->with('error', $e->getMessage());
        }
    }
}
