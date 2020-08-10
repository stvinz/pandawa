@extends('layouts.default')

@section('title', 'Product')

@section('active-page', 'Product')

@section('content')
    <p>This is product</p>
    <h1>show {{ $products }} products</h1>
    {{--<catalogue-view productList="{{ $productList }}" activePanel="{{ $activePanels }}"></catalogue-view> --}}
@endsection
