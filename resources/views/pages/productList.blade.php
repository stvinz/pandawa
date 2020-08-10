@extends('layouts.default')

@section('title', 'Product List')

@section('active-page', 'Product')

@section('content')
    <div class="row pb-4">
        <div class="col">
            <h2 class="text-center">Product Categories</h2>
        </div>
    </div>
    <category-view itemslist="{{ $categories }}" itemtype="{{ 'Category' }}"></category-view>
@endsection