@extends('layouts.default')

@section('title', 'Product')

@section('active-page', 'Product')

@section('content')
    <p>{{ $searchQ }}</p>
    <catalogue-view itemslist="{{ $products }}"></catalogue-view>
@endsection
