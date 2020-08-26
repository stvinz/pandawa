@extends('layouts.default')

@section('title', 'Name of Product')

@section('active-page', 'Product')

@section('content')
    <div>
        <detail-view itemslist="{{ $product }}"></detail-view>
    </div>
@endsection