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
    <a href="/dashboard/hewan/create" class="btn btn-primary mb-3">Add new Hewan</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Hewan</th>
          <th scope="col">Grade</th>
          <th scope="col">Qty</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($hewan as $k)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $k->nama }}</td>
            <td>
                @foreach ($k->relationToGrade as $g)
                    
                  <a href="#" data-toggle="modal" data-target="#exampleModalCenter{{ $k->id }}{{ $g->id }}" style="text-decoration: none; color: #000000;">{{ $g->grade }}</a>

                @endforeach
                <form action="/dashboard/hewan/grade" method="POST">
                  @csrf
                  <input type="hidden" name="hewan_id" value="{{ $k->id }}">
                <select name="grade_id" id="select-grade">
                  @foreach ($grade as $j)
                  @if (!$hewangrade->where('hewan_id', $k->id)->contains('grade_id', $j->id))
                      <option value="{{ $j->id }}">{{ $j->grade }}</option>
                  @endif
                  @endforeach              
                </select>
                {{-- <button type="submit" class="btn btn-primary mb-3 mt-2">Add</button> --}}
                <button id="select-grade-button" type="submit" class="badge bg-primary border-0" style="margin-left: 10px"><span class="align-text-bottom">Add</span></button>
              </form>
              <form action="/dashboard/hewan/grade/{{ $k->id }}" method="POST" class="mt-1">
                @method('delete')
                @csrf
                <input type="hidden" name="hewan_id" value="{{ $k->id }}">
                <select name="grade_id" id="select-grade">
                    @foreach ($k->relationToGrade as $gs)
                        <option value="{{ $gs->id }}">{{ $gs->grade }}</option>
                    @endforeach
                </select>
                <button type="submit" class="badge bg-danger border-0" style="margin-left: 10px">
                    <span class="align-text-bottom">Delete</span>
                </button>
              </form>
            
            </td>
            <td>{{ $k->qty }}</td>
            <td>                <a href="/dashboard/hewan/{{ $k->id }}/edit" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
              <form action="{{ route('hewan.destroy', $k->id) }}" method="post" class="d-inline">
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
  </div>
  @foreach ($hewan as $k)
  @foreach ($k->relationToGrade as $g)
  <div class="modal fade" id="exampleModalCenter{{ $k->id }}{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Bobot {{ $k->nama }} Grade {{ $g->grade }}</h5>
                <a type="button" class="close" style="text-decoration: none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="h1 font-size-10">&times;</span>
                </a>
            </div>
            <div class="modal-body">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bobot</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($grade->where('grade', $g->grade) as $grade1)
                  @foreach ($k->relationToBobot as $hewanbobots)
                    @foreach ($bobot->where('bobot', $hewanbobots->bobot) as $bobot1)
                      @foreach ($gb->where('grade_id', $grade1->id)->where('bobot_id', $bobot1->id) as $gradezz)
                      <tr>                        
                              <td>{{ $bobot1->iteration }}</td>
                              <td>{{ $bobot1->bobot }}</td>
                              <td><small>Rp</small>{{ number_format($bobot1->harga) }}</td>
                              <td>
                                <form action="/dashboard/hewan/bobot/{{ $bobot1->id }}" method="POST">
                                  @csrf
                                  @method('delete')
                                  <input type="hidden" name="id" value="{{ $bobot1->id }}">
                                  <button class="badge bg-danger border-0" onclick="return confirm('Are you srue?')"><span data-feather="x" class="align-text-bottom"></span></button>
                              </form>
                                </td>
                            </tr>

                  @endforeach
                @endforeach
              @endforeach
            @endforeach    
        </tbody>
      </table>        
          <a href="#" class="btn btn-primary mb-3 bt-bobot">Add new Bobot</a>
          <div  class="margin-top-30 add-bobot" style="display: none">
            <hr>
            <form action="/dashboard/hewan/bobot" method="post">
              @csrf
              <input type="hidden" name="hewan_id" value="{{ $k->id }}">
              <input type="hidden" name="grade_id" value="{{ $g->id }}">
              <input type="text" style="font-color-white" name="bobot" placeholder="Bobot" class="btn margin-right-1">
              <input type="text" style="font-color-white" name="harga" placeholder="Harga" class="btn margin-right-1">
              <button  type="submit" class="btn btn-primary mb-3 mt-2 add-bobot-button">Proses</button>
            </form>
          </div>
        </div>  
          </div>
        </div>
    </div>
  </div>
  @endforeach
  @endforeach

  <form action="/dashboard/hewan/grade" method="POST">
    @csrf


  @foreach ($hewan as $i)
  <div class="modal fade" id="exampleModalCentergrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Grade ke {{ $i->nama }}</h5>
                <a type="button" class="close" style="text-decoration: none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="h1 font-size-10">&times;</span>
                </a>
            </div>
            <div class="modal-body">
              <select name="grade_id" id="">
                @foreach ($grade as $j)
                @if (!$hewangrade->where('hewan_id', $i->id)->contains('grade_id', $j->id))
                    <option value="{{ $j->id }}">{{ $j->grade }}</option>
                @endif
                @endforeach              
              </select><br>
              <button type="submit" class="btn btn-primary mb-3 mt-2 float-end">Add</button>
            </div>  
          </div>
        </div>
    </div>
    @endforeach
  </div>

@endsection