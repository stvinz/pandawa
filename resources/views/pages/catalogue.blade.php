@extends('layouts.default')

@section('title', 'Product')

@section('active-page', 'Product')

@section('content')
    <catalogue-view itemslist="{{ $products }}" totalpage="{{ $totalPage }}" page="{{ $page }}" itemspage="{{ $itemsPage }}" searchq="{{ $searchQ }}" totalitems="{{ $totalItems }}" sortmod="{{ $sortMod }}" ></catalogue-view>
@endsection
