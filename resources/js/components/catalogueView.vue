<template>
    <div></div>
</template>

<script>
    export default {
        props: ['activate', 'categories', 'materials'],
        data() {
            return {
                isActive: {
                    Home: false,
                    About: false,
                    Material: false,
                    Product: false,
                    'Contact Us': false
                }
            }
        },
        methods: {
            navBorder: function(index) {
            }
        },
        created() {
        }
    }
</script>