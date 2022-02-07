@extends('main')
@section('content')
<h2>Redaguoti imones duomenis</h2>
@include('_partials/errors')
<form action="/update/{{$company->id}}" method="post" enctype="multipart/form-data">
  @csrf
    <div class="mb-3">
      <input type="text" name="company" class="form-control" placeholder="Imones pavadinimas" value="{{$company->company}}">
    </div>
    <div class="mb-3">
      <input type="text" name="code" class="form-control" placeholder="Kodas" value="{{$company->code}}">
    </div>
    <div class="mb-3">
      <input type="text" name="vat" class="form-control" placeholder="PVM kodas" value="{{$company->vat}}">
    </div>
    <div class="mb-3">
      <input type="text" name="address" class="form-control" placeholder="Adresas" value="{{$company->address}}">
    </div>
    <div class="mb-3">
      <input type="text" name="director" class="form-control" placeholder="Vadovas" value="{{$company->director}}">
    </div>
    <div class="mb-3">
      <textarea name="description" id="" cols="30" rows="10" placeholder="Imones aprasymas" class="form-control">{{$company->description}}</textarea>
    </div>
    <div class="mb-3">
      <label>Logotipas</label>
      <input type="file" name="logo" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Atnaujinti</button>
  </form>
@endsection