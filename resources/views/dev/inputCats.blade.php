@extends('layouts.dev')

@section('content')
    <h1>Category</h1>
    <div class="form-group">
    {{ Form::open(['url' => '/dev/cats', 'method' => 'POST', 'files' => 'true']) }}
        {{ Form::label('name', 'Insert Category Name') }}:
        {{ Form::text('name', null, ['class' => 'form-control input-lg'.($errors->has('name') ? " is-invalid" : "")]) }}

        {{ Form::submit('Add') }}
    {{ Form::close() }}
    <br>
    {{ Form::open(['url' => '/dev/cats', 'method' => 'DELETE']) }}
        {{ Form::label('name', 'Delete Category Name') }}:
        {{ Form::text('name', null, ['class' => 'form-control input-lg'.($errors->has('name') ? " is-invalid" : "")]) }}

        {{ Form::submit('Delete') }}
    {{ Form::close() }}
    <br>
    {{ Form::open(['url' => '/dev/cats', 'method' => 'PUT']) }}
        {{ Form::label('name', 'Update Category Name') }}:
        {{ Form::text('name', null, ['class' => 'form-control input-lg'.($errors->has('name') ? " is-invalid" : "")]) }}
        {{ Form::label('to_name', 'To Category Name') }}:
        {{ Form::text('to_name', null, ['class' => 'form-control input-lg'.($errors->has('to_name') ? " is-invalid" : "")]) }}
        {{ Form::label('img', 'Update Image Category:') }}:
        {{ Form::text('img', null, ['class' => 'form-control input-lg'.($errors->has('img') ? " is-invalid" : "")]) }}

        {{ Form::submit('Update') }}
    {{ Form::close() }}
    </div>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Img</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td><img src="{{ asset('storage/images/products/'.$item->img) }}"></td>
            </tr>
        @endforeach
    </table>
@endsection