<template>
    <div class="col-lg-4">
                        <div class="card" style="border-radius: 4px 4px 0px 0px">
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
                                                <a href="">Logout</a>
                                            </div>

                                            <router-link id="logout" to="/web/user/logout" >
                                            <i class="fa fa-power-off text-danger"></i> Logout </router-link>
                                        </div>
                            </div>
                        </div>
                        <div class="card" style="background-color: #E4EBE4;border-radius: 0px 0px 0px 0px">
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
                        <div class="card" style="background-color: #012a50;color:#fff;border-radius: 0px 0px 4px 4px">
                            <div class="card-body">
                                <div class="container text-center" >
                                    <div class="">
                                        <li><router-link to="/web/dashboard/posted-jobs" style="color: #000">Posted Jobs</router-link></li>
                            <li><router-link to="/web/dashboard/saved-jobs" style="color: #000">Saved Jobs</router-link></li>
                                        <span>Hours per week: </span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End blog entries list -->
</template>


<script>
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
    setup() {

    },
})
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

    .logout{
        color: #473d3a;
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

