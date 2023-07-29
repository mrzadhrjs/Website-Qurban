@extends('layout.main')
@section('content')

    <!--======= SUB BANNER =========-->
    <section class="sub-bnr" data-stellar-background-ratio="0.5">
      <div class="position-center-center">
        <div class="container">
          <h4 class="coba">{{ $nama }}</h4>
        </div>
      </div>
    </section>

    <!-- Content -->
    <div id="content">

      <!-- Popular Products -->
      <section class="padding-top-100 padding-bottom-100">
        <div class="container">

          <!-- SHOP DETAIL -->
          <div class="shop-detail">
            <div class="row">

              <div class="col-md-7">

                <div id="slider-shop" class="flexslider">
                  <ul class="slides">
                    <li> <img class="img-responsive" src="/storage/{{ $img }}" alt=""> </li>
                    <li> <img class="img-responsive" src="/storage/{{ $img }}" alt=""> </li>
                    <li> <img class="img-responsive" src="/storage/{{ $img }}" alt=""> </li>
                  </ul>
                </div>
                <div id="shop-thumb" class="flexslider">
                  <ul class="slides">
                    <li> <img class="img-responsive" src="/storage/{{ $img }}" alt=""> </li>
                    <li> <img class="img-responsive" src="/storage/{{ $img }}" alt=""> </li>
                    <li> <img class="img-responsive" src="/storage/{{ $img }}" alt=""> </li>
                  </ul>
                </div>
              </div>

              <!-- COntent -->
              <div class="col-md-5">
                <h4>{{ $nama }}</h4>
                @foreach ($hewangrade as $hewangrades)
                              @foreach ($grade->where('grade', $hewangrades->grade) as $grade1)
                              @foreach ($hewanbobot as $hewanbobots)
                                @foreach ($bobot->where('bobot', $hewanbobots->bobot) as $bobot1)
                                  @foreach ($gb->where('grade_id', $grade1->id)->where('bobot_id', $bobot1->id) as $gradezz)
                                  @php
                                              $coba = $grade1->grade;
                                              $coba .= $bobot1->bobot;
                                              if ($coba == trim($coba) && strpos($coba, ' ') !== false) {
                                                $coba = preg_replace('/\s+/', '_', $coba);
                                              } 
                                          @endphp
                                  <span class="price" id="bobot-harga-{{ $coba }}" class="bobot-harga" style="display: none"><small>Rp</small>{{ number_format($bobot1->harga) }}</span>
                                  @endforeach
                                @endforeach
                              @endforeach
                              @endforeach
                              @endforeach

                <!-- Sale Tags -->
                {{-- <div class="on-sale"> 10% <span>OFF</span> </div> --}}
                <ul class="item-owner">
                  <li>Jumlah Tersedia : {{ $qty }}</li>
                </ul>

                <!-- Item Detail -->
                <p>{{ $nama }} Unggul Dengan Kualitas <h3>NOMOR 1</h3> Telah Mengantongi Surat Sehat Dinkes Kab.Bogor Serta Sudah Memenuhi Kriteria Qurban Sesuai Syariat</p>

                <!-- Short By -->
                <form action="/keranjang" method="post">
                  @csrf
                  @auth
                      
                  <input style="display: none" type="text" id="img" name="img" value="{{ $img }}">
                  <input style="display: none" type="text" id="hewan" name="hewan" value="{{ $nama }}">
                  <input style="display: none" type="text" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                  @endauth
                <div class="some-info">
                  <ul class="row margin-top-30">
                    <li class="col-xs-4">
                      <label>Pilih Jumlah</label>
                      <div class="quinty">
                        <!-- QTY -->
                        <select class="selectpicker" name="qty" id="qty">
                        @for ($i = 1; $i <= $qty; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor 
                      </select>                    
                      </div>
                    </li>
                    <li class="col-xs-4">
                      <label>Pilih Grade</label>
                      <div class="quinty">
                        <select class="selectpicker" name="grade" id="grade">
                          @foreach ($hewangrade as $hewangrades)
                            @foreach ($grade->where('grade', $hewangrades->grade) as $grade1)
                              <option value="{{ $grade1->grade }}">{{ $grade1->grade }}</option>
                            @endforeach
                          @endforeach
                        </select>
                      </div>
                    </li>

                
                    <li class="col-xs-4" id="{{ $grade1->grade }}">
                      <label>Pilih Bobot</label>
                      <div class="quinty">
                        <select class="selectpicker" name="bobot" id="bobot">
                          @foreach ($hewangrade as $hewangrades)
                            @foreach ($grade->where('grade', $hewangrades->grade) as $grade1)
                              @foreach ($hewanbobot as $hewanbobots)
                                @foreach ($bobot->where('bobot', $hewanbobots->bobot) as $bobot1)
                                  @foreach ($gb->where('grade_id', $grade1->id)->where('bobot_id', $bobot1->id) as $gradezz)
                                          @php
                                              $coba = $grade1->grade;
                                              $coba .= $bobot1->bobot;
                                              if ($coba == trim($coba) && strpos($coba, ' ') !== false) {
                                                $coba = preg_replace('/\s+/', '_', $coba);
                                              } 
                                          @endphp
                                    <option value="{{ $coba }}">{{ $bobot1->bobot }}</option>
                                  @endforeach
                                @endforeach
                              @endforeach
                            @endforeach
                          @endforeach
                          </select>
                      </div>
                    </li>
                  




                  </ul>
                  @auth
                  @if (!auth()->user()->username == 'admin')
                  <button class="btn" type="submit">Beli Hewan Qurban</button>                      
                  @endif
                  @endauth
                </form>
                @guest
                  <button class="btn" type="button" data-toggle="modal" data-target="#exampleModalCenter">Beli Hewan Qurban</button>
                @endguest
                  <div class="inner-info">
                    @if ($nama == 'Kambing')
                      <h6>Jenis {{ $nama }} :</h6>
                      <p>Kambing Jawa</p>
                    @elseif ($nama == 'Domba')
                      <h6>Jenis {{ $nama }} :</h6>
                      <p>Domba Garut</p>
                    @else
                      <h6>Jenis {{ $nama }} :</h6>
                      <p>Grade A - Sapi Bali, Madura, Jawa <br>Grade B - Sapi Bali, Madura, Jawa <br> Grade C - Sapi Jawa, Pegon, Brangus, Brahma <br> Grade D - Sapi Pegon, Simetal, Limousin <br>Grade E - Sapi Simetal, Limousin</p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>

    <!--======= FOOTER =========-->
@endsection