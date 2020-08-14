@extends('layouts.dev')

@section('content')
    <h1>Material</h1>
    <div class="form-group">
    {{ Form::open(['url' => '/dev/mats', 'method' => 'POST', 'files' => 'true']) }}
        {{ Form::label('name', 'Insert Material Name') }}:
        {{ Form::text('name', null, ['class' => 'form-control input-lg'.($errors->has('name') ? " is-invalid" : "")]) }}

        {{ Form::submit('Add') }}
    {{ Form::close() }}
    <br>
    {{ Form::open(['url' => '/dev/mats', 'method' => 'DELETE']) }}
        {{ Form::label('name', 'Delete Material Name') }}:
        {{ Form::text('name', null, ['class' => 'form-control input-lg'.($errors->has('name') ? " is-invalid" : "")]) }}

        {{ Form::submit('Delete') }}
    {{ Form::close() }}
    <br>
    {{ Form::open(['url' => '/dev/mats', 'method' => 'PUT']) }}
        {{ Form::label('name', 'Update Material Name') }}:
        {{ Form::text('name', null, ['class' => 'form-control input-lg'.($errors->has('name') ? " is-invalid" : "")]) }}
        {{ Form::label('to_name', 'To Material Name') }}:
        {{ Form::text('to_name', null, ['class' => 'form-control input-lg'.($errors->has('to_name') ? " is-invalid" : "")]) }}
        {{ Form::label('img', 'Update Image Material:') }}:
        {{ Form::text('img', null, ['class' => 'form-control input-lg'.($errors->has('img') ? " is-invalid" : "")]) }}

        {{ Form::submit('Update') }}
    {{ Form::close() }}
    </div>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Material</th>
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