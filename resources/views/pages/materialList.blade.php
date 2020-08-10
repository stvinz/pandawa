@extends('layouts.default')

@section('title', 'Material List')

@section('active-page', 'Material')

@section('content')
    <div class="row pb-4">
        <div class="col">
            <h2 class="text-center">Available Materials</h2>
        </div>
    </div>
    <category-view itemslist="{{ $materials }}" itemtype="{{ 'Material' }}"></category-view>
@endsection