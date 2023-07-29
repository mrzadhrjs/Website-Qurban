@extends('layout.main')
@section('content')

    <!--======= SUB BANNER =========-->
    <section class="sub-bnr" data-stellar-background-ratio="0.5">
      <div class="position-center-center">
        <div class="container">
          <h4>Konfirmasi Pembayaran</h4>
        </div>
      </div>
    </section>

    <!-- Content -->
    <div id="content">

      <!--======= PAGES INNER =========-->
      <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
        <div class="container">

          <!-- Payments Steps -->
          <div class="shopping-cart text-center">
            <div class="cart-head">
              <ul class="row">
                <!-- PRODUCTS -->
                <li class="col-sm-2 text-left">
                  <h6>Hewan</h6>
                </li>
                <!-- NAME -->
                <li class="col-sm-4 text-left">
                  <h6></h6>
                </li>
                <!-- PRICE -->
                <li class="col-sm-2">
                  <h6>harga</h6>
                </li>
                <!-- QTY -->
                <li class="col-sm-1">
                  <h6>Jumlah</h6>
                </li>

                <!-- TOTAL PRICE -->
                <li class="col-sm-2">
                  <h6>Total</h6>
                </li>
                <li class="col-sm-1"> </li>
              </ul>
            </div>
            @php
              $totalHarga = 0; // Inisialisasi total harga
            @endphp
              @foreach ($keranjang->where('user_id', auth()->user()->id) as $item)
                @foreach ($bobot->where('bobot', $item->bobot) as $items)
            <ul class="row cart-details">
              
                <li class="col-sm-6">
                <div class="media">
                  <!-- Media Image -->
                  <div class="media-left media-middle"> <a href="/{{ $item->hewan }}" class="item-img"> <img class="media-object" style="object-fit: none; 
                    object-position: 20px -75px;
                    width: 170px;
                    max-height: 170px;
                    margin-bottom: 1rem;" src="/storage/{{ $item->img }}" alt=""> </a> </div>

                  <!-- Item Name -->
                  <div class="media-body">
                    <div class="position-center-center">
                      <h5>{{ $item->hewan }}</h5>
                      <p>Grade {{ $item->grade }} ({{ $item->bobot }})</p>
                    </div>
                  </div>
                </div>
              </li>

              <!-- PRICE -->
              <li class="col-sm-2">
                <div class="position-center-center"> <span class="price"><small>Rp</small>{{ number_format($items->harga) }}</span> </div>
              </li>

              <!-- QTY -->
              <li class="col-sm-1">
                <div class="position-center-center">
                  <div class="quinty">
                    <!-- QTY -->
                    <input type="number" value="{{ $item->qty }}" disabled>
                  </div>
                </div>
              </li>
              @php
                  $harga = $items->harga;
                  $harga *= $item->qty;
                  $totalHarga = $harga + $ongkir;  
              @endphp
              <!-- TOTAL PRICE -->
              
              <li class="col-sm-2">
                <div class="position-center-center"> <span class="price"><small>Rp</small>{{ number_format($harga) }}</span> </div>
              </li>
              
            </ul>
            @endforeach
                @endforeach

          </div>
          <div>Alamat tujuan : {{ auth()->user()->alamat }} ({{ $status }})
        </div>
            

        </div>
      </section>

      <!--======= PAGES INNER =========-->
      <section class="padding-top-100 padding-bottom-100 light-gray-bg shopping-cart small-cart">
        <div class="container">

          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info margin-top-0">
            <div class="row">
              <form action="/bayar" method="post" enctype="multipart/form-data">
                @csrf
                <input style="display: none" type="text" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                <input style="display: none" type="text" id="total" name="total" value="{{ $totalHarga }}">
              <!-- SUB TOTAL -->
              <div class="col-lg col-md">
                <h6>Total Harga</h6>
                <p>Pembayaran Melalui Transfer Rekening</p>
                <h5>BCA - 5753291000</h5><span>Atas Nama Aulia Nur Fiqri</span>
                <h5>BSI - 7115401978</h5><span>Atas Nama Aulia Nur Fiqri</span>
                <div class="grand-total margin-top-30">
                  <div class="order-detail">
                    <!-- SUB TOTAL -->
                    <p class="all-total">TOTAL YANG HARUS DIBAYAR <span>Rp{{ number_format($totalHarga) }}</span></p>
                  </div>
                </div>
              </div>
              <div id="upload-bp" class="margin-top-30" style="display: none">
                Silahkan Upload Bukti Transfer <br>
                  <input type="file" style="font-color-white" name="foto" class="btn margin-right-1">
              </div>
              <button id="upload-bp-button" type="submit" class="btn margin-top-30" style="display: none;">Proses</button>
            </div>  
            </form>
            @if ( $distance > 80)
              <button id="bt-pembayaran" type="button" class="btn margin-top-30" disabled>Lakukan Pembayaran</button>
            @else
              <button id="bt-pembayaran" type="button" class="btn margin-top-30">Lakukan Pembayaran</button>
            @endif
          </div>
        </div>
      </section>

    </div>

    <!--======= FOOTER =========-->
@endsection