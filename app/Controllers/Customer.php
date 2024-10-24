<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\RESTful\ResourceController;

class Customer extends ResourceController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $data_customer = $this->customerModel->findAll();
        return $this->respond($data_customer, 200)->setContentType('application/json');
    }

    public function create()
    {
        $input_data = $this->request->getJSON(true);
        if ($input_data) {
            $data = [
                'nik_customer'   => $input_data['nik_customer'] ?? '',
                'nama_customer'  => $input_data['nama_customer'] ?? '',
                'jenis_kelamin'  => $input_data['jenis_kelamin'] ?? '',
                'pekerjaan'      => $input_data['pekerjaan'] ?? '',
                'nomor_telepon'  => $input_data['nomor_telepon'] ?? '',
                'alamat'         => $input_data['alamat'] ?? '',
                'email'          => $input_data['email'] ?? ''
            ];

            if ($this->customerModel->saveCustomer($data)) {
                return $this->respondCreated(
                    ['status' => 'success', 'message' => 'Customer berhasil ditambahkan']
                )->setContentType('application/json');
            } else {
                return $this->fail(
                    'Gagal menambah customer',
                    400
                )->setContentType('application/json');
            }
        } else {
            return $this->fail(
                'Invalid JSON input',
                400
            )->setContentType('application/json');
        }
    }
 
    public function show($id = null)
    {
        $customer = $this->customerModel->getCustomerById($id);
        if ($customer) {
            return $this->response->setJSON($customer);
        } else {
            return $this->failNotFound('Customer tidak ditemukan'); 
        }
    }

    public function getCustomer()
    {
        $customerModel = new CustomerModel(); // Corrected variable name to match conventions

        $customers = $customerModel->getCustomer(); // Changed to match the correct variable name

        return $this->response->setJSON($customers);
    }

    public function update($id = null)
    {
        $input_data = $this->request->getJSON(true);

        if ($input_data) {
            $data = [
                'nik_customer'   => $input_data['nik_customer'] ?? '',
                'nama_customer'  => $input_data['nama_customer'] ?? '',
                'jenis_kelamin'  => $input_data['jenis_kelamin'] ?? '',
                'pekerjaan'      => $input_data['pekerjaan'] ?? '',
                'nomor_telepon'  => $input_data['nomor_telepon'] ?? '',
                'alamat'         => $input_data['alamat'] ?? '',
                'email'          => $input_data['email'] ?? ''
            ];

            if ($this->customerModel->update($id, $data)) {
                return $this->respond(
                    ['status' => 'success', 'message' => 'Customer berhasil diperbarui'],
                    200,
                    ['Content-Type' => 'application/json']
                );
            } else {
                return $this->fail(
                    'Gagal memperbarui customer',
                    400,
                    ['Content-Type' => 'application/json']
                );
            }
        } else {
            return $this->fail(
                'Invalid JSON input',
                400,
                ['Content-Type' => 'application/json']
            );
        }
    }

    public function delete($id = null)
    {
        if ($this->customerModel->delete($id)) {
            return $this->respondDeleted(
                ['status' => 'success', 'message' => 'Customer berhasil dihapus'],
                200,
                ['Content-Type' => 'application/json']
            );
        } else {
            return $this->fail(
                'Gagal menghapus customer',
                400,
                ['Content-Type' => 'application/json']
            );
        }
    }
}
