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

    .card img {
        height: 250px;
        width: 250px;
    }

    .card-top {
        border-bottom: 1px solid lightgray;
    }

    .watermark {
        position: absolute;
        height: 250px;
        width: 250px;
        overflow: auto;
        opacity: 0.08;
        transform: translate(0px, 0px);
    }
</style>

<template>
    <div class="row align-items-center justify-content-center">
        <div class="container col-auto card mb-2 pointer" v-for="item in items" :key="item.name">
            <a :href="genUrl(item.name)" class="text-decoration-none">
                <div class="row justify-content-center align-items-center p-0 card-top">
                    <img :src="genImg(item.img)" :alt="item.img" class="img-responsive">
                    <img src="/storage/images/logo/watermark.png" alt="watermark.png" class="img-responsive watermark">
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
                    return "product?m=" + encodeURIComponent(name);
                else if (this.itemtype == "Category")
                    return "product?c=" + encodeURIComponent(name);
            },
            genImg: function(name) {
                return "/storage/images/products/" + name;
            }
        }
    }
</script>