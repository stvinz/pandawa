<header class="sticky-top">
    <div class="container-fluid bg-dark p-2" >
        {{ Form::open(['url' => '/product', 'method' => 'GET']) }}
        <div class="row row-no-gutters align-items-center title-bar m-0">
            <div class="col-xl-3 col-lg-5 col-12 p-0">
                <title-bar></title-bar>
            </div>
            <div class="col-lg-1 col-sm-3 col-2"></div>
            <div class="col-lg-3 col-sm-5 col-7 p-0">
                {{ Form::text('s', null, ['placeholder' => 'Search for a product, category, or material', 'class' => 'form-control input-lg w-100 title-search'])}}
            </div>
            <div class="col-lg-1 col-sm-2 col-3 p-0">
                <button type="submit" class="form-control w-50"><i class="fa fa-search"></i></button>
            </div>
        </div>
        {{ Form::close() }}

        {{ Form::open(['url' => '/product', 'method' => 'GET']) }}
        <nav-bar activate="@yield('active-page')" categories="{{ $categories }}" materials="{{ $materials }}"></nav-bar>
        <div class="coll" id="collapsibleSearch">
            {{ Form::text('s', null, ['placeholder' => 'Search for a product, category, or material', 'class' => 'form-control input-lg w-100 coll-search'])}}
        </div>
        {{ Form::close() }}
    </div>
</header>