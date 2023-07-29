<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="M_Adnan">
  <title>SaptaNusaFarm - Pokoknya Kudu Qurban</title>
  <link rel = "icon" href = "" type = "image/x-icon">
  <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
  <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/ionicons.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link href="css/select.css" rel="stylesheet">


  <!-- JavaScripts -->
  <script src="js/modernizr.js"></script>

  <!-- Online Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>
 
</head>

<body>
<header>
    <div class="sticky">
        <div class="container full-header">

            <!-- Logo -->
            <div class="logo"> 
                <a href="/"><img class="img-responsive" src="/images/logo.png" alt=""></a>
            </div>
            <nav class="navbar ownmenu">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"><i class="fa fa-navicon"></i></span> </button>
                </div>

                <!-- NAV -->
                <div class="collapse navbar-collapse" id="nav-open-btn">
                    <ul class="nav">
                        <li> <a href="/"> Beranda</a> </li>
                        <li> <a href="/aboutus">Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- Nav Right -->
                <div class="nav-right">
                    <ul class="navbar-right">

                        <!-- USER INFO -->
                        @auth
                        <li class="dropdown user-acc"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="icon-user"></i> </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <h6>{{ auth()->user()->name }}</h6>
                                </li>
                                @if (auth()->user()->username !== 'admin')
                                    <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter3">History Pembelian</a></li>
                                @else
                                <li>
                                    <a href="/dashboard">Dashboard</a>
                                </li>
                                @endif
                                <li><a href="#" id="submitButton">Logout</a></li>
                                <form id="logoutForm" action="/logout" method="post">
                                    @csrf    
                                </form>
                            </ul>
                        </li>
                        @endauth
                        @guest
                        <li class="dropdown user-acc"> <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#exampleModalCenter"><i class="icon-user"></i></a>
                        @endguest
                        <!-- USER BASKET -->
                        
                      
                        @auth
                        @if (!auth()->user()->username == 'admin')
                        <li class="dropdown user-basket"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="icon-basket-loaded"></i> </a>
                            <ul class="dropdown-menu overflow-auto">
                                @php
                                    $totalHarga = 0;
                                @endphp
                                @foreach ($keranjang->where('user_id', auth()->user()->id) as $item)
                                <li>
                                    <div class="media-left">
                                        <div class="cart-img"> <a href="/{{ $item->hewan }}" class="margin-0"> <img class="media-object img-responsive" src="/storage/{{ $item->img }}" alt="..."> </a> </div>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-heading">{{ $item->hewan }}×{{ $item->qty }}</h6>
                                        @foreach ($bobot->where('bobot', $item->bobot) as $items)
                                            <span class="price">Rp {{ number_format( $items->harga ) }}</span> <span class="qty">Bobot : {{ $item->bobot }} ({{ $item->grade }})</span>
                                            <form action="/keranjang/{{ $item->id }})" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn-danger padding-left-5 padding-right-5">Delete</button>
                                            </form>
                                            @php
                                                $harga = $items->harga;
                                                $harga *= $item->qty;
                                                $totalHarga += $harga;
                                            @endphp
                                        @endforeach
                                    </div>
                                </li>
                                @endforeach
                                <li>
                                    <h5 class="text-center">SUBTOTAL : Rp {{ number_format($totalHarga) }}</h5>
                                </li>
                                <li class="margin-0">
                                    <div class="row">
                                        <div class="col-xs-10  margin-left-20"><a href="/bayar" class="btn">CHECKOUT</a></div>
                                    </div>
                                </li>
                            </ul>

                        </li>
                        @endif
                        @endauth


                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>


@auth
<div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">History Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="h1 font-size-10">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pesanan</th>
                            <th scope="col">Nominal Transaksi</th>
                            <th scope="col">Bukti Pembayaran</th>
                            <th scope="col">Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->where('user_id', auth()->user()->id) as $trs)
                        <tr>
                            <th scope="row"><a href="#" class="clickable-row">Detail</a></th>
                            <td>Rp{{ number_format($trs->total) }}</td>
                            <td><a href="/storage/{{ $trs->foto }}" target="_blank">Cek Bukti Pembayaran</a></td>
                            <td>
                                @if ($trs->verification == false)
                                <span class="text-danger font-weight-bold">Unverified</span>
                                @else
                                <span class="text-success font-weight-bold">Verified</span>
                                @endif
                            </td>
                        </tr>
                        <tr class="hidden-row" style="display: none">
                            <td colspan="4">
                                <div class="details">
                                    <!-- Details content goes here -->
                                    <ul class="margin-top-10">
                                        @php
                                            $totalHarga = 0; // Inisialisasi total harga
                                        @endphp

                                        @foreach ($ht->where('transaction_id', $trs->id) as $hts)
 
                                            @foreach ($history->where('keranjang_id', $hts->history_id) as $krhst)
                                        @foreach ($bobot->where('bobot', $krhst->bobot) as $bbths)
                                        @php
                                            $harga = $bbths->harga;
                                            $harga *= $krhst->qty;
                                            $totalHarga += $harga  
                                        @endphp
                                        <li class="margin-bottom-20">
                                            <div class="media-body">
                                                <h6 class="media-heading">{{ $krhst->hewan }}×{{ $krhst->qty }}</h6>
                                                <span class="price"><small>Rp</small>{{ number_format( $bbths->harga ) }} × {{ $krhst->qty }} = <span class="price"><small>Rp</small>{{ number_format($harga) }}</span>
                                            </span><br><span class="qty">Bobot : {{ $krhst->bobot }} ({{ $krhst->grade }})</span>
                                            </div>
                                            <div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endforeach
                                    @endforeach
                                </ul>
                                <p class="text-right">TOTAL : <span>Rp{{ number_format($totalHarga) }}</span></p>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a id="whatsappButton" href="#" class="btn btn-secondary">Hubungi Admin</a>
            </div>
        </div>
    </div>
</div>
@endauth


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="h1 font-size-10">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/login" method="post">
                    @csrf
                <div class="form-outline margin-bottom-5">
                    <label class="form-label" for="username">Username</label>
                    <input input type="username" name="username" class="form-control rounded-top @error('username') is-invalid @enderror" id="username" placeholder="username" autofocus required value="{{ old('username') }}"/>
                </div>
        
              <!-- Password input -->
                <div class="form-outline margin-bottom-10 margin-top-10">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" name="password" class="form-control rounded-bottom" id="password" placeholder="password" autofocus required/>
                </div>
        
              <!-- 2 column grid layout -->
                <div class="row mb-4">
                    <div class="col-md-6 d-flex justify-content-center">
                    <!-- Checkbox -->
                        <div class="form-check mb-3 mb-md-0">
                            <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <p>Not a member? <a href="#!" data-toggle="modal" data-target="#exampleModalCenter2" data-dismiss="modal" aria-label="Close">Register</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">Login</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="h1 font-size-10">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="/register" method="post">
                    @csrf
                <div class="form-outline c1 margin-bottom-5">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required/>
                </div>

                <div class="form-outline c2 margin-bottom-5">
                    <label class="form-label" for="username">Username</label>
                    <input input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="username" required/>
                </div>

                <div class="form-outline c3 margin-bottom-5">
                    <label class="form-label" for="name">Nama</label>
                    <input input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" required/>
                </div>

                <div class="form-outline c4 margin-bottom-5">
                    <label class="form-label" for="phone">No Telephone</label>
                    <input input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="phone" required/>
                </div>

                <div class="form-outline margin-bottom-5">
                    <label class="form-label" for="alamat">Alamat</label>
                    <input input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="alamat" required/>
                </div>
        
              <!-- Password input -->
                <div class="form-outline margin-bottom-10 margin-top-10">
                    <label class="form-label" for="loginPassword">Password</label>
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="password" required/>
                </div>
                
              <!-- 2 column grid layout -->
                
                <div class="text-center">
                    <p>Already have account? <a href="#!" data-toggle="modal" data-target="#exampleModalCenter" data-dismiss="modal" aria-label="Close">Login</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">Register</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div id="wrap">
@yield('content')
<footer>
    <div class="container">

        <!-- ABOUT Location -->
        <div class="col-md-3">
            <div class="about-footer"> <img class="margin-bottom-30" src="http://localhost/qurban/images/logo-foot.png" alt="">
                <p><i class="icon-pointer"></i> Jl. Cileungsi,Klapanunggal,Kab.Bogor</p>
                <p><i class="icon-call-end"></i> +6287873031310</p>
                <p><i class="icon-envelope"></i> Fiqrinuraul@gmail.com</p>
            </div>
        </div>

        <!-- HELPFUL LINKS -->
        <div class="col-md-3">
            <h6>Link</h6>
            <ul class="link">
                <li><a href="#."> Beranda</a></li>
                <li><a href="#."> Katalog Hewan</a></li>
                <li><a href="#."> Informasi Kontak</a></li>
                <li><a href="#."> Login</a></li>
            </ul>
        </div>

        <!-- MY ACCOUNT -->
        <div class="col-md-3">
            <h6>MY ACCOUNT</h6>
            <ul class="link">
                <li><a href="#."> Login</a></li>
                <li><a href="#."> My Account</a></li>
                <li><a href="#."> My Cart</a></li>
                <li><a href="#."> Wishlist</a></li>
                <li><a href="#."> Checkout</a></li>
            </ul>
        </div>

        <!-- Rights -->
        <div class="rights">
            <p>© <?php echo date('Y'); ?> <a href="https://mdody.com/" class="text-white">SaptaNusaFarm</a> All Right Reserved. </p>
        </div>
    </div>
</footer>
</div>


<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/select.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/own-menu.js"></script>
<script src="js/jquery.lighter.js"></script>
<script src="js/owl.carousel.min.js"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="rs-plugin/js/jquery.tp.t.min.js"></script>
<script type="text/javascript" src="rs-plugin/js/jquery.tp.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>