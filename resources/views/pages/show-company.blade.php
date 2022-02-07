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
</div>
@endsection