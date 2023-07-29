@extends('dashboard.layout.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $hewan->nama }}<h1>
  </div>

  <div class="col-lg-8">
    <form class="mb-5" method="post" action="/dashboard/hewan/{{ $hewan->id }}" enctype="multipart/form-data">
    @method('put')
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label">Hewan</label>
          <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" autofocus value="{{old('nama', $hewan->nama)}}">
          @error('nama')
              {{ $message }}
          @enderror
        </div>
        <div class="mb-3">
            <label for="qty" class="form-label">Quantity</label>
            <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{old('qty', $hewan->qty)}}">
            @error('qty')
              {{ $message }}
          @enderror
          </div>
          <div class="mb-3">
            <label for="coverimg" class="form-label">Cover Image</label>
            <input class="form-control @error('coverimg') is-invalid @enderror" type="file" id="coverimg" name="coverimg">
            <input type="hidden" name="oldcoverimg" value="{{ $hewan->coverimg }}">
            @error('coverimg')
              {{ $message }}
          @enderror
          </div>
        <button type="submit" class="btn btn-primary">Update Hewan</button>
      </form>
  </div>
@endsection