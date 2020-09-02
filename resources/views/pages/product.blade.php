@extends('layouts.default')

@section('title', $productName)

@section('active-page', 'Product')

@section('content')
    <div>
        <detail-view itemslist="{{ $product }}"></detail-view>
    </div>
@endsection