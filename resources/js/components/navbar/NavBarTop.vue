
<template>
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
</template>

<script>

    export default {
        props:  {
            username: '',
            loggin: false,
        },
        components:{
        },
        methods: {
            fixedNav(){
                const scrollto = (el) => {
                    let header = select('#header')
                    let offset = header.offsetHeight

                    let elementPos = select(el).offsetTop
                    window.scrollTo({
                    top: elementPos - offset,
                    behavior: 'smooth'
                    })
                }

                /**
                 * Header fixed top on scroll
                 */
                let selectHeader = select('#header')
                if (selectHeader) {
                    let headerOffset = selectHeader.offsetTop
                    let nextElement = selectHeader.nextElementSibling
                    const headerFixed = () => {
                    if ((headerOffset - window.scrollY) <= 0) {
                        selectHeader.classList.add('fixed-top')
                        nextElement.classList.add('scrolled-offset')
                    } else {
                        selectHeader.classList.remove('fixed-top')
                        nextElement.classList.remove('scrolled-offset')
                    }
                    }
                    window.addEventListener('load', headerFixed)
                    onscroll(document, headerFixed)
                }

            }
        },
        mounted() {
            this.fixedNav()
        }
    }
</script>
