@extends('dashboard.layout.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Daftar Hewan Qurban</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
{{session('success')}}
</div>
@endif

<div class="table-responsive col-lg-8">
    <a href="/dashboard/grade/create" class="btn btn-primary mb-3">Add new Grade</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Grade</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($grade as $g)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $g->grade }}</td>
            <td><a href="/dashboard/grade/{{ $g->id }}/edit" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
              <form action="/dashboard/grade/{{ $g->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
                  <span data-feather="x" class="align-text-bottom"></span>
              </button>
          </form>
          </td>
      
        </tr>
        @endforeach
      </tbody>
    </table>

@endsection