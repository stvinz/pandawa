<style scoped>
    a {
        color: #000000;
    }

    a:hover {
        font-weight: bold;
    }

    .card:hover {
        background-color: lemonchiffon;
    }
</style>

<template>
    <div class="row align-items-center justify-content-center">
        <div class="container col-auto card mb-2" style="cursor: pointer;" v-for="item in items" :key="item.name">
            <a :href="genUrl(item.name)" class="text-decoration-none">
                <div class="row justify-content-center align-items-center p-0" style="border-bottom: 1px solid lightgray">
                    <img :src="genImg(item.img)" :alt="item.img" class="img-responsive" height="250" width="250">
                </div>
                <div class="row justify-content-center align-items-center pt-3 pb-0">
                    <p class="text-center">{{ item.name }}</p>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['itemslist', 'itemtype'],
        data() {
            return {
                items: JSON.parse(this.itemslist)
            }
        },
        methods: {
            genUrl: function(name) {
                if (this.itemtype == "Material")
                    return "product?m=" + name;
                else if (this.itemtype == "Category")
                    return "product?c=" + name;
            },
            genImg: function(name) {
                return "/storage/images/products/" + name;
            }
        },
        created() {
        }
    }
</script>