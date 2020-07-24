@extends('layouts.default')

@section('title', 'Contact Us')

@section('active-page', 'Contact Us')

@section('content')
    {{ Form::open(['url' => '/contact-us', 'method' => 'POST', 'files' => 'true']) }}
    <div class="form-group row align-items-center justify-content-center">
        <div class="col-sm-4">
            <h2>Send a Message!</h2>
        </div>
        <div class="col-sm-4"></div>
        <div class="w-100 py-1"></div>
        <div class="col-sm-2">
            {{ Form::label('company', 'Company Name') }}
        </div>
        <div class="col-sm-6">
            {{ Form::text('company', null, ['class' => 'form-control input-lg w-100']) }}
        </div>
        <div class="w-100 py-1"></div>
        <div class="col-sm-2">
            {{ Form::label('name', 'Your Name') }}
        </div>
        <div class="col-sm-6">
            {{ Form::text('name', null, ['class' => 'form-control input-lg w-100']) }}
        </div>
        <div class="w-100 py-1"></div>
        <div class="col-sm-2">
            {{ Form::label('email', 'E-mail Address') }}
        </div>
        <div class="col-sm-6">
            {{ Form::email('email', null, ['class' => 'form-control input-lg w-100']) }}
        </div>
        <div class="w-100 py-1"></div>
        <div class="col-sm-2">
            {{ Form::label('enquiry', 'Enquiry') }}
        </div>
        <div class="col-sm-6">
            {{ Form::textArea('enquiry', null, ['class' => 'form-control input-lg w-100']) }}
        </div>
        <div class="w-100 py-1"></div>
        <div class="col-sm-2">
            {{ Form::label('attachment', 'Attachments') }}
        </div>
        <div class="col-sm-6">
            {{ Form::file('attachment') }}
        </div>
        <div class="w-100 py-3"></div>
        <div class="col-sm-8">
        </div>
        <div class="col-sm-2">
            {{ Form::submit('Submit') }}
        </div>
    </div>
    {{ Form::close() }}
@endsection