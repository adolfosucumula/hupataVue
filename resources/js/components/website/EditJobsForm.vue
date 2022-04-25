
<template>
    <Dashboard>
                        <div class="form">
                            <div class="sidebar-item search-form " >
                                ............
                            </div><!-- End sidebar search formn-->
                        </div>
                        <form v-on:submit.prevent="postJob()" method="post" role="form" class="form-post">
                            <div class="card sidebar-rigth">
                                <div class="card-header">
                                    <span class="card-title">Post a Job and get help with our best talents</span>
                                </div>
                            </div>
                            <div class="card sidebar-rigth">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <span>Title <span class="text-danger">*</span></span>
                                        <input type="text" v-model="title" placeholder="Title" required class="form-control">
                                        <span v-if="e_title" class="text-center text-danger">{{e_title}}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <span>Describe your job <span class="text-danger">*</span></span>
                                        <textarea class="form-control" v-model="detail" name="message" rows="5" placeholder="Describe here wath you need" required></textarea>
                                        <span v-if="e_detail" class="text-center text-danger">{{e_detail}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card sidebar-rigth">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <span>Requirements <span class="text-danger">*</span></span><br>
                                        <input type="text" @keyup="searchSubcategoryKnowledge()" v-model="requirements" required placeholder="Select requirements" class="form-control">
                                        <span v-if="e_requirements" class="text-center text-danger">{{e_requirements}}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <span>Time required <span class="text-danger">*</span></span><br>
                                        <input type="text" v-model="timerequired" v-mask="['###']" required placeholder="Time requirement" class="form-control">
                                        <span v-if="e_timerequired" class="text-center text-danger">{{e_timerequired}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card sidebar-rigth">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span>Tax per hour <span class="text-danger">*</span></span>
                                            <input type="text" v-model="taxperhour" ref="inputRef" @keyup="calcTotalTax()" required placeholder="$" class="form-control">
                                            <span v-if="e_taxperhour" class="text-center text-danger">{{e_taxperhour}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span>Total <span class="text-danger">*</span></span>
                                            <input type="text" v-model="totaltax" required placeholder="$" class="form-control">
                                            <span v-if="e_totaltax" class="text-center text-danger">{{e_totaltax}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card sidebar-rigth">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span>Currency <span class="text-danger">*</span></span>
                                            <input type="text"  v-model="currency" required readonly placeholder="$" class="form-control">
                                            <span v-if="e_currency" class="text-center text-danger">{{e_currency}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span>Preference City/country</span>
                                            <input type="text" v-model="preferences" placeholder="$" class="form-control">
                                            <span v-if="e_preferences" class="text-center text-danger">{{e_preferences}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card sidebar-rigth">
                                <div class="card-body">
                                    <div class="row">
                                        <button class="btn btn-success"><i class="far fa-hand-point-up"></i> Submit</button>
                                    </div>
                                    <br>
                                    <div v-if="error" class="text-center text-danger">{{error}}</div>
                                </div>
                            </div>
                        </form>
    </Dashboard>
</template>

<script>

    import Dashboard from "../website/DashboardUser.vue";
    import useVuelidate from '@vuelidate/core';
    import { required,email,string } from '@vuelidate/validators'
    import axios from 'axios';
 import { useCurrencyInput } from 'vue-currency-input'

    //const ax = require('axios');
    export default {
        components:{
            Dashboard,
        },
        props: {
            modelValue: Number, // Vue 2: value
            options: Object
        },
        setup(props) {
            const { inputRef } = useCurrencyInput(props.options)
            return { inputRef }
        },
        data(){
            return {
                id: null,
                title: '',
                detail:'',
                requirements:'',
                timerequired:'',
                taxperhour:'',
                totaltax:'',
                currency:'AOA',
                preferences:'',
                search: null,
                showLoader:false,
                subcategoryKnowledges:[],
                selected:false,
                error:'',
                e_title:'',
                e_detail:'',
                e_requirements:'',
                e_timerequired:'',
                e_taxperhour:'',
                e_totaltax:'',
                e_currency:'',
                e_preferences:'',
            }
        },
        methods: {
            async viewJobs(){
                if(this.$route.params.id){
                    await axios.post('/view/jobs',{id: this.$route.params.id,title: this.$route.params.title })
                    .then((res) => {
                        if(res.status == 200){
                            if(res.data.length > 0){
                                this.title = res.data[0].title
                                this.detail = res.data[0].detail
                                this.requirements = res.data[0].requirements
                                this.timerequired = res.data[0].time_required
                                this.taxperhour = res.data[0].tax_per_hour
                                this.totaltax = this.taxperhour * this.timerequired
                                this.preferences = res.data[0].preferences
                            }
                        }else{
                            console.log(res.data)
                        }
                    })
                    .catch((error) =>{
                        console.log(error);
                    });
                }else{

                }
            },
            async postJob(){
                await axios.put('/jobs/' + this.id,{
                    title: this.title,
                    detail: this.detail,
                    requirements: this.requirements,
                    tax_per_hour: this.taxperhour,
                    total_tax: this.totaltax,
                    currency: this.currency,
                    preferences: this.preferences,
                    time_required: this.timerequired
                    })
                .then((res) => {
                        if(res.status == 200){
                            if(res.data.update){
                               this.clearFields();
                               this.$router.push('/web/dashboard/jobs');
                            }else{
                                console.log(res.data)
                            }
                        }else{
                            console.log(res.data)
                        }
                    })
                .catch((e) =>{ console.log(e.response.data);
                    this.getRequestErrors(e.response.data.errors);
                    this.error = e.response.data.error_message
                    if(!e.response.data.update){
                        //this.error = e.response.data.errors.errorInfo[2];
                    }else {
                        //this.error = e.response.data.message;
                        console.log('Error'+e.response.data.message)
                    }
                });

            },
            async searchSubcategoryKnowledge(){
                await axios.post('/sub-category-knowledges/select',{search: this.requirements })
                .then((res) => {
                        if(res.status == 200){
                            if(res.data.length > 0){
                                res.data;
                            }
                        }else{
                            console.log(res.data)
                        }
                    })
                .catch((e) =>{
                        console.log(e);
                });

            },
            getAllSubcategoryKnowledges(){
                axios.get('/category-knowledges')
                    .then((res) => {
                        if(res.status == 200){
                            this.subcategoryKnowledges = res.data;
                        }else{
                            console.log(res.data)
                        }
                    })
                    .catch((e) =>{
                        console.log(e);
                    });
            },
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
                                localStorage.setItem('currency', res.data.settings[0].currency)
                                localStorage.setItem('app_tax_percent', res.data.settings[0].app_tax_percent)
                            }
                        }else{
                            console.log(res.data)
                        }
                    })
                    .catch((e) =>{
                        console.log(e);
                    });
            },
            getRequestErrors(errors){

                try {
                    if(errors.title){ this.e_title = errors.title[0] }else{
                        this.e_title=''
                        this.error = errors.errorInfo[0]
                    }
                    if(errors.detail){ this.e_detail = errors.detail[0]; }else{this.e_detail=''}
                    if(errors.requirements){ this.e_requirements = errors.requirements[0]; }else{this.e_requirements=''}
                    if(errors.tax_per_hour){ this.e_taxperhour = errors.tax_per_hour[0]; }else{this.e_taxperhour=''}
                    if(errors.total_tax){ this.e_totaltax = errors.total_tax[0]; }else{this.e_totaltax=''}
                    if(errors.time_required){ this.e_timerequired = errors.time_required[0]; }else{this.e_timerequired=''}
                    if(errors.currency){ this.e_currency = errors.currency[0]; }else{this.e_currency=''}
                    if(errors.preferences){ this.e_preferences = errors.preferences[0]; }else{this.e_preferences=''}
                } catch (ex) {  }
            },
            calcTotalTax(){
                this.totaltax = this.timerequired * this.taxperhour;
            },
            clearFields(){
                this.title =null;
                this.detail =null;
                this.requirements =null;
                this.taxperhour =null;
                this.totaltax =null;
                this.timerequired =null,
                this.currency ='AOA'
                this.preferences =null

                this.e_title =null;
                this.e_detail =null;
                this.e_requirements =null;
                this.e_timerequired =null;
                this.e_taxperhour =null;
                this.e_totaltax =null
                this.e_currency =null
                this.e_preferences =null
                this.error =null;
                this.notifmsg = null;
            },

        },
        mounted(){
            this.id = this.$route.params.id;
            this.checkSession();
            this.getAllSubcategoryKnowledges();
            this.viewJobs();
        }
    }
</script>
<style scoped>
    .widegets{
        text-align: right;
    }
    .job-title{ cursor: pointer; color: rgb(48, 136, 7); }
    .job-title:hover{color: #0A2A50;}
    .certificate{ color: rgb(122, 122, 121); font-size: 11pt;}
    .user-photo{
        max-width: 80px;
        max-height: 80px;
        border-radius: 40px;
    }
    .name{
        text-decoration: underline;
    }

    .blog .sideba {
    padding: 0px;
    margin: 0 0 60px 20px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }
    .blog .form {
    padding: 0px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }
    .tab{
        background-color: #012a50;
        border-bottom: 0px;
    }

.sidebar-rigth{
    border-radius: 0px 0px 0px 0px;
}

.card-title{
    font-weight: bold;
    font-size: 1.3em;
    color: #fff;
}
.card-header{
    padding: 4px;
    background-color: #012a50;
    border-bottom: 1px;
}
.menu{
    position: absolute;
    display: block;
    margin-top: 1%;
    background: #012a50;
}

.menu .title{
    padding: 0%;
    margin-left: 0%;
    text-decoration: none;
    color: #ddd;
}
.menu-job{
    background-color: #012a50;
}
.blog .sideba .sidebar-title {
  font-size: 20px;
  font-weight: 700;
  padding: 0 0 0 0;
  margin: 0 0 15px 0;
  color: #473d3a;
  position: relative;
}
.blog .sideba .sidebar-item {
  margin-bottom: 30px;
}
.sidebar-item {
  margin-bottom: 30px;
}

.blog .sideba .search-form form {
  background: #fff;
  border: 1px solid #ddd;
  padding: 3px 10px;
  position: relative;
}
form {
  background: #fff;
  border: 1px solid #ddd;
  padding: 3px 10px;
  position: relative;
}
.form-post {
    background: #F1F2F4;
    border: 0;
}
.blog .sideba .search-form form input[type=text] {
  border: 0;
  padding: 4px;
  border-radius: 4px;
  width: calc(100% - 40px);
}
form input[type=text] {
  border: 0;
  padding: 4px;
  border-radius: 4px;
  width: calc(100% - 40px);
  font-size: 0.9em;
}
.form-post input[type=text] {
  border: 1px solid #ccc;
  padding: 4px;
  border-radius: 0px;
  width: calc(100% - 40px);
  font-size: 0.9em;
}
.form-post textarea{
    border-radius: 0;
}
.blog .sideba .search-form form button {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  border: 0;
  background: none;
  font-size: 16px;
  padding: 0 15px;
  margin: -1px;
  background: #2194ff;
  color: #fff;
  transition: 0.3s;
  border-radius: 0 4px 4px 0;
  line-height: 0;
}
.search-form form button {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  border: 0;
  background: none;
  font-size: 16px;
  padding: 0 15px;
  margin: -1px;
  background: #2194ff;
  color: #fff;
  transition: 0.3s;
  border-radius: 0 4px 4px 0;
  line-height: 0;
}
.blog .sideba .search-form form button i {
  line-height: 0;
}
.search-form form button i {
  line-height: 0;
}
.blog .sideba .search-form form button:hover {
  background: #ff6735;
}
.search-form form button:hover {
  background: #35ff72;
}
.search-form form button i:hover {
    font-size: 1.3em;
}

nav{
    position: relative;
  padding-bottom: 12px;
}
.line
    {
        height: 2px;
        position: absolute;
        bottom: 0;
        margin: 10px 0 0 0;
        background: #FF1847;
    }


  ul{
      padding: 0;
    margin: 0;
    list-style: none;
    display: flex;
  }

    li{
        margin: 0 40px 0 0;
      opacity: .4;
      transition: all 0.4s ease;
    }

      li:hover{
          opacity: .7;
      }

      li .active{
          opacity: 1
      }

      li:last-child{
          margin-right: 0;
      }

      a{
          text-decoration: none;
        color: #fff;
        text-transform: uppercase;
        display: block;
        font-weight: 600;
        letter-spacing: .2em;
        font-size: 14px;
      }

</style>

