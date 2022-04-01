
<template>
    <Dashboard >


                        <div class="form">
                            <div class="sidebar-item search-form " >
                                <form v-on:submit.prevent="searchJobs()" method="post">
                                    <input type="text" @keyup="searchJobs()" v-model="search" placeholder="Search for job" class="form-control">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->
                        </div>
                        <div class="card sidebar-rigth">
                            <div class="card-header">
                                <span class="card-title">Jobs you might like</span>
                            </div>
                        </div>
                        <div v-for="item in jobs" :key="item.id" class="card sidebar-rigth">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span @click="selectJob(item.title,item.id)" class="job-title"><b>{{ item.title }}</b></span>
                                    </div>
                                    <div class="col-md-5 widegets">
                                        <i v-if="!like" class="far fa-thumbs-down"></i>
                                        <i v-if="like" class="fas fa-thumbs-up text-success"></i>
                                        <i v-if="!love" class="fas fa-heart text-danger"></i>
                                        <i v-if="love" class="fas fa-heart text-info"></i>
                                    </div>
                                </div>
                                <div>
                                    {{ item.detail }}
                                </div>

                                <div class="row" style="margin-top:2%">
                                    <div class="col-md-4 certificate" >
                                        <i class="fas fa-certificate text-info"></i>
                                        Pagamento verificado
                                    </div>
                                    <div class="col-md-2" style="text-align: left;">
                                        <i class="fas fa-star text-success"></i>
                                        <i class="fas fa-star text-success"></i>
                                        <i class="fas fa-star text-success"></i>
                                        <i class="fas fa-star text-success"></i>
                                    </div>
                                    <div class="col-md-3 " style="text-align: left;">
                                        <i class="far fa-map"></i>
                                        <span class="certificate">{{ item.preferences }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


    </Dashboard>
</template>

<script>

    import Header from '../navbar/Header.vue';
    import Dashboard from "../website/DashboardUser.vue";
    import useVuelidate from '@vuelidate/core';
    import { required,email,string } from '@vuelidate/validators'
    import axios from 'axios';


    //const ax = require('axios');
    export default {
        components:{
            Header,
            Dashboard,
        },
        data(){
            return {
                search: null,
                showLoader:false,
                jobs:[],
                color:'',
                tabIndex: 0,
                like:false,
                love:false,
                selected:false,
            }
        },
        methods: {
            linkClass(idx) {
                if (this.tabIndex === idx) {
                return ['bg-primary', 'text-light']
                } else {
                return ['bg-light', 'text-info']
                }
            },
            selectJob(title,id){
                const myArray = title.split(" ");
                let i=0; let newTitle="";

                for(i=0;i<myArray.length;i++){
                    if(i==0){
                        newTitle = myArray[i];
                    }else{
                        newTitle = newTitle+"-"+myArray[i];
                    }
                }
                this.$router.push('/web/dashboard/job/'+newTitle.toLowerCase()+'/'+id)
                //console.log('Title: '+newTitle.toLowerCase())
            },
            async getAllJobs(){
                await axios.get('/jobs')
                    .then((res) => {
                        if(res.status == 200){
                            if(!res.data){
                            }else{
                                this.jobs = res.data;
                            }
                        }else{
                            console.log(res.data)
                        }
                    })
                    .catch((error) =>{
                        console.log(error);
                    });
            },
            async searchJobs(){
                if(this.search){
                    await axios.post('/select/jobs',{search: this.search })
                    .then((res) => {
                        if(res.status == 200){
                            if(res.data.length > 0){
                                this.jobs = res.data;
                            }
                        }else{
                            console.log(res.data)
                        }
                    })
                    .catch((error) =>{
                        console.log(error);
                    });
                }else{
                    this.getAllJobs();
                }
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
                    .catch((error) =>{
                        console.log(error);
                    });
            },
            abrirModal(){

            }

        },
        mounted(){
            this.checkSession();
            this.getAllJobs();
            this.username = localStorage.getItem('username');
            this.loggin = localStorage.getItem('loggin');

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
    border-bottom: 0px;
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

