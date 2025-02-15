<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'kode_produk' => 'PAK123',
                'nama' => 'Paku 1kg',
                'stok' => '20',
                'harga_beli' => '20000',
                'harga_jual' => '22000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'KAW456',
                'nama' => 'Kawat 1kg',
                'stok' => '20',
                'harga_beli' => '25000',
                'harga_jual' => '28000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'SEM789',
                'nama' => 'Semen 1sak',
                'stok' => '20',
                'harga_beli' => '60000',
                'harga_jual' => '68000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'KWP101',
                'nama' => 'Kawat Putih 1iket',
                'stok' => '20',
                'harga_beli' => '9000',
                'harga_jual' => '10000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'PAS234',
                'nama' => 'Pasir 1kol',
                'stok' => '20',
                'harga_beli' => '170000',
                'harga_jual' => '185000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'BAT345',
                'nama' => 'Bata 1pcs',
                'stok' => '20',
                'harga_beli' => '600',
                'harga_jual' => '650',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'TRI456',
                'nama' => 'Triplek 3ml',
                'stok' => '20',
                'harga_beli' => '50000',
                'harga_jual' => '55000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'TRI567',
                'nama' => 'Triplek 4ml',
                'stok' => '20',
                'harga_beli' => '60000',
                'harga_jual' => '65000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'PIP678',
                'nama' => 'Pipa 1/2 Wavin',
                'stok' => '20',
                'harga_beli' => '32000',
                'harga_jual' => '35000',
                'category_id' => 2,
            ],
            [
                'kode_produk' => 'PIP789',
                'nama' => 'Pipa 1/2 Biasa',
                'stok' => '20',
                'harga_beli' => '23000',
                'harga_jual' => '25000',
                'category_id' => 2,
            ],
            [
                'kode_produk' => 'KEN890',
                'nama' => 'Keni 1/2',
                'stok' => '20',
                'harga_beli' => '4500',
                'harga_jual' => '5000',
                'category_id' => 2,
            ],
            [
                'kode_produk' => 'KEN901',
                'nama' => 'Keni 3/4',
                'stok' => '20',
                'harga_beli' => '5500',
                'harga_jual' => '6000',
                'category_id' => 2,
            ],
            [
                'kode_produk' => 'PIP123',
                'nama' => 'Pipa 3/4',
                'stok' => '20',
                'harga_beli' => '32000',
                'harga_jual' => '35000',
                'category_id' => 2,
            ],
            [
                'kode_produk' => 'PIP234',
                'nama' => 'Pipa 3/4 Wavin',
                'stok' => '20',
                'harga_beli' => '42000',
                'harga_jual' => '45000',
                'category_id' => 2,
            ],
            [
                'kode_produk' => 'TEE345',
                'nama' => 'Tee 1/2',
                'stok' => '20',
                'harga_beli' => '5500',
                'harga_jual' => '6000',
                'category_id' => 2,
            ],
            [
                'kode_produk' => 'TEE456',
                'nama' => 'Tee 3/4',
                'stok' => '20',
                'harga_beli' => '6500',
                'harga_jual' => '7000',
                'category_id' => 2,
            ],
            [
                'kode_produk' => 'SEM567',
                'nama' => 'Semen 1kg',
                'stok' => '20',
                'harga_beli' => '1800',
                'harga_jual' => '2000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'SEM678',
                'nama' => 'Semen Putih 1kg',
                'stok' => '20',
                'harga_beli' => '4500',
                'harga_jual' => '5000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'KOM789',
                'nama' => 'Kompon 1kg',
                'stok' => '20',
                'harga_beli' => '4500',
                'harga_jual' => '5000',
                'category_id' => 4,
            ],
            [
                'kode_produk' => 'LEM890',
                'nama' => 'Lem Fox 1pcs',
                'stok' => '20',
                'harga_beli' => '14000',
                'harga_jual' => '15000',
                'category_id' => 4,
            ],
            [
                'kode_produk' => 'LEM901',
                'nama' => 'Lem Pipa 1botol',
                'stok' => '20',
                'harga_beli' => '16000',
                'harga_jual' => '17000',
                'category_id' => 4,
            ],
            [
                'kode_produk' => 'SOL123',
                'nama' => 'Solatip Air 1pcs',
                'stok' => '20',
                'harga_beli' => '4500',
                'harga_jual' => '5000',
                'category_id' => 4,
            ],
            [
                'kode_produk' => 'SOL234',
                'nama' => 'Solatip Listrik Besar 1pcs',
                'stok' => '20',
                'harga_beli' => '14000',
                'harga_jual' => '15000',
                'category_id' => 4,
            ],
            [
                'kode_produk' => 'SOL345',
                'nama' => 'Solatip Listrik Kecil 1pcs',
                'stok' => '20',
                'harga_beli' => '4500',
                'harga_jual' => '5000',
                'category_id' => 4,
            ],
            [
                'kode_produk' => 'KOA456',
                'nama' => 'Koas 1 in',
                'stok' => '20',
                'harga_beli' => '2500',
                'harga_jual' => '3000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'KOA567',
                'nama' => 'Koas 1 1/2 in',
                'stok' => '20',
                'harga_beli' => '4500',
                'harga_jual' => '5000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'KOA678',
                'nama' => 'Koas 2 in',
                'stok' => '20',
                'harga_beli' => '6500',
                'harga_jual' => '7000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'KOA789',
                'nama' => 'Koas 2 1/2 in',
                'stok' => '20',
                'harga_beli' => '7500',
                'harga_jual' => '8000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'KOA890',
                'nama' => 'Koas 3 in',
                'stok' => '20',
                'harga_beli' => '8500',
                'harga_jual' => '9000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'KOA901',
                'nama' => 'Koas 4 in',
                'stok' => '20',
                'harga_beli' => '9500',
                'harga_jual' => '10000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'MET123',
                'nama' => 'Meteran 3 meter',
                'stok' => '20',
                'harga_beli' => '16000',
                'harga_jual' => '18000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'MET234',
                'nama' => 'Meteran 5 meter',
                'stok' => '20',
                'harga_beli' => '23000',
                'harga_jual' => '25000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'MET345',
                'nama' => 'Meteran 7.5 meter',
                'stok' => '20',
                'harga_beli' => '32000',
                'harga_jual' => '35000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'KER456',
                'nama' => 'Keran Air',
                'stok' => '20',
                'harga_beli' => '14000',
                'harga_jual' => '15000',
                'category_id' => 7,
            ],
            [
                'kode_produk' => 'EMB567',
                'nama' => 'Ember Bagus',
                'stok' => '20',
                'harga_beli' => '9000',
                'harga_jual' => '10000',
                'category_id' => 7,
            ],
            [
                'kode_produk' => 'EMB678',
                'nama' => 'Ember Biasa',
                'stok' => '20',
                'harga_beli' => '7000',
                'harga_jual' => '8000',
                'category_id' => 7,
            ],
            [
                'kode_produk' => 'KAW789',
                'nama' => 'Kawat Ram Biasa 1meter',
                'stok' => '20',
                'harga_beli' => '16000',
                'harga_jual' => '17500',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'KAW890',
                'nama' => 'Kawat Ram Bagus 1meter',
                'stok' => '20',
                'harga_beli' => '23000',
                'harga_jual' => '25000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'BEN901',
                'nama' => 'Benang',
                'stok' => '20',
                'harga_beli' => '3500',
                'harga_jual' => '4000',
                'category_id' => 1,
            ],
            [
                'kode_produk' => 'CAT123',
                'nama' => 'Cat Q-LUC',
                'stok' => '20',
                'harga_beli' => '75000',
                'harga_jual' => '78000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'KAR234',
                'nama' => 'Karbit',
                'stok' => '20',
                'harga_beli' => '4500',
                'harga_jual' => '5000',
                'category_id' => 4,
            ],
            [
                'kode_produk' => 'STO345',
                'nama' => 'Stop kontak Lampu',
                'stok' => '20',
                'harga_beli' => '18000',
                'harga_jual' => '20000',
                'category_id' => 5,
            ],
            [
                'kode_produk' => 'ROL456',
                'nama' => 'Roll Cat',
                'stok' => '20',
                'harga_beli' => '28000',
                'harga_jual' => '30000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'BAK567',
                'nama' => 'Bak Cat',
                'stok' => '20',
                'harga_beli' => '10000',
                'harga_jual' => '12000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'TIN678',
                'nama' => 'Tinner',
                'stok' => '20',
                'harga_beli' => '7000',
                'harga_jual' => '8000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'CAT789',
                'nama' => 'Cat Kecil',
                'stok' => '20',
                'harga_beli' => '13000',
                'harga_jual' => '15000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'AMP890',
                'nama' => 'Amplas 1meter',
                'stok' => '20',
                'harga_beli' => '9000',
                'harga_jual' => '10000',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'AMP901',
                'nama' => 'Amplas Kecil 1pcs',
                'stok' => '20',
                'harga_beli' => '1300',
                'harga_jual' => '1500',
                'category_id' => 3,
            ],
            [
                'kode_produk' => 'KUN123',
                'nama' => 'Kunci Pintu',
                'stok' => '20',
                'harga_beli' => '90000',
                'harga_jual' => '100000',
                'category_id' => 6,
            ],
            [
                'kode_produk' => 'GEM234',
                'nama' => 'Gembok Kecil',
                'stok' => '20',
                'harga_beli' => '18000',
                'harga_jual' => '20000',
                'category_id' => 6,
            ],
            [
                'kode_produk' => 'GEM345',
                'nama' => 'Gembok Sedang',
                'stok' => '20',
                'harga_beli' => '32000',
                'harga_jual' => '35000',
                'category_id' => 6,
            ],
            [
                'kode_produk' => 'GEM456',
                'nama' => 'Gembok Besar',
                'stok' => '20',
                'harga_beli' => '42000',
                'harga_jual' => '45000',
                'category_id' => 6,
            ],
        ];

        foreach ($products as $item) {
            Product::insert([
                'kode_produk' => $item['kode_produk'],
                'nama' => $item['nama'],
                'stok' => $item['stok'],
                'harga_beli' => $item['harga_beli'],
                'harga_jual' => $item['harga_jual'],
                'category_id' => $item['category_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
