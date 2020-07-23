<header>
    <div class="container-fluid" style="background-color: #da6d42;">
        {{ Form::open(['url' => '/product', 'method' => 'GET']) }}
        <div class="row row-no-gutters align-items-center p-1">
            <div class="col-xl-3 col-lg-5 p-0">
                <title-bar></title-bar>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-3 p-0">
                {{ Form::text('s', null, ['placeholder' => 'Search', 'class' => 'form-control input-lg w-100'])}}
            </div>
            <div class="col-lg-1 p-0">
                {{ Form::submit('Search', ['class' => 'form-control'])}}
            </div>
        </div>
        {{ Form::close() }}
        <nav-bar activate="@yield('active-page')"></nav-bar>
    </div>
</header>