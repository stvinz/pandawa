<style scoped>
    .breadcrumb {
        background-color: transparent;
    }
</style>

<template>
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-0">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a :href="'/product?c=' + encodeURIComponent(this.items.category)">{{ this.items.category }}</a></li>
                <li class="breadcrumb-item active">{{ this.items.name }}</li>
            </ol>
        </nav>
        <a :href="genImg(this.items.img)"><img :src="genImg(this.items.img)" :alt="this.items.img" class="img-responsive"></a>
        <p>Name: {{ this.items.name }}</p>
        <p>Category: {{ this.items.category }}</p>
        <p>Description: {{ this.items.desc != '' ? this.items.desc : '-' }}</p>
        <p>Available Materials / Brands: {{ this.items.materials }}</p>
    </div>
</template>

<script>
    export default {
        props: ['itemslist'],
        data() {
            return {
                items: JSON.parse(this.itemslist)
            }
        },
        methods: {
            genImg: function(name) {
                return "/storage/images/products/" + name;
            }
        }
    }
</script>