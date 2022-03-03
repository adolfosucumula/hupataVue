
<template>
    <body>
        <NavbarTop />

        <Header />

        <section id="testimonials" class="testimonials">
            <div class="container position-relative" data-aos="fade-up">

                <div class="row " data-aos="fade-up" >
                    <div class="col-xl-4 col-lg-5 mt-4" data-aos="fade-up" style="background-color: #0bd604;border:1px solid #0bd604;border-radius:4px;">
                        <span class="text-white">Make Login</span>
                        <h2>Start Now </h2>
                    </div>
                    <div class="col-xl-6 col-lg-7 mt-4 justify-content-center" data-aos="fade-up"  style="background-color:#fff;border:1px solid #fff;border-radius:4px;margin-left:2%">
                        <div class="container">
                            <div class="col-md-5" style="margin: 0 auto;">
                                <div class="row justify-content-center">
                            <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up">
                                <div class="info-box">
                                <i class="bx bx-user" style="font-size:2em;color: #ccc"></i>
                                </div>
                            </div>
                        </div>
                            <form v-on:submit.prevent="login()" method="post" role="form" class="php-email-form">
                                    <div class="">
                                        <div class="col-md-12 form-group">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <i class="bx bx-envelop"></i>
                                                    <input type="email" v-model="username" name="username" class="form-control" id="name" placeholder="Your Email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group mt-3 mt-md-0">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <i class="bx bx-ke"></i>
                                                    <input type="password" class="form-control" v-model="password" name="password" id="password" placeholder="Your password" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="failed" class="my-3 text-danger">Username or password wrang...</div>
                                    <div v-if="showLoader" class="my-3 text-center"><img src="images/Ellipsis-1s-58px.gif" alt=""> </div>

                                    <div class="text-center my-3">
                                        <button class="btn btn-info btn-bordered " type="submit">Send Message</button>
                                        <b-button variant="primary" disabled>
                                            <b-spinner small type="grow"></b-spinner>
                                            Loading...
                                        </b-button>
                                    </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->
    </body>
</template>

<script>

    import useVuelidate from '@vuelidate/core';
    import { required,email,string } from '@vuelidate/validators'
    import axios from 'axios';

    import NavbarTop from '../navbar/NavBarTop.vue';
    import Header from '../navbar/Header.vue';

    export default {
        components:{
            NavbarTop,
            Header,
        },
            data(){
            return {
                username: null,
                password: null,
                message: null,
                failed: false,
                showLoader:false,
                isLogging: false,
                result:[],
            }
        },
        methods: {
            async login(){
                this.showLoader = true;

                axios.post('/login',{username: this.username, password: this.password})
                    .then((res) => {
                        if(res.status == 200){
                            this.clearFields();
                            this.failed = false;
                            this.checkSession();

                        }else{
                            this.failed = true;
                        }
                        this.showLoader = false;
                    })
                    .catch((error) =>{
                        console.log(error);
                        this.showLoader = false;
                        this.failed = true;
                    });
            },

            checkSession(){
                this.showLoader = true;
                axios.get('/check/user-session')
                    .then((res) => { console.log(res.data.user)
                        if(res.status == 200){
                            if(res.data.loggin){
                                localStorage.setItem('loggin', res.data.loggin)
                                localStorage.setItem('email', res.data.user.email)
                                localStorage.setItem('status', res.data.user.status)
                                localStorage.setItem('level', res.data.user.level)
                                this.$router.push('/web/user/dashboard');
                            }
                            this.showLoader = false;
                        }else{
                            console.log(res.data)
                        }
                    })
                    .catch((error) =>{
                        console.log(error);
                        this.showLoader = false;
                    });
            },

            clearFields(){
                this.username =null;
                this.password =null;
                this.message =null;
            }

        },
        mounted(){
            this.checkSession()

        }
    }
</script>
