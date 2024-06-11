@extends('layouts.app')
@section('title', 'TBMJ | Dashboard Pemilik')
@section('content')
    <style>
        <style>.master-data {
            cursor: pointer;
        }

        .master-data:hover {
            box-shadow: 0px 0px 33px -14px rgba(0, 0, 0, 0.75);
            -webkit-box-shadow: 0px 0px 33px -14px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 33px -14px rgba(0, 0, 0, 0.75);
            border-right: 4px solid rgb(0, 98, 128);
            ";

        }

        .info-box {
            box-shadow: 0 1px 2px rgba(3, 53, 192, 0.125), 0 1px 3px rgba(19, 31, 207, 0.2);
            border-radius: 0.50rem;
            background-color: #ffffff;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 1rem;
            min-height: 80px;
            position: relative;
            width: 100%;
            color: #ffffff;
            /* Warna teks menjadi biru */
        }

        .info-box .info-box-icon {
            border-radius: 0.50rem 0 0 0.50rem;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            font-size: 1.875rem;
            -ms-flex-pack: center;
            justify-content: center;
            text-align: center;
            width: 70px;
        }

        .info-box .info-box-icon>img {
            max-width: 100%;
        }

        .info-box .info-box-content {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            line-height: 1.8;
            -ms-flex: 1;
            flex: 1;
            padding: 0 15px;
        }

        .info-box .info-box-text {
            color: #000000e8;
            font-size: 15px;
            /* Misalnya, ganti ukuran font sesuai keinginan Anda */
            font-weight: bold;
            /* Membuat teks menjadi tebal */
        }

        .info-box .info-box-number {
            color: #000000e8;
            font-size: 15px;
            /* Misalnya, ganti ukuran font sesuai keinginan Anda */
            font-weight: bold;
            /* Membuat teks menjadi tebal */
        }
    </style>
    <div class="row mt-4">
        {{-- breadcrumbs --}}
        <div class="d-flex justify-content-end mb-4">
            <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
            <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
        </div>

        <!-- Info-box untuk Jumlah Category -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('category.index') }}">
                <div class="info-box master-data">
                    <div class="info-box-icon bg-warning">
                        <i class="ti ti-category"></i>
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Daftar Kategori</span>
                        <span class="info-box-number">{{ $category }}</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Info-box untuk Jumlah Product -->
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('product.index') }}">
                <div class="info-box master-data">
                    <div class="info-box-icon bg-success">
                        <i class="ti ti-package"></i>
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Daftar Produk</span>
                        <span class="info-box-number">{{ $product }}</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Info-box untuk Jumlah User -->
        <div class="col-lg-4 col-md-6">
            <a href="#">
                <div class="info-box master-data">
                    <div class="info-box-icon bg-danger">
                        <i class="ti ti-user"></i>
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Daftar User</span>
                        <span class="info-box-number">{{ $user }}</span>
                    </div>
                </div>
            </a>
        </div>


    @endsection
