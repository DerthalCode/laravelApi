@extends('main')
@section('content')
<div class="container-fluid d-flex justify-content-center">
    <h1 class="mt-4">{{$company->company}}</h1>
</div>
<div class="container d-flex justify-content-center">
    <ul>
            @if($company->logo)
                <img src="{{asset('/storage/'.$company->logo)}}" alt="">
                @endif 
            <li>Kompanijos kodas: {{$company->code}}</li>
            <li>VAT: {{$company->vat}}</li>
            <li>Adresas: {{$company->address}}</li>
            <li>Vadovas: {{$company->director}}</li>
            <li>Veikla: {{$company->description}}</li>
        </ul>
        <form action="/company/{{$company->id}}/comment" method="post">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="Jusu komentaras"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Komentuoti</button>
            </div>
        </form>

</div>
@endsection