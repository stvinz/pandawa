<header class="sticky-top">
    <div class="container-fluid bg-dark" >
        {{ Form::open(['url' => '/product', 'method' => 'GET']) }}
        <div class="row row-no-gutters align-items-center p-1">
            <div class="col-xl-3 col-lg-5 p-0">
                <title-bar></title-bar>
            </div>
            <div class="col-lg-1 col-sm-3"></div>
            <div class="col-lg-3 col-sm-5 p-0">
                {{ Form::text('s', null, ['placeholder' => 'Search', 'class' => 'form-control input-lg w-100'])}}
            </div>
            <div class="col-lg-1 col-sm-2 p-0">
                <button type="submit" class="form-control w-50"><i class="fa fa-search"></i></button>
            </div>
        </div>
        {{ Form::close() }}
        <nav-bar activate="@yield('active-page')"></nav-bar>
    </div>
</header>