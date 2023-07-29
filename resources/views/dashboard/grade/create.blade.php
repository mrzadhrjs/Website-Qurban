@extends('dashboard.layout.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Grade<h1>
</div>
<div class="col-lg-8">
    <form class="mb-5" method="post" action="/dashboard/grade" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="grade" class="form-label">Grade</label>
          <input type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" autofocus value="{{old('grade')}}">
          @error('grade')
              {{ $message }}
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Grade</button>
      </form>
  </div>
@endsection