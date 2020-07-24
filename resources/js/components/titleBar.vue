<template>
    <div class="container-fluid w-100" style="cursor: pointer;" v-on:click="handle($event)">
        <div class="row row-no-gutters align-items-center justify-content-center">
            <div class="col-auto">
                <img src="assets/logo-backless.png" alt="Logo" class="img-responsive" height="60" width="60">
            </div>
            <div class="col-auto p-0">
                <h5 class="text-nowrap my-1">PT. Sumber Jaya Pandawa</h5>
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