
<template>

    <section id="testimonials" class="testimonials">
      <div class="container position-relative" data-aos="fade-up">

        <div class="row " data-aos="fade-up" >
            <div class="col-xl-4 col-lg-5 mt-4" data-aos="fade-up" style="background-color: #0bd604;border:1px solid #0bd604;border-radius:4px;">
                <span class="text-white">Make Login</span>
                <h2>Start Now</h2>
            </div>
            <div class="col-xl-6 col-lg-7 mt-4 justify-content-center" data-aos="fade-up"  style="background-color:#fff;border:1px solid #fff;border-radius:4px;margin-left:2%">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up">
                        <div class="info-box">
                        <i class="bx bx-user" style="font-size:2em;color: #ccc"></i>
                        </div>
                    </div>
                </div>
                    <form v-on:submit.prevent="sendMessage()" method="post" role="form" class="php-email-form">
                            <div class="">
                                <div class="col-md-12 form-group">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <i class="bx bx-envelop"></i>
                                            <input type="email" v-model="name" name="name" class="form-control" id="name" placeholder="Your Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group mt-3 mt-md-0">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <i class="bx bx-ke"></i>
                                            <input type="password" class="form-control" v-model="email" name="password" id="password" placeholder="Your password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="showLoader" class="my-3"><img src="images/Ellipsis-1s-58px.gif" alt=""> </div>

                            <div class="text-center my-3"><button class="btn btn-info btn-bordered " type="submit">Send Message</button></div>
                    </form>

            </div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->


</template>

<script>

    import useVuelidate from '@vuelidate/core';
    import { required,email,string } from '@vuelidate/validators'
    import axios from 'axios';


    //const ax = require('axios');
    export default {
        components:{
        },
        data(){
            return {
                name: null,
                email: null,
                subject: null,
                message: null,
                showLoader:false,
                results: [],
            }
        },
        methods: {
            sendMessage(){
                this.showLoader = true;
                this.results = axios.post('/webcontacts', {
                    name: this.name,
                    email: this.email,
                    subject: this.subject,
                    message: this.message
                    })
                    .then((response) => {
                        this.clearFields();
                        //this.$router.push('/lists');
                        //console.log('Results: '+this.results);
                    })
                    .catch((error) =>{
                        console.log(error);

                    });
                this.showLoader = false;
            },

            clearFields(){
                this.name =null;
                this.email =null;
                this.subject =null;
                this.message =null;
            }

        }
    }
</script>
