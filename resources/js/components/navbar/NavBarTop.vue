
<template>
    <body>
        <section v-if="!loggin" id="topbar" class="d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:rocketmc2009@gmail.com">rocketmc2009@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+244 939 000 287</span></i>
            </div>

            <div class="cta d-none d-md-flex align-items-center">
                <router-link to="/webcontact/signup" class="scrollto">Sign Up </router-link>
                <router-link to="/webcontact/signin" class="scrollto" style="background-color: rgb(13, 46, 194)">Sign In</router-link>
            </div>
            </div>
        </section>

    </body>
</template>

<script>
    import Header from '../navbar/Header.vue';

    export default {
        props:  {
            username: '',
            loggin: false,
        },
        components:{
            Header,
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
