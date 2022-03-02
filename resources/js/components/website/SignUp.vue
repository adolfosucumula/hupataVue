
<template>
    <body>
        <NavbarTop />
        <Header />

        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                <h2 data-aos="fade-up">Sign Up</h2>
                </div>

                <div class="row justify-content-center">

                <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up">
                    <div class="info-box">
                    <i class="bx bx-map"></i>
                    <h3>Sign Up</h3>
                    </div>
                </div>
                </div>

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
                <div class="col-xl-9 col-lg-12 mt-4">
                    <form v-on:submit.prevent="sendMessage()" method="post" role="form" class="php-email-form">
                    <div class="row">
                        <div class="col-md-6 form-group">
                        <input type="text" v-model="name" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="email" class="form-control" v-model="email" name="email" id="email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group ">
                                <input type="text" class="form-control" v-model="subject" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="text" class="form-control" v-model="subject" v-mask="'##/##/####'" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" v-model="message" name="message" rows="5" placeholder="Message" required></textarea>
                    </div>
                    <div v-if="showLoader" class="my-3"><img src="images/Ellipsis-1s-58px.gif" alt=""> </div>

                    <div class="text-center my-3"><button type="submit">Send Message</button></div>
                    </form>
                </div>

                </div>

            </div>
        </section>
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
