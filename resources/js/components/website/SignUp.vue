
<template>
    <body>
        <NavbarTop />
        <Header />

        <section id="contact" class="contact">
            <div class="container">
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
                    <form v-on:submit.prevent="saveDatas()" method="post" role="form" class="php-email-form">

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" v-model="username" name="username" class="form-control" id="username" placeholder="Userame: @jhonny" required>
                            <span v-if="user_error" class="text-center text-danger">{{user_error}}</span>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" v-model="email" name="email" id="email" placeholder="Your Email" required>
                            <span v-if="email_error" class="text-center text-danger">{{email_error}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group ">
                            <label for="username">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" v-model="password"  name="password" id="password" placeholder="Password" required>
                            <span v-if="pass_error" class="text-center text-danger">{{pass_error}}</span>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label for="confirm">Confirm password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" v-model="confPassword"  name="confPassword" id="confPassword" placeholder="Confirm" required>
                            <span v-if="confP_error" class="text-center text-danger">{{confP_error}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group ">
                            <label for="photo">Photo </label>
                            <input type="file" @change="handleOnChange" class="form-control"  name="photo" id="photo" >
                            <span v-if="photo_error" class="text-center text-danger">{{photo_error}}</span>
                        </div>
                    </div>
                    <div v-if="showLoader" class="my-3"><img src="images/Ellipsis-1s-58px.gif" alt=""> </div>
                    <div class="text-center my-3"><button type="submit">Send Message</button></div>

                    </form>
                    <div v-if="errorMessage" class="text-center error-message">
                        <span class="text-danger">{{ errorMessage }}</span>
                    </div>
                    <!--               -->
                    <div class="text-center" v-for="err in notifmsg" :key="err">
                        <span class="text-danger">{{ err  }} </span>
                    </div>
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
                username: null,
                email: null,
                message: null,
                password:null,
                confPassword:null,
                photo: '',
                showLoader: false,
                notifmsg: '',
                user_error:'',
                email_error:'',
                pass_error:'',
                confP_error:'',
                photo_error:'',
                errorMessage:null,
            }
        },
        methods: {
            handleOnChange(e){
                try {
                    this.photo = e.target.files[0];
                } catch (error) {

                }
            },
            async saveDatas(){
                this.showLoader = true;
                const formData = new FormData;
                formData.set('photo', this.photo);
                formData.set('username', this.username);
                formData.set('email', this.email);
                formData.set('level', 'freelancer');
                formData.set('password', this.password);
                formData.set('confPassword', this.confPassword);
                formData.set('status', '0');
                await axios.post('/users', formData )
                    .then((res) => {
                        if(res.status == 200){
                            //this.$router.push('/lists');
                            if(res.data.save){
                                this.clearFields();
                            }else{
                                this.errorMessage = res.data.error.errorInfo
                                this.notifmsg = res.data.error.errorInfo
                            }
                            console.log(res.data)
                        }else{
                            this.errorMessage = res.data
                        }
                    })
                    .catch((e) =>{
                        this.notifmsg = e.response.data
                        this.getRequestErrors(e.response.data.errors);
                        console.log('Error: ' + e.response.data.toJSON())

                    });
                this.showLoader = false;
            },
            getRequestErrors(errors){
                try {
                    if(errors.username){ this.user_error = errors.username[0] }else{this.user_error=''}
                    if(errors.email){ this.email_error = errors.email[0]; }else{this.email_error=''}
                    if(errors.password){ this.pass_error = errors.password[0]; }else{this.pass_error=''}
                    if(errors.confPassword){ this.confP_error = errors.confPassword[0]; }else{this.confP_error=''}
                    if(errors.photo){ this.photo_error = errors.photo[0]; }else{this.photo_error=''}
                } catch (error) {
                }
            },
            clearFields(){
                this.username = null;
                this.email = null;
                this.password = null;
                this.confPassword = null;
                this.photo = null;
                this.user_error=null;
                this.email_error=null;
                this.pass_error=null;
                this.confP_error=null;
                this.photo_error=null;
                this.errorMessage =null;
                this.notifmsg =null;
            },
            showMessage(type='warn',title='Information',group='foo',sms){
                this.$notify({
                    group: group,
                    type: type,
                    title: title,
                    text: sms
                });
            },

        },
        mounted(){
            this.showMessage('warn','Information','foo',"mmmm");
        }
    }
</script>
