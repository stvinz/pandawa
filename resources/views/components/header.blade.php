<div class="container-fluid bg-primary">
    {{ Form::open(['url' => '/search', 'method' => 'GET']) }}
    <div class="row row-no-gutters align-items-center p-1">
        <div class="col-xl-3 col-lg-5 p-0">
            <div class="container-fluid w-100">
                <div class="row row-no-gutters align-items-center justify-content-center">
                    <div class="col-auto">
                        <img src="{{ asset('assets/logo-backless.png') }}" alt="Logo" class="img-responsive" height="60" width="60">
                    </div>
                    <div class="col-auto p-0">
                        <h5 class="text-nowrap my-1">PT. Sumber Jaya Pandawa</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-4 p-0">
            {{ Form::text('p', null, ['placeholder' => 'Search', 'class' => 'form-control input-lg w-100'])}}
        </div>
        <div class="col-lg-1 p-0">
            {{ Form::submit('Search', ['class' => 'form-control'])}}
        </div>
    </div>
    {{ Form::close() }}
    <!-- use vue component for nav bar -->
</div>