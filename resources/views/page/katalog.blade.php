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
              <select name="kategori">
                  <option value="" disabled selected>Kategori</option>
                  <option value="celana">Celana</option>
                  <option value="tshirt">T-shirt</option>
                  <option value="longsleeve">Longsleeve</option>
              </select>
              <img src="{{ asset('assets/icon/kategori-filter.svg') }}" alt="filter icon">
          </div>

          <div class="dropdown">
              <select name="sorting">
                  <option value="" disabled selected>Sorting</option>
                  <option value="hargaTertinggi">Harga Tertinggi</option>
                  <option value="hargaTerendah">Harga Terendah</option>
              </select>
              <img src="{{ asset('assets/icon/icon-sorting.svg') }}" alt="filter icon">
          </div>

          <div class="dropdown">
              <select name="size">
                  <option value="" disabled selected>Size</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
              </select>
              <img src="{{ asset('assets/icon/ruler-filter.svg') }}" alt="filter icon">
          </div>

          <div class="dropdown">
              <select name="colors">
                  <option value="" disabled selected>Colors</option>
                  <option value="hitam">Hitam</option>
                  <option value="coklat">Coklat</option>
                  <option value="pink">Pink</option>
              </select>
              <img src="{{ asset('assets/icon/color-filter.svg') }}" alt="filter icon">
          </div>
      </section>

        <!-- SIZE -->
        <div class="size">
          <p>Size</p>
          <div class="size-list">
            <span>S</span>
            <span>M</span>
            <span>L</span>
            <span>XL</span>
          </div>
        </div>
      </section>

      <!-- PRODUCTS CARD -->
      <section class="products">
        <div class="card">
          <img src="../image/Foto/Baju-coklat-belakang.jpg">
          <h3>SAVIOR WORLD TALES OF GOD'S AND HEROES</h3>
          <div class="info">
            <span>T-Shirt</span>
            <span>Rp 200.000</span>
          </div>
        </div>

        <div class="card">
          <img src="../image/Foto/Baju-coklat-depan.jpg">
          <h3>SAVIOR WORLD TALES OF GOD'S AND HEROES</h3>
          <div class="info">
            <span>T-Shirt</span>
            <span>Rp 200.000</span>
          </div>
        </div>

        <div class="card">
          <img src="../image/Foto/Baju-hitam-belakang.jpg">
          <h3>SAVIOR WORLD THE PEGASUS</h3>
          <div class="info">
            <span>LongSleeve</span>
            <span>Rp 225.000</span>
          </div>
        </div>

        <div class="card">
          <img src="../image/Foto/Baju-hitam-depan.jpg">
          <h3>NSAVIOR WORLD THE PEGASUS</h3>
          <div class="info">
            <span class="jenis">LongSleeve</span>
            <span class="harga">Rp 225.000</span>
          </div>
        </div>
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
          <img src="../image/Foto/Baju-coklat-belakang.jpg">
        </div>

        <!-- RIGHT INFO -->
        <div class="product-info">

          <h3>SAVIOR WORLD TALES OF GOD'S AND HEROES</h3>

          <div class="info">
            <span>T-Shirt</span>
            <span>Rp 200.000</span>
          </div>

          <!-- SIZE -->
          <div class="product-section">
            <p><b>Available Sizes:</b></p>

            <div class="size-details">
              <span>S</span>
              <span>M</span>
              <span>L</span>
              <span>XL</span>
            </div>
          </div>

          <!-- COLOR -->
          <div class="product-section">
            <p><b>Available Colors:</b></p>

            <div class="color-details">
              <span>White</span>
              <span>Black</span>
              <span>Brown</span>
            </div>
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

            <p>
              <b>Savior “Tales of Gods and Heroes”</b>
              <br>
              Material: Australian Breeze Cotton 16s
              <br>
              Cutting: Boxy Oversize Fit
              <br>
              Texture: Soft, breathable, and slightly structured
              <br>
              Neck: Ribbed
              <br>
              Print: High-quality screen print
              <br>
              Finishing: Clean stitching
            </p>

          </div>

        </div>

      </div>

    </div>

   <!-- BUY BUTTON -->
    <div class="modal-buy">

        <a class="cart-btn">
            <img src="{{ asset('assets/icon/cart.svg') }}">
        </a>

        <a href="https://shopee.co.id/eldinosaurrawr?entryPoint=ShopBySearch&searchKeyword=savior%20world" class="checkout-btn">
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