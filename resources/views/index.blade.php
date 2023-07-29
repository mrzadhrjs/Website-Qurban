@extends('layout.main')
@section('content')
  <div id="loader">
    <div class="position-center-center">
      <div class="ldr"></div>
    </div>
  </div>
    <main>
      <section class="home-slider simple-head" data-stellar-background-ratio="0.5">

        <!-- Container Fluid -->
        <div class="container-fluid">
          <div class="position-center-center">

            <!-- Header Text -->
            <div class="col-lg text-center" style="margin-bottom: 20rem;">
              <h4 class="text-white">KUATKAN TEKAD IBADAH MULIA BERSAMA SAPTANUSAFARM</h4>
              <h1 class="extra-huge-text text-white">POKOKNYA KUDU QURBAN !</h1>
            </div>
          </div>
        </div>
      </section>

      <!-- Content -->
      <div id="content">

        <!-- Popular Products -->
        <section class="padding-top-150 padding-bottom-100">
          <div class="container">

            <!-- Main Heading -->
            <div class="heading text-center">
              <h4>HEWAN QURBAN TAHUN 2022 M / 1443 H</h4>
            </div>

            <!-- Popular Item Slide -->
            <div class="papular-block block-slide">
@foreach ($hewan as $item)
<div class="item">
  <div class="item-img"> 
    <img class="img-1" src="/storage/{{ $item->coverimg }}" alt=""> 

    <div class="overlay">
      <div class="position-center-center"> <a href="/{{ $item->nama }}" class="btn btn-small btn-round">LIHAT INFO</a> </div>
    </div>
  </div>
  <!-- Item Name -->
  <div class="item-name"> <a href="#.">{{ $item->nama }}</a> </div>
  <!-- Price -->
</div>
@endforeach
            </div>
          </div>
        </section>

        <!-- Content -->
        <div id="content">

          <!-- Popular Products -->
          <section class="padding-top-50 padding-bottom-150">
            <div class="container">
              <div class="row">

                <div class="col-lg-3 col-md-3 text-center">
                  <img src="/images/money.png" width="40" style="filter: brightness(70%)">
                  <p class="h4">Free Biaya Perawatan Hingga Hari-H</p>
                </div>

                <div class="col-lg-3 col-md-3 text-center">
                  <img src="/images/truckfree.png" width="50">
                  <p class="h4">Siap Antar Wilayah JABODETABEK, Gratis!</p>
                </div>

                <div class="col-lg-3 col-md-3 text-center">
                  <img src="/images/waranty.png" width="50" style="filter: brightness(40%)">
                  <p class="h4">Bergaransi</p>
                </div>

                <div class="col-lg-3 col-md-3 text-center">
                  <img src="/images/thumb.png" width="50" style="filter: brightness(20%)">
                  <p class="h4">Kualitas Pakan & Kesehatan Terjaga</p>
                </div>

              </div>
            </div>
          </section>

        </div>
    </main>

@endsection