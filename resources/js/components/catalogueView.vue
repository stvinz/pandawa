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
    
    .card:hover img {
        opacity: 0.3;
        transition: opacity 0.3s;
    }

    div > .overlay {
        position: absolute;
        visibility: hidden;
        height: 250px;
        width: 250px;
        transform: translate(0px, 0px);
    }

    .card:hover .overlay{
        visibility: visible;
    }

    .card-top {
        border-bottom: 1px solid lightgray;
    }
</style>

<template>
    <div class="row align-items-center justify-content-center">
        <div class="container col-auto card mb-2 pointer" v-for="(dets, name) in items" :key="name">
            <a :href="genUrl(dets.id)" class="text-decoration-none">
                <div class="row justify-content-center align-items-center p-0 card-top">
                    <img :src="genImg(dets.img)" :alt="dets.img" class="img-responsive">
                    <div class="overlay p-3 m-0">
                        <p class="text-center m-0 p-3">Available Materials: </p>
                        <p class="text-center m-0 p-1" v-for="detail in dets.materials" :key="detail.name">
                            {{ detail.name }} {{ parantExtra(detail.extra) }} 
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center pt-3 pb-0">
                    <p class="text-center">{{ name }}</p>
                </div>
            </a>
        </div>
        <div class="container col-12 pt-5">
            <div class="row">
                <div class="col-2" v-if="this.page != 1">
                    <a href="/previous">&#8592; Previous</a>
                </div>
                <div class="col">
                </div>
                <div class="col-2 d-flex flex-row-reverse" v-if="this.page != this.totalpage">
                    <a href="/next">Next &#8594;</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['itemslist', 'page', 'itemspage', 'totalpage'],
        data() {
            return {
                items: JSON.parse(this.itemslist)
            }
        },
        methods: {
            genUrl: function(id) {
                return 'product/' + id;
            },
            genImg: function(name) {
                return "/storage/images/products/" + name;
            },
            parantExtra: function(extra) {
                return extra != "" ? '('+ extra +')' : null;
            }
        },
        created() {
        }
    }
</script>