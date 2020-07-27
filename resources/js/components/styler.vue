<!-- CSS Injections -->

<style>
    .navbar-nav li:hover .dropdown-menu {
        display: block;
    }

    header, footer {
        color: white;
    }

    footer ul a {
        color: #F5F5F5;
    }

    footer ul a:hover {
        color: #fedc59;
    }

    footer ul li {
        margin: 2% 0%;
    }

    @media only screen and (max-width: 576px) {
        header .title-bar {
            display: none;
        }

        header nav .title-nav {
            display: block !important;
        }

        header ul li {
            border: 0px !important;
        }

        header .title-search, button[type="submit"] {
            display: none;
        }

        .navbar-nav li:hover .dropdown-menu {
            display: none;
        }

        .navbar-nav li .dropdown-toggle::after {
            display: none !important;
        }
    }
</style>

<script>
    export default {
    }
</script>