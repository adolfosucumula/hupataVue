
<template>
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-up">Contact</h2>
        </div>

        <div class="row justify-content-center">

          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>Ilha Luanda, Luanda Street, Angola</p>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="100">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>devccodes@gmail.com<br>rocketmc2009@gmail.com</p>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="200">
            <div class="info-box">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>+244 939 000 287<br>+244 948 938 593</p>
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
                        <input type="text" class="form-control" v-model="cellphone" v-mask="['+(###) ### ### ###']" name="cellphone" id="cellphone" placeholder="Cellphone" required>
                    </div>
               </div>
              <div class="form-group mt-3">
                <textarea class="form-control" v-model="message" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="alert alert-danger text-center" v-if="showError">{{ errorMessage }}</div>
              <div class="alert alert-success text-center" v-if="showSuccess">Your message has been sent. Thank you!</div>
              <div v-if="showLoader" class="my- text-center"><img src="images/Ellipsis-1s-58px.gif" alt=""> </div>

              <div class="text-center my-3"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>
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
                cellphone: null,
                subject: null,
                message: null,
                showError:false,
                showSuccess:false,
                showLoader:false,
                errorMessage:null,
                results: [],
            }
        },
        methods: {
            sendMessage(){
                this.showLoader = true;
                this.results = axios.post('/webcontacts', {
                    name: this.name,
                    email: this.email,
                    cellphone: this.cellphone,
                    subject: this.subject,
                    message: this.message
                    })
                    .then((res) => {
                        if(res.status==200){
                            this.showSuccess=true;
                            this.showError=false;
                            this.clearFields();
                        }else{
                            this.showSuccess=false;
                            this.showError=true;
                            this.errorMessage = res.statusText;
                        }
                        this.showMessage('warn','Aviso','foo',res.status);
                        //this.$router.push('/lists');
                        console.log('Results: '+res.statusText);
                    })
                    .catch((error) =>{
                        this.showSuccess=false;
                        this.showError=true;
                        this.errorMessage = error;
                        console.log(error);
                    });
                this.showLoader = false;
            },

            showMessage(type='warn',title='Information',group='foo',sms){
            this.$notify({
                group: group,
                type: type,
                title: title,
                text: sms
            });
            },

            clearFields(){
                this.name =null;
                this.email =null;
                this.cellphone =null;
                this.subject =null;
                this.message =null;
            }

        }
    }
</script>
