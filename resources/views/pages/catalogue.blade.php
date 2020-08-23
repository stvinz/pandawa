@extends('layouts.default')

@section('title', 'Product')

@section('active-page', 'Product')

@section('content')
    <p>{{ $searchQ }}</p>
    <small>There are {{ $totalItems }} hits</small>
    <catalogue-view itemslist="{{ $products }}" totalpage="{{ $totalPage }}" page="{{ $page }}" itemspage="{{ $itemsPage }}" ></catalogue-view>
@endsection
