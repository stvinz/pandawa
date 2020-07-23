<template>
    <nav class="navbar navbar-expand-sm navbar-dark justify-content-center p-1 pb-3">
        <ul class="navbar-nav">
            <li class="nav-item px-5" v-for="(item, index) in navlink" :key="item.name" :class="{ active: isActive[index] }" :style="navBorder[index]">
                <a class="nav-link" :href="item.link">{{ item.name }}</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['activate'],
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
                isActive: null,
                navBorder: null
            }
        },
        created() {
            var isActive = [];

            for (var i = 0; i < this.navlink.length; i++) {
                isActive[i] = false;
            }

            this.isActive = isActive;

            var navBorder = [];
            var borderStyle = '1px solid white';

            for (var i = 0; i < this.navlink.length-1; i++) {
                navBorder[i] = {'border-left': borderStyle};
            }

            navBorder[this.navlink.length-1] = {
                'border-left': borderStyle,
                'border-right': borderStyle
            };

            this.navBorder = navBorder

            switch (this.activate) {
                case "Home":
                    Vue.set(this.isActive, 0, true);
                    break;
                case "About":
                    Vue.set(this.isActive, 1, true);
                    break;
                case "Product":
                    Vue.set(this.isActive, 2, true);
                    break;
                case "Contact":
                    Vue.set(this.isActive, 3, true);
                    break;
            }
        }
    }
</script>