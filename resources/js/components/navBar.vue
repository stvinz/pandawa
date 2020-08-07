<template>
    <nav class="navbar navbar-expand-sm navbar-dark p-2">
        <button type="button" class="navbar-toggler align-self-start" data-toggle="collapse" data-target="#collapsibleNavbar"><i class="fa fa-bars"></i></button>
        <h5 class="text my-1 align-self-center title-nav" style="display: none;">Sumber Jaya Pandawa</h5>
        <button type="button" class="navbar-toggler align-self-end" data-toggle="collapse" data-target="#collapsibleSearch"><i class="fa fa-search"></i></button>

        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">    
            <ul class="navbar-nav">
                <li class="nav-item px-5" v-for="(item, index) in navlink" :key="item.name" :class="{ active: isActive[item.name], dropdown: isDropdown(item.name) }" :style="navBorder(index)">
                    <a class="nav-link" :href="item.link" :class="{'dropdown-toggle': isDropdown(item.name)}">{{ item.name }}</a>
                    <ul :style="dropdownMenu(item.name)" class="dropdown-menu overflow-auto" >
                        <li v-for="item in catList" :key="item.name"><a class="dropdown-item" :href="genUrlCat(item.name)">{{ item.name }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['activate', 'categories'],
        data() {
            return {
                navlink: [
                    {
                        name: 'Home',
                        link: '/home'
                    },
                    {
                        name: 'About',
                        link: '/about'
                    },
                    {
                        name: 'Product',
                        link: '/product'
                    },
                    {
                        name: 'Contact Us',
                        link: '/contact-us'
                    }
                ],
                isActive: {
                    Home: false,
                    About: false,
                    Product: false,
                    'Contact Us': false
                },
                catList: JSON.parse(this.categories)
            }
        },
        methods: {
            navBorder: function(index) {
                var borderStyle = '1px solid white';

                if (index < this.navlink.length-1) {
                    return {'border-left': borderStyle};
                }
                else if (index == this.navlink.length-1) {
                    return {
                        'border-left': borderStyle,
                        'border-right': borderStyle
                    };
                }
            },
            isDropdown: function(name) {
                return name == "Product" ? true : false;
            },
            isToggleDropdown: function(name) {
                return name == "Product" ? "dropdown" : null;
            },
            dropdownMenu: function (name) {
                return name == "Product" ? {'margin-top': '-0.01em', 'min-width': '100%', 'max-height': '500%'} : {'display': 'none'};
            },
            genUrlCat: function (name) {
                return 'product/category/' + name;
            },
        },
        created() {
            this.isActive[this.activate] = true;
        }
    }
</script>