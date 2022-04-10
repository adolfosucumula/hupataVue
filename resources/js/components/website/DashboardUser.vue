
<template>
    <body>
        <Header :username="username" :loggin="loggin" />

        <main id="main" style="background-color: #F1F2F4">

            <!-- ======= Blog Section ======= -->
            <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <SideBar />

                    <div class="col-lg-8 entries">

                        <slot class="dasboard-slot-pages">
                            <div class="form">
                                <div class="sidebar-item search-form " >
                                    <form v-on:submit.prevent="search()" method="post">
                                        <input type="text" v-model="search" placeholder="Search for job" class="form-control">
                                        <button type="submit"><i class="bi bi-search"></i></button>
                                    </form>
                                </div><!-- End sidebar search formn-->
                            </div>

                            <div class="card sidebar-rigth">
                                <div class="card-header">
                                    <span class="card-title">Jobs you might like</span>
                                </div>
                                <div class="card-body menu-job">
                                    <div class="navigation">
                                        <ul>
                                            <li class="list active">
                                                <a href="javascript:void(0);" id="link" @click="showComp('posted')"  title="Posted Jobs">
                                                    <span class="fas fa-home icon"></span>
                                                    <span class="text">Posted Jobs</span>
                                                </a>
                                            </li>
                                            <li class="list">
                                                <a href="javascript:void(0);" @click="showComp('saved')" title="Saved Jobs">
                                                    <span class="fas fa-home icon"></span>
                                                    <span class="text">Saved Jobs</span>
                                                </a>
                                            </li>
                                            <li class="list">
                                                <a href="javascript:void(0);" @click="showComp('finalized')" title="Finalized Jobs">
                                                    <span class="fas fa-home icon"></span>
                                                    <span class="text">Finalized Jobs</span>
                                                </a>
                                            </li>
                                            <li class="list">
                                                <a href="javascript:void(0);" @click="showComp('current')" title="Current Jobs">
                                                    <span class="fas fa-home icon"></span>
                                                    <span class="text">Current Jobs</span>
                                                </a>
                                            </li>
                                            <div class="indicator"></div>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div v-if="showComponent=='posted'"><PostedJobs /></div>
                            <div v-if="showComponent=='saved'"> <SavedJobs /></div>
                            <div v-if="showComponent=='finalized'">Finalized Jobs</div>
                            <div v-if="showComponent=='current'">Current Jobs</div>
                        </slot>

                    </div><!-- End blog entries list -->

                </div>

            </div>
            </section><!-- End Blog Section -->

        </main><!-- End #main -->
    </body>
</template>

<script>

    import Header from '../navbar/Header.vue';
    import SideBar from '../navbar/SideBar.vue';
    import SavedJobs from '../website/SavedJobs.vue';
    import PostedJobs from '../website/PostedJobs.vue';
    import useVuelidate from '@vuelidate/core';
    import { required,email,string } from '@vuelidate/validators'
    import axios from 'axios';


    //const ax = require('axios');
    export default {
        components:{
            Header,
            SideBar,
            SavedJobs,
            PostedJobs,
        },
        data(){
            return {
                user_id:null,
                search: null,
                showLoader:false,
                loggin: false,
                result:[],
                color:'',
                tabIndex: 0,
                showComponent:'posted'
            }
        },
        methods: {
            async search(){

            },
            linkClass(idx) {
                if (this.tabIndex === idx) {
                return ['bg-primary', 'text-light']
                } else {
                return ['bg-light', 'text-info']
                }
            },
            checkSession(){
                axios.get('/check/user-session')
                    .then((res) => {
                        if(res.status == 200){
                            if(!res.data.loggin){
                                this.$router.push('/webcontact/signin');
                            }else{
                                localStorage.setItem('userID', res.data.user.id)
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
            showComp(comp){
                this.showComponent = comp
                /* Navigaion Control  */
                const list = document.querySelectorAll('.list');
                function activeLink(){
                    list.forEach((item) =>
                    item.classList.remove('active'));
                    this.classList.add('active');
                }
                list.forEach((item) =>
                item.addEventListener('click', activeLink ));

            }

        },
        mounted(){
            this.checkSession();

            this.user_id = localStorage.getItem('userID');
            this.username = localStorage.getItem('username');
            this.loggin = localStorage.getItem('loggin');
        }
    }




</script>
<style scoped>
    :root{
        --clr: #222327;
    }
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


 /* Magic Navigation Indicator CSS code */
/*
      .navigation{
          width: 600px;
          height: 70px;
          background: #fff;
          position: relative;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 10px;
      }
      .navigation ul{
          display: flex;
          width: 500px;
      }
      .navigation ul li{
          position: relative;
          list-style: none;
          width: 200px;
          height: 70px;
          z-index: 1;
      }
      .navigation ul li a{
          color: #000;
          position: relative;
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: column;
          width: 100%;
          text-align: center;
          font-weight: 500;
      }
      .navigation ul li a .icon{
            position: relative;
            display: block;
            line-height: 75px;
            font-size: 1.5em;
            text-align: center;
            transition: 0.5s;
            color: var(--clr);
      }
      .navigation ul li.active a .icon{
          transform: translateY(-32px);
          color: #fff;
          font-size: 1.7em;
      }
      .navigation ul li a .text{
          position: absolute;
          color: var(--clr);
          font-weight: bold;
          font-size: 0.75em;
          letter-spacing: 0.05em;
          transition: 0.5s;
          opacity: 0;
          transform: translateY(20px);
      }

       .navigation ul li.active a .text{
          opacity: 1;
          transform: translateY(10px);
          top: 38%;
      }
      .indicator{
          position: absolute;
          top: -40%;
          left: 9.5%;
          width: 65px;
          height: 65px;
          background: #2194ff;
          border: 6px solid #0A2A50;
          border-radius: 50%;
          transition: 0.5s;
      }
      .indicator::before{
          content: '';
          position: absolute;
          top: 42%;
          left: -22px;
          width: 20px;
          height: 20px;
          background: transparent;
          border-top-right-radius: 25px;
          box-shadow: 0px -10px 0 0 #0A2A50;
      }
        .indicator::after{
          content: '';
          position: absolute;
          top: 42%;
          right: -22px;
          width: 20px;
          height: 20px;
          background: transparent;
          border-top-left-radius: 25px;
          box-shadow: 0px -10px 0 0 #0A2A50;
        }

        .navigation ul li:nth-child(1).active ~ .indicator
        {
            transform: translateX(calc(150px * 0));

        }
        .navigation ul li:nth-child(2).active ~ .indicator
        {
            transform: translateX(calc(150px * 1));
            left: 5.5%;
        }
        .navigation ul li:nth-child(3).active ~ .indicator
        {
            transform: translateX(calc(150px * 2));
            left: 1.4%;
        }
        .navigation ul li:nth-child(4).active ~ .indicator
        {
            transform: translateX(calc(150px * 3));
            left: -3%;
        }

        */

</style>

