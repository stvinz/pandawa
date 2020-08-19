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

    div .container {
        cursor: pointer;
    }

    .card-top {
        border-bottom: 1px solid lightgray;
    }
</style>

<template>
    <div class="row align-items-center justify-content-center">
        <div class="container col-auto card mb-2" v-for="(dets, name) in items" :key="name">
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