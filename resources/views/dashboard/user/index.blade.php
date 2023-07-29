@extends('dashboard.layout.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Daftar User</h1>
</div>
<div class="table-responsive col-lg-8">
<table class="table table-striped table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Username</th>
      <th scope="col">Alamat</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($user as $u)
    <tr>
      @if (auth()->user()->username === $u->username)
          
      @else
      <td>{{ $u->id }}</td>
      <td><a href="#" data-toggle="modal" data-target="#exampleModalCenter" style="text-decoration: none; color: #000000;">{{ $u->name }}</a></td>
      <td>{{ $u->username }}</td>
      <td>{{ $u->alamat }}</td>
      <td>{{ $u->email}}</td>
      <td>
        <form action="/dashboard/user/{{ $u->username }}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="badge bg-danger border-0" style="padding: 5px" onclick="return confirm('Are you srue?')"><span class="align-text-bottom" style="padding: 5px;">Hapus</span></button>
        </form>
      </td>
      @endif
      </tr>
    @endforeach
  </tbody>
</table>
</div>
{{-- <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter">History Pembelian</a></li> --}}
@foreach ($user as $u)
@if (auth()->user()->username === $u->username)
          
@else
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Pembayaran</h5>
              <a type="button" class="close" style="text-decoration: none" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="h1 font-size-10">&times;</span>
              </a>
          </div>
          <div class="modal-body">
            <table class="table table-striped table-sm">
              <thead>
              <tr>
                <th scope="col" style="padding-right:10px;">Pesanan</th>
                <th scope="col" style="padding-right:10px;">Nominal Transaksi</th>
                <th scope="col" style="padding-right:10px;">Bukti Pembayaran</th>
                <th scope="col">Status Verifikasi</th>
              </tr>
          </thead>
          <tbody class="table-spacing">
              @foreach ($transaksi->where('user_id', $u->id) as $trs)
              <tr>
                  <th scope="row"><a href="#" class="clickable-row">Detail</a></th>
                  <td>Rp{{ number_format($trs->total) }}</td>
                  <td><a href="/storage/{{ $trs->foto }}" target="_blank">Cek</a></td>
                  <td>
                      @if ($trs->verification == false)
                      <form id="verForm" action="/dashboard/user/{{ $trs->id }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="verification" value="1"> <!-- Added input field -->
                        <a href="" id="verSubmit" type="button" style="text-decoration: none" onclick="return confirm('Are you srue?')"><span class="text-danger font-weight-bold" style="margin-right: 5px">Unverified</span></a>
                      </form>

                        @else
                        <form id="verForm" action="/dashboard/user/{{ $trs->id }}" method="post">
                          @csrf
                          @method('put')
                          <input type="hidden" name="verification" value="0"> <!-- Added input field -->
                          <a href="" id="verSubmit" type="button" style="text-decoration: none" onclick="return confirm('Are you srue?')"><span class="text-success font-weight-bold" style="margin-right: 5px">Verified</span></a>
                        </form>

                       @endif
                  </td>
              </tr>
              <tr class="hidden-row" style="display: none">
                  <td colspan="4">
                      <div class="details">
                          <!-- Details content goes here -->
                          <ul style="list-style: none;padding-left: 0px;margin-top: 15px;">
                              @php
                                  $totalHarga = 0; // Inisialisasi total harga
                              @endphp
                          @foreach ($ht->where('transaction_id', $trs->id) as $hts)
                              @foreach ($history->where('keranjang_id', $hts->id) as $krhst)
                              @foreach ($bobot->where('bobot', $krhst->bobot) as $bbths)
                              @php
                                  $harga = $bbths->harga;
                                  $harga *= $krhst->qty;
                                  $totalHarga += $harga  
                              @endphp
                              <li style="margin-top: 10px">
                                  <div class="media-body">
                                    <hr>

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
      </div>
  </div>
</div>
@endif
@endforeach
@endsection