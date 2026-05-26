@extends('layouts.app')

@section('title', 'katalog')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
<link rel="stylesheet" href="{{ asset('css/page/katalog.css') }}" >

@endpush

@section('content')

@include('components.navbar')

    <main>
      <section class="title">
        <b>OUR<br />CATALOG</b>
      </section>

      <!-- FILTER KATEGORI-->
      <section class="filter-container">
          <div class="dropdown">
              <select name="kategori" id="kategori">
                  <option value="" disabled selected>Kategori</option>
                  <option value="Dress"
                  {{ request('kategori') == 'Dress' ? 'selected' : '' }}>
                  Dress
                </option>
                  <option value="Croptop"
                  {{ request('kategori') == 'Croptop' ? 'selected' : '' }}>
                  Crop top
                  </option>
                  <option value="OffShoulder"
                  {{ request('kategori') == 'OffShoulder' ? 'selected' : '' }}>
                  Off-Shoulder
                  </option>
                  <option value="Blouse"
                  {{ request('kategori') == 'Blouse' ? 'selected' : '' }}>
                  Blouse
                  </option>
                  <option value="Tanktop"
                  {{ request('kategori') == 'Tanktop' ? 'selected' : '' }}>
                  Tanktop
                  </option>
                  <option value="Corset"
                  {{ request('kategori') == 'Corset' ? 'selected' : '' }}>
                  Corset
                  </option>
                  <option value="T-Shirt"
                  {{ request('kategori') == 'T-shirt' ? 'selected' : '' }}>
                  T-Shirt
                  </option>
                  <option value="Shirt"
                  {{ request('kategori') == 'Shirt' ? 'selected' : '' }}>
                  Shirt
                  </option>
                  <option value="Jeans"
                  {{ request('kategori') == 'Jeans' ? 'selected' : '' }}>
                  Jeans
                  </option>
                  <option value="Skirt"
                  {{ request('kategori') == 'Skirt' ? 'selected' : '' }}>
                  Skirt
                  </option>
                  <option value="Skort"
                  {{ request('kategori') == 'Skort' ? 'selected' : '' }}>
                  Skort
                  </option>
                  <option value="Shorts"
                  {{ request('kategori') == 'Shorts' ? 'selected' : '' }}>
                  Shorts
                  </option>
                  <option value="Cargo"
                  {{ request('kategori') == 'Cargo' ? 'selected' : '' }}>
                  Cargo
                  </option>
                  <option value="Rippedjeans"
                  {{ request('kategori') == 'Rippedjeans' ? 'selected' : '' }}>
                  Ripped jeans
                  </option>
              </select>
              <img src="{{ asset('assets/icon/kategori-filter.svg') }}" alt="filter icon">
          </div>

          <div class="dropdown">
              <select name="sorting" id="sorting">
                <option value="" disabled selected>Sorting</option>
                <option value="hargaTertinggi"
                {{ request('sorting') == 'hargaTertinggi' ? 'selected' : '' }}>
                Harga Tertinggi
                </option>

                <option value="hargaTerendah"
                {{ request('sorting') == 'hargaTerendah' ? 'selected' : '' }}>
                Harga Terendah
                </option>
              </select>
              <img src="{{ asset('assets/icon/icon-sorting.svg') }}" alt="filter icon">
          </div>

          <div class="dropdown">
              <select name="size" id="size">
                  <option value="" disabled selected>Size</option>
                  <option value="S"
                  {{ request('size') == 'S' ? 'selected' : '' }}>
                  S
                  </option>

                  <option value="M"
                  {{ request('size') == 'M' ? 'selected' : '' }}>
                  M
                  </option>

                  <option value="L"
                  {{ request('size') == 'L' ? 'selected' : '' }}>
                  L
                  </option>

                  <option value="XL"
                  {{ request('size') == 'XL' ? 'selected' : '' }}>
                  XL
                  </option>
              </select>
              <img src="{{ asset('assets/icon/ruler-filter.svg') }}" alt="filter icon">
          </div>

          <div class="dropdown">
              <select name="colors" id="colors">
                  <option value="" disabled selected>Colors</option>
                  <option value="Hitam"
                  {{ request('colors') == 'Hitam' ? 'selected' : '' }}>
                  Hitam
                  </option>

                  <option value="Coklat"
                  {{ request('colors') == 'Coklat' ? 'selected' : '' }}>
                  Coklat
                  </option>

                  <option value="Pink"
                  {{ request('colors') == 'Pink' ? 'selected' : '' }}>
                  Pink
                  </option>
              </select>
              <img src="{{ asset('assets/icon/color-filter.svg') }}" alt="filter icon">
          </div>
      </section>

      <div class="filter-actions">

          <a href="/katalog" class="reset-btn">
              Reset Filter
          </a>

      </div>

      <!-- PRODUCTS CARD -->
<section class="products">

@foreach($products as $product)

@php
    $variant = $product->variants->first();
    $image = $variant?->images->first();
@endphp

<div class="card product-card"
    data-name="{{ $product->product_name }}"
    data-description="{{ $product->description }}"
    data-price="{{ number_format($variant->price ?? 0, 0, ',', '.') }}"
    data-category="{{ $product->category->category_name }}"
    data-image="{{ asset($image->image_url ?? 'assets/default.jpg') }}"
    data-sizes="{{ $product->variants->pluck('size')->unique()->implode(',') }}"
    data-colors="{{ $product->variants->pluck('color')->unique()->implode(',') }}">

    <img src="{{ asset($image->image_url ?? 'assets/default.jpg') }}" alt="product">


    <h3>{{ $product->product_name }}</h3>

    <div class="info">
      <span>{{ $product->category->category_name }}</span>

      <span>
        Rp {{ number_format($variant->price ?? 0, 0, ',', '.') }}
      </span>
    </div>

</div>

@endforeach

</section>
    </main>

<!-- PRODUCTS DETAILS -->
<div class="overlay-details" id="overlay-details">
  <div class="modal">

    <!-- HEADER -->
    <div class="modal-header">
      <p>Product Details</p>

      <span class="close" id="closeBtn">
        <img src="{{ asset('assets/icon/close.svg') }}">
      </span>
    </div>

    <!-- CONTENT -->
    <div class="modal-content">

      <div class="product-detail">

        <!-- LEFT IMAGE -->
        <div class="product-image">
          <img id="modalImage" src="">
        </div>

        <!-- RIGHT INFO -->
        <div class="product-info">

          <h3 id="modalName"></h3>

          <div class="info">
            <span id="modalCategory"></span>
            <span id="modalPrice"></span>
          </div>

          <!-- SIZE -->
          <div class="product-section">
            <p><b>Available Sizes:</b></p>

            <div class="size-details" id="modalSizes"></div>
          </div>

          <!-- COLOR -->
          <div class="product-section">
            <p><b>Available Colors:</b></p>

            <div class="color-details" id="modalColors"></div>
          </div>

          <!-- SMART SIZING -->
          <div class="product-section">

            <p><b>Smart Sizing:</b></p>

            <div class="smart-sizing">

              <p>Silahkan cek ukuran yang pas untuk anda</p>

              <div class="smart-sizing-input">

                <!-- TINGGI -->
                <div class="smart-sizing-box">

                  <label>Tinggi Badan</label>

                  <div class="input-box">
                    <input type="number" placeholder="0">
                    <span>cm</span>
                  </div>

                </div>

                <!-- BERAT -->
                <div class="smart-sizing-box">

                  <label>Berat Badan</label>

                  <div class="input-box">
                    <input type="number" placeholder="0">
                    <span>kg</span>
                  </div>

                </div>

                <!-- RESULT -->
                <div class="result-size">

                  <span>=</span>

                  <div class="result-box">
                    -
                  </div>

                </div>

              </div>

            </div>

          </div>

          <!-- SIZE CHART -->
          <div class="product-section">

            <p><b>Size Chart:</b></p>

            <div class="size-chart-table">

              <div class="chart-title">
                Jenis size: Tinggi dan besar, Reguler
                <br>
                Ukuran tubuh
              </div>

              <table>

                <thead>
                  <tr>
                    <th>Size</th>
                    <th>Tinggi (cm)</th>
                    <th>Lebar bahu (cm)</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>M</td>
                    <td>68</td>
                    <td>44</td>
                  </tr>

                  <tr>
                    <td>L</td>
                    <td>72</td>
                    <td>46</td>
                  </tr>

                  <tr>
                    <td>XL</td>
                    <td>74</td>
                    <td>48</td>
                  </tr>
                </tbody>

              </table>

            </div>

          </div>

          <!-- DESCRIPTION -->
          <div class="product-section">

            <p><b>Description</b></p>

            <p id="modalDescription"></p>

          </div>

        </div>

      </div>

    </div>

   <!-- BUY BUTTON -->
    <div class="modal-buy">

        <a class="cart-btn">
            <img src="{{ asset('assets/icon/cart.svg') }}">
        </a>

        <a href="/checkout" class="checkout-btn" id="checkoutBtn">
          Check Out
        </a>
    </div>

  </div>
</div>

    <!-- FOOTER -->
@include('components.footer')

@endsection

@push('scripts')
<script src="{{asset ('js/page/katalog.js') }}"></script>
@endpush