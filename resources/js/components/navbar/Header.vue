
<template>
    <header id="header" class="d-flex align-items-center" style="background-color: 1D4354">
            <div class="container d-flex align-items-center justify-content-between">

                <div class="logo">
                    <h1 v-if="loggin"><router-link to="/web/user/dashboard" style="font-family: 'Pacifico', cursive; color: #492703">FreelancerANG </router-link></h1>
                    <h1 v-if="!loggin"><router-link to="/" style="font-family: 'Pacifico', cursive; color: #492703">FreelancerANG</router-link></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
                </div>

                <nav id="navbar" class="navbar">
                    <ul>
                    <li class="dropdown"><a class="nav-link scrollto " href="javascript:;"><span>Search Talents</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><router-link to="/" style="color: #000">Post a Job</router-link></li>
                            <li><router-link to="/" style="color: #000">Browse and buy Projects</router-link></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link scrollto " href="javascript:;"><span>Search Works</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><router-link to="/" style="color: #000">Find work for your skils</router-link></li>
                        </ul>
                    </li>
                    <li><router-link class="nav-link scrollto " to="/web/dashboard/jobs">Search Jobs</router-link></li>
                    <li><a class="nav-link scrollto" href="#projects">Posted Projects</a></li>
                    <li v-if="!loggin"><router-link class="nav-link scrollto" to="/webcontact/form" > Contacts </router-link></li>
                    <li v-if="loggin" class="dropdown ">
                        <a class="nav-link scrollto " href="javascript:;"> {{username}} <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><router-link to="/" style="color: #000">Setting</router-link></li>
                            <li v-if="loggin"><router-link class="nav-link scrollto" to="/web/user/logout" >
                                <i class="fa fa-power-off text-danger"></i> Logout </router-link>
                            </li>
                        </ul>
                    </li>
                    <li v-if="loggin" class="scrollto">
                        <a href="javascript:;" class="nav-link"><img class="user-photo" src="assets/img/team/team-1.jpg" alt="" ></a>
                    </li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
            </div>
        </header>
</template>
<script>
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
    setup() {

    },
    props:  {
            username: '',
            loggin: false,
        },
    data(){
        return {
            userphoto: '',
        }
    },
    mounted(){
        this.userphoto = 'assets/img/team/team-1.jpg';

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
</style>
