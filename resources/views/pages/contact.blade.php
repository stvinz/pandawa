@php
    $grecaptcha = config('services.grecaptcha');
    $key = $grecaptcha["site"];
@endphp

@extends('layouts.default')

@section('title', 'Contact Us')

@section('active-page', 'Contact Us')

@section('content')
    {{ Form::open(['url' => '/contact-us', 'method' => 'POST', 'files' => 'true']) }}
    <div class="form-group row align-items-center justify-content-center">
        <div class="col-lg-4">
            <h2>Send a Message!</h2>
        </div>
        <div class="col-lg-4"></div>
        <div class="w-100 py-1"></div>

        <div class="col-lg-2">
            {{ Form::label('company', 'Company Name') }}
        </div>
        <div class="col-lg-6">
            {{ Form::text('company', null, ['class' => 'form-control input-lg w-100'.($errors->has('company') ? " is-invalid" : "")]) }}
        </div>
        @error('company')
        @include('components.error.contact')
        @enderror
        <div class="w-100 py-1"></div>

        <div class="col-lg-2">
            {{ Form::label('name', 'Your Name *') }}
        </div>
        <div class="col-lg-6">
            {{ Form::text('name', null, ['class' => 'form-control input-lg w-100'.($errors->has('name') ? " is-invalid" : ""), 'required' => 'true']) }}
        </div>
        @error('name')
        @include('components.error.contact')
        @enderror
        <div class="w-100 py-1"></div>

        <div class="col-lg-2">
            {{ Form::label('email', 'E-mail Address *') }}
        </div>
        <div class="col-lg-6">
            {{ Form::email('email', null, ['class' => 'form-control input-lg w-100'.($errors->has('email') ? " is-invalid" : ""), 'required' => 'true']) }}
        </div>
        @error('email')
        @include('components.error.contact')
        @enderror
        <div class="w-100 py-1"></div>

        <div class="col-lg-2">
            {{ Form::label('enquiry', 'Enquiry *') }}
        </div>
        <div class="col-lg-6">
            {{ Form::textArea('enquiry', null, ['class' => 'form-control input-lg w-100'.($errors->has('enquiry') ? " is-invalid" : ""), 'required' => 'true']) }}
        </div>
        @error('enquiry')
        @include('components.error.contact')
        @enderror
        <div class="w-100 py-1"></div>

        <div class="col-lg-2">
            {{ Form::label('attachment', 'Attachments') }}
        </div>
        <div class="col-lg-6">
            {{ Form::file('attachment') }}
        </div>
        @error('attachment')
        @include('components.error.contact')
        @enderror
        <div class="w-100 py-3"></div>


        <div class="col-lg-2">
        </div>
        <div class="col-lg-6">
            <div class="g-recaptcha" data-sitekey="{{ $key }}"></div>
        </div>
        <div class="w-100 py-0"></div>

        @if (isset($errcap))
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <small class="text-danger">{{ $errcap }}</small>  
        </div>
        @endif

        <div class="w-100 py-3"></div>
        
        <div class="col-lg-8">
        </div>
        <div class="col-lg-2">
            {{ Form::submit('Submit') }}
        </div>
    </div>
    {{ Form::close() }}
@endsection