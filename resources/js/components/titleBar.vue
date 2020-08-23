<style scoped>
    .title:hover {
        color: lightgray;
    }
</style>

<template>
    <div class="container-fluid w-100 title pointer" v-on:click="handle($event)">
        <div class="row row-no-gutters align-items-center justify-content-center">
            <div class="col-sm-auto col-2 pr-1">
                <img src="storage/images/logo/logo-backless.png" alt="Logo" class="img-responsive" height="50" width="50">
            </div>
            <div class="col-sm-auto col-10 pl-1">
                <h5 class="text my-1">PT. Sumber Jaya Pandawa</h5>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            handle: function(event) {
                return window.location = "/home"
            }
        }
    }
</script>