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

    .pagebar a {
        color: black;
    }

    .noclick {
        pointer-events: none;
        font-weight: bold !important;
    }
    
    .query {
        font-weight: bold;
    }
</style>

<template>
    <div class="row align-items-center justify-content-center">
        <div class="container col-12">
            <div class="row pb-5">
                <div class="col d-flex flex-column">
                    <p class="query mb-0">{{ this.searchq }}</p>
                    <small>There are {{ this.totalitems }} hit(s)</small>
                </div>
                <div class="col-2 d-flex flex-row-reverse">
                    <select @change="sortOps($event)">
                        <option v-for="op in this.ops" :key="op.val" :value="op.val" :selected="op.selected">{{ op.txt }}</option>
                    </select>
                </div>
            </div>
        </div>
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
        <div class="container col-12 pt-5 pagebar">
            <div class="row">
                <div class="col-2">
                    <a :href="navPage(-1)" v-if="this.page != 1">&#8592; Previous</a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a v-for="page in genPage()" :key="page.num" :href="navPage(page.num)" class="px-1" :class="{noclick: page.disabled}" v-on:click="isDisabled(page.disabled, $event)">{{ page.num }}</a>
                </div>
                <div class="col-2 d-flex flex-row-reverse">
                    <a :href="navPage(0)" v-if="(this.page != this.totalpage) && (this.totalpage != 0)">Next &#8594;</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['itemslist', 'page', 'itemspage', 'totalpage', 'searchq', 'totalitems', 'sortmod'],
        data() {
            return {
                items: JSON.parse(this.itemslist),
                ops: [
                    {
                        val: "def",
                        txt: "Most relevant",
                        selected: this.sortmod == "def" ? true : false
                    },
                    {
                        val: "nasc",
                        txt: "Alphabetical order: A to Z",
                        selected: this.sortmod == "nasc" ? true : false
                    },
                    {
                        val: "ndesc",
                        txt: "Alphabetical order: Z to A",
                        selected: this.sortmod == "ndesc" ? true : false
                    }
                ]
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
            },
            navPage: function(page) {
                var url = new URL(location.href);
                var search_params = url.searchParams;
                var current_p;
                var to_page;

                if (search_params.get('p')) {
                    current_p = parseInt(search_params.get('p'));
                }
                else {
                    current_p = 1;
                }
                
                switch(page) {
                    // Prev
                    case -1:
                        to_page = current_p - 1;
                        break;
                    // Next
                    case 0:
                        to_page = current_p + 1;
                        break;
                    default:
                        to_page = page;
                        break;
                }

                search_params.set('p', to_page);
                url.search = search_params.toString();

                return url.toString();
            },
            genPage: function() {
                var numList = [];
                var len = 9;
                var first = 1;
                var lim = first + len;

                while (this.page >= lim) {
                    first += 5;
                    lim += 5;
                }

                if (this.totalpage < lim) {
                    var dif = lim-first;
                    lim = this.totalpage;

                    if (dif != len) {
                        while((first != 1) || (dif != len)) {
                            first -= 1;
                            index += 1;
                        }
                    }
                }

                var obj;

                for (var i = first; i <= lim; i++) {
                    obj = {
                        num: i,
                        disabled: i == this.page ? true : false
                    };

                    numList.push(obj);
                }

                if (numList.length == 1) {
                    numList = [];
                }

                return numList;
            },
            isDisabled: function(disabled, e) {
                if (disabled) {
                    e.preventDefault();
                }
            },
            sortOps: function(e) {
                var val = e.target.value;
                var url = new URL(location.href);
                var search_params = url.searchParams;

                search_params.set('o', val);

                url.search = search_params.toString();
                location.href = url;
            }
        }
    }
</script>