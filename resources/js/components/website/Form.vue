
<template>
    <body>
        <NavbarTop />
        <Header />
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
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" v-model="name" name="name" class="form-control" id="name" placeholder="Your Name" required>
                    <span v-if="e_name" class="text-center text-danger">{{e_name}}</span>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" v-model="email" name="email" id="email" placeholder="Your Email" required>
                    <span v-if="e_name" class="text-center text-danger">{{e_email}}</span>
                </div>
              </div>
               <div class="row">
                   <div class="col-md-6 form-group ">
                        <label for="subject">Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="subject" name="subject" id="subject" placeholder="Subject" required>
                        <span v-if="e_subject" class="text-center text-danger">{{e_subject}}</span>
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <label for="cellphone">Cellphone </label>
                        <input type="text" class="form-control" v-model="cellphone" v-mask="['+(###) ### ### ###']" name="cellphone" id="cellphone" placeholder="Cellphone" >
                        <span v-if="e_cellphone" class="text-center text-danger">{{e_cellphone}}</span>
                    </div>
               </div>
              <div class="form-group mt-3">
                    <label for="message">Message <span class="text-danger">*</span></label>
                    <textarea class="form-control" v-model="message" name="message" rows="5" placeholder="Message" required></textarea>
                    <span v-if="e_message" class="text-center text-danger">{{e_message}}</span>
              </div>
              <div class="alert alert-success text-center" v-if="showSuccess">Your message has been sent. Thank you!</div>
              <div v-if="showLoader" class="my- text-center"><img src="images/Ellipsis-1s-58px.gif" alt=""> </div>

              <div class="text-center my-3"><button type="submit">Send Message</button></div>
                <div v-if="errorMessage" class="text-center error-message">
                    <span class="alert alert-danger">{{ errorMessage }}</span><br>
                </div>
                    <!--               -->
                <div class="alert alert-danger" v-for="err in notifmsg" :key="err">
                    <span class="text-danger">{{ err  }} </span>
                </div>
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
                cellphone: null,
                subject: null,
                message: null,
                showError:false,
                showSuccess:false,
                showLoader:false,
                errorMessage:null,
                results: [],
                loggin: false,
                notifmsg:'',
                e_name:null,
                e_email:null,
                e_cellphone:null,
                e_subject:null,
                e_message:null,
            }
        },
        methods: {
            async sendMessage(){
                this.showLoader = true;
                await axios.post('/webcontacts', {
                    name: this.name,
                    email: this.email,
                    cellphone: this.cellphone,
                    subject: this.subject,
                    message: this.message
                    })
                    .then((res) => {
                        if(res.status==200){
                            if(res.data.saved){
                                this.showSuccess=true;
                                this.showError=false;
                                this.clearFields();
                            }else{
                                this.errorMessage = res.data.error
                                this.notifmsg = res.data.errors
                            }
                        }else{
                            this.showSuccess=false;
                            this.showError=true;
                            this.errorMessage = res.data.error
                        }

                        console.log(res.data.error)
                        //this.$router.push('/lists');
                        this.showLoader = false;
                    })
                    .catch((e) =>{ console.log('Results: '+e.response.data.errors)
                        this.showLoader = false;
                        this.showSuccess=false;
                        this.showError=true;
                        this.errorMessage = e;
                        this.notifmsg = e.response.data
                        this.getRequestErrors(e.response.data.errors);

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
                this.e_name =null;
                this.e_email =null;
                this.e_cellphone =null;
                this.e_subject =null;
                this.e_message =null;
                this.errorMessage =null;
                this.notifmsg = null;
            },
            getRequestErrors(errors){
                try {
                    if(errors.name){ this.e_name = errors.name[0] }else{this.e_name=''}
                    if(errors.email){ this.e_email = errors.email[0]; }else{this.e_email=''}
                    if(errors.cellphone){ this.e_cellphone = errors.cellphone[0]; }else{this.e_cellphone=''}
                    if(errors.subject){ this.e_subject = errors.subject[0]; }else{this.e_subject=''}
                    if(errors.message){ this.e_message = errors.message[0]; }else{this.e_message=''}
                } catch (error) {
                }
            },
            checkSession(){
                axios.get('/check/user-session')
                    .then((res) => {
                        if(res.status == 200){
                            if(res.data.loggin){
                                this.$router.push('/web/user/dashboard');
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

        }
    }
</script>
