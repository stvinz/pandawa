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
        {{ Form::label('brands', 'Insert Product Brands') }}:
        {{ Form::text('brands', null, ['placeholder' => 'Filtec, Recoil, ...','class' => 'form-control input-lg'.($errors->has('materials') ? " is-invalid" : "")]) }}

        {{ Form::submit('Add') }}
    {{ Form::close() }}
    @if (isset($err))
        <p class="text-danger">{{ $err }}</p>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
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
            <th>Brand</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->desc }}</td>
                <td>{{ $item->img }}</td>
                <td>{{ $item->material }} ({{ $item->extra }})</td>
                <td>{{ $item->brand }}</td>
            </tr>
        @endforeach
    </table>
@endsection