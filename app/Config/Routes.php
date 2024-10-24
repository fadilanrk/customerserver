<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::index');
 $routes->get('customer', 'Customer::index'); // Route untuk menampilkan halaman index customer
 $routes->get('customer/json', 'Customer::showSimpleJson'); // Route untuk menampilkan JSON sederhana dari customer (pastikan method ada di controller)
 $routes->get('customer/data', 'Customer::getCustomer'); // Route untuk mendapatkan semua data customer dalam format JSON
 $routes->post('customer/store', 'Customer::create'); // Route untuk menyimpan data customer baru
 $routes->get('customer/data-customer', 'Customer::getCustomerDataJson'); // Route untuk mendapatkan data customer dalam format JSON
 $routes->post('customer/update/(:num)', 'Customer::update/$1'); // Route untuk mengupdate data customer berdasarkan nik_customer
 $routes->delete('customer/delete/(:num)', 'Customer::delete/$1'); // Route untuk menghapus data customer berdasarkan nik_customer
 $routes->get('customer/show/(:num)', 'Customer::show/$1'); // Route untuk menampilkan data customer berdasarkan nik_customer