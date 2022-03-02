

<template>

    <section id="testimonials" class="testimonials">
      <div class="container position-relative" data-aos="fade-up">
          <h2 class="text-danger"><i class="fa-power-off "></i> Logout System</h2>
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
            }
        },
        created(){
            axios.get('/logout/system').then((res) =>{
                    if(res.status != 200){
                        if(!res.data.loggin){
                            this.$router.push('/');
                            localStorage.setItem('loggin',false);
                            localStorage.removeItem('username');
                            localStorage.removeItem('email');
                        }
                    }else{
                        if(!res.data.loggin){
                            this.$router.push('/');
                        }
                    }
                }).catch((error) => {
                    console.log(error.response.data)
            })

        }
    }
</script>
