<style scoped>
    .breadcrumb {
        background-color: transparent;
    }

    .watermark {
        position: absolute;
        height: 250px;
        width: 250px;
        overflow: auto;
        opacity: 0.05;
        transform: translate(-250px, 0px);
    }

    .img-item {
        height: 250px;
        width: 250px;
    }

    .t-head {
        font-weight: bold;
    }
</style>

<template>
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-0">
                <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home" aria-label="home"></i></a></li>
                <li class="breadcrumb-item"><a :href="'/product?c=' + encodeURIComponent(this.items.category)">{{ this.items.category }}</a></li>
                <li class="breadcrumb-item active">{{ this.items.name }}</li>
            </ol>
        </nav>
        <a href="/storage/images/logo/watermark.png">
            <img :src="genImg(this.items.img)" :alt="this.items.img" class="img-responsive img-item">
            <img src="/storage/images/logo/watermark.png" alt="watermark.png" class="img-responsive watermark">
        </a>
        <div class="container pl-0 pt-4">
            <div class="row justify-content-start align-items-start">
                <div class="col-12"></div>
                <div class="col-4 col-md-2 t-head"><p>Name</p></div>
                <div class="col"><p>{{ this.items.name }}</p></div>
                <div class="col-12"></div>
                <div class="col-4 col-md-2 t-head"><p>Category</p></div>
                <div class="col"><p>{{ this.items.category }}</p></div>
                <div class="col-12"></div>
                <div class="col-4 col-md-2 t-head"><p>Description</p></div>
                <div class="col"><p>{{ this.items.desc != null ? this.items.desc : '-' }}</p></div>
                <div class="col-12"></div>
                <div class="col-4 col-md-2 t-head"><p>Available {{isMaterial(this.items.materials) ? "Materials" : "Brands"}}</p></div>
                <div class="col">
                    <ul class="pl-3">
                        <li class="pb-1" v-for="info in this.items.materials" :key="info">{{ info.name !== null ? info.name : info.brands }} {{ info.extra !== '' ? "(" + info.extra + ")" : null }}</li>
                    </ul>
                </div>
                <div class="col-12"></div>
            </div>
        </div>
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
            },
            isMaterial: function(materials) {
                var res = true;

                if (materials[0].name === null){
                        res = false;
                }

                return res;
            },
        }
    }
</script>