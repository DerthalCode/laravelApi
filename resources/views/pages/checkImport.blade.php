@extends('main')
@section('content')
    <div class="container">
            <table class="table table-bordered table-striped text-center">
                <tr>
                    <th>Imones Pavadinimas</th>
                    <th>Kodas</th>
                    <th>PVM Kodas</th>
                    <th>Adresas</th>
                    <th>Direktorius</th>
                    <th>Aprasymas</th>
                    <th>Logo</th>
                </tr>
            @foreach($data as $k => $v)
              <tr>
                  <td>{{$v[0]}}</td>
                  <td>{{$v[1]}}</td>
                  <td>{{$v[2]}}</td>
                  <td>{{$v[3]}}</td>
                  <td>{{$v[4]}}</td>
                  <td>{{$v[5]}}</td>
                  <td><img src="{{$v[6]}}" style="width: 200px; height: 100px" alt="logo"></td>
              </tr>
            @endforeach
            </table>
            <div>
                <form action="{{route('store.import')}}" method="post">
                    @csrf
                    @foreach($data as $k => $v)
                    
                        <input type="hidden" name="data[{{$k}}]" value="{{json_encode($v)}}">
                       
                    @endforeach
                    <input type="submit" value="Issaugoti" class="btn btn-success">
                    </form>
            </div>
    </div>
@endsection