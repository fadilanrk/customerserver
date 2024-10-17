<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('customer', 'Customer::index'); // Route untuk menampilkan halaman index
$routes->get('/customer/json', 'Customer::showSimpleJson'); // Route untuk menampilkan JSON sederhana dari Customer
$routes->get('customer/data', 'Customer::getCustomer'); // Route untuk mendapatkan customer dalam format JSON
$routes->post('customer/store', 'Customer::storeData'); // Route untuk menyimpan data customer
$routes->get('customer/show', 'Customer::show');
$routes->get('/customer/data-customer', 'Customer::getCustomerDataJson'); // Route untuk mendapatkan data Customer dalam format JSON
$routes->post('customer/update/(:num)', 'Customer::update/$1'); // Route untuk mengupdate data berdasarkan id
$routes->delete('customer/delete/(:num)', 'Customer::delete/$1');
$routes->post('customer/update/(:num)', 'Transaksi::update/$1'); // Route untuk mengupdate data berdasarkan id
$routes->get('/customer/data-customer', 'Customer::getCustomerDataJson'); // Route untuk mengit add gitdapatkan data Customer dalam format JSON
