
<template>
    <body>
        <Header :username="username" :loggin="loggin" />

        <main id="main" style="background-color: #F1F2F4">

            <!-- ======= Blog Section ======= -->
            <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="sideba">
                            <h4 class="sidebar-title"></h4>
                            <div class="sidebar-item recent-posts">
                                <div class="card" style="border:0p">
                                    <div class="card-body">
                                        <div class="container text-center" >
                                            <div class="photo">
                                                <img class="user-photo" src="assets/img/team/team-1.jpg" alt="" >
                                            </div>
                                            <div class="name">
                                                <span><b>{{ username }}</b></span>
                                            </div>
                                            <div class="hability">
                                                <span>Full Stack Developer Web and Mobile</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="background-color: #E4EBE4">
                                    <div class="card-body">
                                        <div class="container text-center" >
                                            <div class="">
                                                <span>Profile state: </span><br>
                                                <span>...........</span> <span>100 %</span>
                                            </div>
                                            <div class="hability">
                                                <span>__..__</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End sidebar recent posts-->
                        </div><!-- End sidebar -->
                    </div><!-- End blog entries list -->

                    <div class="col-lg-8 entries">

                        <div class="entry-img">

                        </div>

                    </div><!-- End blog entries list -->

                </div>

            </div>
            </section><!-- End Blog Section -->

        </main><!-- End #main -->
    </body>
</template>

<script>

    import Header from '../navbar/Header.vue';
    import useVuelidate from '@vuelidate/core';
    import { required,email,string } from '@vuelidate/validators'
    import axios from 'axios';


    //const ax = require('axios');
    export default {
        components:{
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
                loggin: false,
                result:[],
            }
        },
        methods: {
            checkSession(){
                axios.get('/check/user-session')
                    .then((res) => {
                        if(res.status == 200){
                            if(!res.data.loggin){
                                this.$router.push('/webcontact/signin');
                            }else{
                                localStorage.setItem('loggin', res.data.loggin)
                                localStorage.setItem('email', res.data.user.email)
                                localStorage.setItem('status', res.data.user.status)
                                localStorage.setItem('level', res.data.user.level)
                            }
                        }else{
                            console.log(res.data)
                        }
                    })
                    .catch((error) =>{
                        console.log(error);
                    });
            },

        },
        mounted(){
            this.checkSession();
            this.username = localStorage.getItem('username');
            this.loggin = localStorage.getItem('loggin');

            //alert(localStorage.getItem('username'))
        }
    }
</script>
<style scoped>
.user-photo{
    max-width: 60px;
    max-height: 60px;
    border-radius: 30px;
}
.name{
    text-decoration: underline;
}
</style>

