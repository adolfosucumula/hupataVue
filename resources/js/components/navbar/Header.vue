
<template>
    <session>
        <section v-if="!loggin" id="topbar" class="d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:rocketmc2009@gmail.com">rocketmc2009@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+244 939 000 287</span></i>
            </div>

            <div class="cta d-none d-md-flex align-items-center">
                <router-link v-if="!loggin" to="/webcontact/signup" class="scrollto">Sign Up </router-link>
                <router-link v-if="!loggin" to="/webcontact/signin" class="scrollto" style="background-color: rgb(13, 46, 194)">Sign In</router-link>
            </div>
            </div>
        </section>
        <header id="header" class="d-flex align-items-center" style="background-color: 1D4354">
            <div class="container d-flex align-items-center justify-content-between">

                <div class="logo">
                    <h1 v-if="loggin"><router-link to="/web/dashboard" style="font-family: 'Pacifico', cursive; color: #492703">FreelancerANG </router-link></h1>
                    <h1 v-if="!loggin"><router-link to="/" style="font-family: 'Pacifico', cursive; color: #492703">FreelancerANG</router-link></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
                </div>

                <nav id="navbar" class="navbar">
                    <ul>
                    <li class="dropdown"><a class="nav-link scrollto " href="javascript:;"><span>Search Talents</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><router-link to="/web/dashboard/job/post" class="sublink" style="color: #000">Post a Job</router-link></li>
                            <li><router-link to="/" class="sublink"  style="color: #000">Browse and buy Projects</router-link></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link scrollto " href="javascript:;"><span>Search Works</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><router-link to="/web/dashboard/jobs" class="sublink" style="color: #000">Find work for your skils</router-link></li>
                        </ul>
                    </li>
                    <li><router-link class="nav-link scrollto " to="/web/dashboard/jobs">Search Jobs</router-link></li>

                    <li v-if="!loggin"><router-link class="nav-link scrollto" to="/webcontact/form" > Contacts </router-link></li>
                    <li v-if="loggin"><router-link class="nav-link scrollto" to="" > Message </router-link></li>
                    <li v-if="loggin" class="dropdown ">
                        <a href="javascript:;" class="nav-link"><img class="user-photo" :src="userimage" alt="user" ></a>
                        <ul>
                            <li><a href="#" style="color: #555;">{{username}}</a></li>
                            <li v-if="loggin"><router-link class="nav-link  sublink" to="/web/user/logout" >
                                <!--<i class="fa fa-power-off text-danger"></i>--> <span id="logout">Logout</span> </router-link>
                            </li>
                        </ul>
                    </li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
            </div>
        </header>
    </session>
</template>
<script>
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
    setup() {

    },
    props:  {
            username: '',
            userimage:'images/user.png',
            loggin: false,
        },
    data(){
        return {

        }
    },
    methods: {

    },
    mounted(){

    }
})
</script>

<style scoped>
    .user-photo{
        width: 40px;
        height: 40px;
        border: 2px solid rgb(49, 252, 127);
        border-radius: 30px;
    }
    .username{
        max-height: 20px;
        border: 1px solid #ccc;
    }
    .navbar ul li a{
        text-decoration: none;
    }
    .navbar ul li .sublink:hover{
        width: 100%;
        color: rgb(253, 252, 252);
        background: rgb(168, 77, 2);
    }
    #logout{
        color: black;
    }
    #logout:hover {
        color: #7e0404;
        text-transform: capitalize;
        font-size: 9pt;
        font-weight: 500;
    }
</style>
