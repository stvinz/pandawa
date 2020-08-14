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
        <div class="container col-auto card mb-2" style="cursor: pointer;" v-for="(dets, name) in items" :key="name">
            <a :href="genUrl(dets.id)" class="text-decoration-none">
                <div class="row justify-content-center align-items-center p-0" style="border-bottom: 1px solid lightgray">
                    <img :src="genImg(dets.img)" :alt="dets.img" class="img-responsive" height="250" width="250">
                </div>
                <div class="row justify-content-center align-items-center pt-3 pb-0">
                    <p class="text-center">{{ name }}</p>
                </div>
                <div class="row justify-content-center align-items-center pt-3 pb-0" v-for="detail in dets.materials" :key="detail.name">
                    <p class="text-center">
                        {{ detail.name }} {{ detail.extra }} 
                    </p>
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
            }
        },
        created() {
            console.log(this.items);
        }
    }
</script>