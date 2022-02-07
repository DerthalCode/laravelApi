@extends('main')
@section('content')
<h2>Prideti nauja imone</h2>
@include('_partials/errors')
<form action="/store" method="post" enctype="multipart/form-data">
  @csrf
    <div class="mb-3">
      <input type="text" name="company" class="form-control" placeholder="Imones pavadinimas">
    </div>
    <div class="mb-3">
      <input type="text" name="code" class="form-control" placeholder="Kodas">
    </div>
    <div class="mb-3">
      <input type="text" name="vat" class="form-control" placeholder="PVM kodas">
    </div>
    <div class="mb-3">
      <input type="text" name="address" class="form-control" placeholder="Adresas">
    </div>
    <div class="mb-3">
      <input type="text" name="director" class="form-control" placeholder="Vadovas">
    </div>
    <div class="mb-3">
      <textarea name="description" id="" cols="30" rows="10" placeholder="Imones aprasymas" class="form-control"></textarea>
    </div>
    <div class="mb-3">
      <label>Logotipas</label>
      <input type="file" name="logo" class="form-control" accept=".png, .jpg, .jpeg">
    </div>
    <button type="submit" class="btn btn-primary">Saugoti</button>
  </form>
@endsection