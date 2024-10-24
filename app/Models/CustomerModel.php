<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer'; 
    protected $primaryKey = 'nik_customer';
    protected $allowedFields = [
        'nik_customer', 
        'nama_customer', 
        'jenis_kelamin', 
        'pekerjaan', 
        'nomor_telepon', 
        'alamat', 
        'email'
    ];

    // Method untuk mengambil semua data customer
    public function getCustomer()
    {    
        return $this->findAll();
    }

    // Method untuk mengambil data customer berdasarkan NIK
    public function getCustomerById($nik_customer)
    {
        return $this->find($nik_customer);
    }

    // Method untuk menyimpan data baru atau memperbarui data yang sudah ada
    public function saveCustomer($data)
    {
        return $this->save($data);
    }

    // Method untuk memperbarui data customer yang sudah ada
    public function updateCustomer($nik_customer, $data)
    {
        return $this->update($nik_customer, $data);
    }

    // Method untuk menghapus data customer berdasarkan NIK
    public function deleteCustomer($nik_customer)
    {
        return $this->delete($nik_customer);
    }
}