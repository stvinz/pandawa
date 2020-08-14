@extends('layouts.dev')

@section('content')
    <h1>Products</h1>
    <div class="form-group">
    {{ Form::open(['url' => '/dev/prods', 'method' => 'POST', 'files' => 'true']) }}
        {{ Form::label('name', 'Insert Product Name') }}:
        {{ Form::text('name', null, ['class' => 'form-control input-lg'.($errors->has('name') ? " is-invalid" : "")]) }}
        {{ Form::label('category', 'Insert Product Category') }}:
        {{ Form::text('category', null, ['class' => 'form-control input-lg'.($errors->has('category') ? " is-invalid" : "")]) }}
        {{ Form::label('materials', 'Insert Product Materials') }}:
        {{ Form::text('materials', null, ['placeholder' => 'Besi (NP Putih), Baja (Hitam), ...','class' => 'form-control input-lg'.($errors->has('materials') ? " is-invalid" : "")]) }}

        {{ Form::submit('Add') }}
    {{ Form::close() }}
    @if (isset($err))
        <p class="text-danger">{{ $err }}</p>
    @endif
    </div>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Desc</th>
            <th>Img</th>
            <th>Materials</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->desc }}</td>
                <td><img src="{{ asset('storage/images/products/'.$item->img) }}"></td>
                <td>{{ $item->material }} ({{ $item->extra }})</td>
            </tr>
        @endforeach
    </table>
@endsection