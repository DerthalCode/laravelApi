@extends('main')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Visos imones</h1>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Imones pavadinimas</th>
            <th>Kodas</th>
            <th>PVM kodas</th>
            <th>Platesne informacija</th>
            <th>Veiksmai</th>
        </tr>
        @foreach($companies as $company)
            <tr>
                <th>{{$company->company}}</th>
                <th>{{$company->code}}</th>
                <th>{{$company->vat}}</th>
                <th><a href="/company/{{$company->id}}">Placiau...</a></th>
                <th>
                    <ul>
                        <li><a href="/delete/company/{{$company->id}}">Salinti</a></li>
                        <li><a href="/update/company/{{$company->id}}">Redaguoti</a></li>
                    </ul>
                </th>
            </tr>
        @endforeach
    </table>
    {{$companies->links()}}
</div>
@endsection