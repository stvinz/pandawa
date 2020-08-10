<style scoped>
    .title {
        color: white;
    }

    .title:hover {
        color: lightgray;
    }

    .navbar-nav li:hover .dropdown-menu {
        display: block;
    }
</style>
<template>
    <nav class="navbar navbar-expand-lg navbar-dark p-2">
        <button type="button" class="navbar-toggler align-self-start" data-toggle="collapse" data-target="#collapsibleNavbar"><i class="fa fa-bars"></i></button>
        <h5 class="text my-1 align-self-center title-nav" style="display: none;"><a class="text-decoration-none title" href="/home">Sumber Jaya Pandawa</a></h5>
        <button type="button" class="navbar-toggler align-self-end" data-toggle="collapse" data-target="#collapsibleSearch"><i class="fa fa-search"></i></button>

        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">    
            <ul class="navbar-nav">
                <li class="nav-item px-5" v-for="(item, index) in navlink" :key="item.name" :class="{ active: isActive[item.name], dropdown: isDropdown(item.name) }" :style="navBorder(index)">
                    <a class="nav-link" :href="item.link" :class="{'dropdown-toggle': isDropdown(item.name)}">{{ item.name }}</a>
                    <ul :style="dropdownMenu(item.name)" class="dropdown-menu overflow-auto" >
                        <li v-for="dropItem in dropItems[item.name]" :key="dropItem.name"><a class="dropdown-item" :href="genUrl(item.name, dropItem.name)">{{ dropItem.name }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['activate', 'categories', 'materials'],
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
                        name: 'Material',
                        link: '/material-list'
                    },
                    {
                        name: 'Product',
                        link: '/product-list'
                    },
                    {
                        name: 'Contact Us',
                        link: '/contact-us'
                    }
                ],
                isActive: {
                    Home: false,
                    About: false,
                    Material: false,
                    Product: false,
                    'Contact Us': false
                },
                dropItems: {
                    Product: JSON.parse(this.categories),
                    Material: JSON.parse(this.materials),
                }
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
                return ((name == "Product") || (name == "Material"));
            },
            isToggleDropdown: function(name) {
                return ((name == "Product") || (name == "Material")) ? "dropdown" : null;
            },
            dropdownMenu: function (name) {
                return ((name == "Product") || (name == "Material")) ? {'margin-top': '-0.01em', 'min-width': '100%', 'max-height': '500%'} : {'display': 'none'};
            },
            genUrl: function (menu_name, name) {
                if (menu_name == "Product")
                    return 'product?c=' + name;
                else if (menu_name == "Material")
                    return 'product?m=' + name;
            },
        },
        created() {
            this.isActive[this.activate] = true;
        }
    }
</script>