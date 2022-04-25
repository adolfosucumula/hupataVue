
<template>
  <Dashboard>

    <div class="card sidebar-rigth">
      <div class="card-header">
        <span class="card-title">Send your bid</span>
      </div>
    </div>
    <div v-for="item in jobs" :key="item.id" class="card sidebar-rigth">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <span class="job-title"
              ><b>{{ item.title }}</b></span
            >
          </div>
          <div class="col-md-5 widegets">
            <span id="currency">{{ currency }} {{ item.total_tax }}</span>
          </div>
        </div>
        <div>
          {{ item.detail }}
        </div>

        <div class="row" style="margin-top: 2%">
          <div class="col-md-4 certificate">
            <i class="fas fa-certificate text-info"></i>
            Pagamento verificado
          </div>
          <div class="col-md-2" style="text-align: left">
            <i class="fas fa-star text-success"></i>
            <i class="fas fa-star text-success"></i>
            <i class="fas fa-star text-success"></i>
            <i class="fas fa-star text-success"></i>
          </div>
          <div class="col-md-3" style="text-align: left">
            <i class="far fa-map"></i>
            <span class="certificate">{{ item.preferences }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-11 bid">
            <button
              v-if="!bid"
              @click="bidJob(1)"
              class="btn btn-primary btn-sm"
            >
              <i class="fas fa-check"></i>
              Bid
            </button>
            <button
              v-if="bid"
              @click="bidJob(0)"
              class="btn btn-info btn-sm"
            >
              <i class="fas fa-hand-point-up"></i>
              Bids
            </button>
          </div>
        </div>

      </div>
    </div>
    <div v-if="!bid" v-for="item in bids" :key="item.id" class="card sidebar-rigth" >
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
             <!--<b-img v-bind="mainProps" :src="'storage/'+item.photo" rounded="circle" alt="Circle image"></b-img>-->
             <img class="user-photo" :src="'storage/'+item.photo" alt="" >
            <span class="job-title"
              ><b>{{ item.username }}</b></span
            >
          </div>
          <div class="col-md-5 widegets">
            <span id="currency">{{ currency }} {{ item.tax_per_hour }}</span>
          </div>
        </div>
        <div>
          {{ item.presentation_letter }}
        </div>

        <div class="row" style="margin-top: 2%">
          <div class="col-md-4 certificate">
            <i class="fas fa-certificate text-info"></i>
            Pagamento verificado
          </div>
          <div class="col-md-2" style="text-align: left">
            <i class="fas fa-star text-success"></i>
            <i class="fas fa-star text-success"></i>
            <i class="fas fa-star text-success"></i>
            <i class="fas fa-star text-success"></i>
          </div>
          <div class="col-md-3" style="text-align: left">
            <i class="far fa-map"></i>
            <span class="certificate">{{ item.preferences }}</span>
          </div>
        </div>

      </div>
    </div>
    <div class="card" v-if="bid">
        <div class="bid-form" v-if="bid">
            <form v-on:submit.prevent="sendBid()" method="post" role="form" class="form-post">
                <div class="form-group mt-3">
                    <label for="message">Presentation letter <span class="text-danger">*</span></label>
                    <textarea class="form-control" v-model="profile" rows="5" placeholder="Profile" required></textarea>
                    <span v-if="e_profile" class="text-center text-danger">{{e_profile}}</span>
                </div>
              <div class="form-group mt-3">
                    <label for="message">File profile </label>
                    <input type="file" class="form-control" @change="handleOnChange" name="fileprofile" placeholder="Profile" />
                    <span v-if="e_fileprofile" class="text-center text-danger">{{e_fileprofile}}</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name">Bid <span class="text-danger">*</span></label>
                    <input type="text" v-model="bid_tax" @keyup="checkBid()" class="form-control" placeholder="Bid a tax" required>
                    <span v-if="e_bid_tax" class="text-center text-danger">{{e_bid_tax}}</span>
                </div>
                <div class="col-md-6 form-group">
                    <label for="name">Time <span class="text-danger">*</span></label>
                    <input type="text" v-model="time" @keyup="checkBid()" class="form-control" placeholder="Time" required>
                    <span v-if="e_time" class="text-center text-danger">{{e_time}}</span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name">Total tax </label>
                    <input type="text" v-model="total" readonly class="form-control" placeholder="User tax" required>
                    <span v-if="e_user_tax" class="text-center text-danger">{{e_user_tax}}</span>
                </div>
                <div class="col-md-6 form-group">
                    <label for="name">App tax <span class="text-danger">*</span></label>
                    <input type="text" v-model="apptax" readonly class="form-control" placeholder="App tax" required>
                    <span v-if="e_apptax" class="text-center text-danger">{{e_apptax}}</span>
                </div>
              </div>
              <div class="row">
                  <span class="col-md-6">User tax: {{this.user_tax}} {{currency}}</span>
                  <span class="col-md-6">App total tax: {{this.apptax }} {{currency}}</span>
              </div>
              <div class="card">
                  <div class="card-body">
                      <div v-if="submit" class="text-center my-3"><button type="submit" class="btn btn-success">Submit</button></div>

                    <div v-if="errorMessage" class="text-center error-message">
                        <span class="alert alert-danger">{{ errorMessage }}</span><br>
                    </div>
                        <!--               -->
                    <div class="alert alert-danger" v-for="err in notifmsg" :key="err">
                        <span class="text-danger">{{ err  }} </span>
                    </div>
                  </div>
              </div>
            </form>
        </div>
    </div>
  </Dashboard>
</template>

<script>
import Dashboard from "../website/DashboardUser.vue";
import useVuelidate from "@vuelidate/core";
import { required, email, string } from "@vuelidate/validators";
import axios from "axios";

//const ax = require('axios');
export default {
  components: {
    Dashboard,
  },
  data() {
    return {
      jobID:'',
      app_tax_percent:'',
      taxperhour:'',
      profile: "",
      fileprofile: '',
      bid_tax:'',
      total_tax:'',
      total:'0',
      user_tax:'0',
      time:'7',
      apptax:'0',
      search: null,
      jobs: [],
      bids: [],
      color: "",
      tabIndex: 0,
      bid: false,
      selected: false,
      currency: "",
      e_profile:'',
      e_fileprofile:'',
      e_bid_tax:'',
      e_user_tax:'',
      e_time:'',
      e_apptax:'',
      photo_error:'',
      errorMessage:null,
      notifmsg: '',
      submit:true,
    };
  },
  methods: {
    handleOnChange(e){
        try {
            this.fileprofile = e.target.files[0];
        } catch (error) {

        }
    },
    async sendBid() {
        const formData = new FormData;
                formData.set('jobID', this.jobID)
                formData.set('presentationletter', this.profile);
                formData.set('presentationfile', this.fileprofile);
                formData.set('tax_per_hour', this.bid_tax);
                formData.set('app_tax', this.apptax);
                formData.set('tax_to_receive', this.user_tax);
                formData.set('days', this.time);
                await axios.post('/job-bids', formData )
                    .then((res) => {
                        if(res.status == 200){
                            if(res.data.save){
                                this.clearFields();
                                this.bid = false
                                this.$router.push('/web/dashboard');
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
                        console.log(e.response.data)

                    });
    },
    async viewJobs() {
      if (this.$route.params.id) {
        await axios
          .post("/view/jobs", {
            id: this.$route.params.id,
            title: this.$route.params.title,
          })
          .then((res) => {
            if (res.status == 200) {
              if (res.data.length > 0) {
                  this.jobID = res.data[0].id
                this.taxperhour = res.data[0].tax_per_hour
                this.total_tax = res.data[0].total_tax
                this.jobs = res.data;
              }
            } else {
              console.log(res.data);
            }
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
      }
    },
    async getBids(job_id) {
      if (job_id) {
        await axios
          .get("/job-bids/get/"+job_id)
          .then((res) => {
            if (res.status == 200) {
              if (res.data.length > 0) {
                  this.bids = res.data
              }
            } else {
              console.log(res.data);
            }
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
      }
    },
    async bidJob(i) {
      this.bid = i==1? true : false;
    },
    checkBid(){
       if(this.bid_tax < this.taxperhour){
           this.e_bid_tax = 'Require at least '+this.taxperhour;
       }else{
           this.e_bid_tax = '';
            if(this.bid_tax > 0 & this.time>0){
                this.total = this.bid_tax * this.time
                this.apptax = (this.total * this.app_tax_percent)/100
                this.user_tax = this.total - this.apptax
                if(this.total > this.total_tax){
                    this.submit = false;
                    this.errorMessage = 'Your bid is highest then the customer is offer!'
                }else{
                    this.submit = true;
                    this.errorMessage = ''
                }
            }else{
                this.apptax ='0'
                this.user_tax = '0'
            }
       }
    },
    checkSession() {
      axios
        .get("/check/user-session")
        .then((res) => {
          if (res.status == 200) {
            if (!res.data.loggin) {
              this.$router.push("/webcontact/signin");
            } else {
              localStorage.setItem("loggin", res.data.loggin);
              localStorage.setItem("email", res.data.user.email);
              localStorage.setItem("status", res.data.user.status);
              localStorage.setItem("level", res.data.user.level);
              localStorage.setItem("currency", res.data.settings[0].currency);
              localStorage.setItem(
                "app_tax_percent",
                res.data.settings[0].app_tax_percent
              );
            }
          } else {
            console.log(res.data);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getRequestErrors(errors){
                try {
                    if(errors.presentationletter){ this.e_profile = errors.presentationletter[0] }else{this.e_profile=''}
                    if(errors.presentationfile){ this.e_fileprofile = errors.presentationfile[0]; }else{this.e_fileprofile=''}
                    if(errors.tax_per_hour){ this.e_bid_tax = errors.tax_per_hour[0]; }else{this.e_bid_tax=''}
                    if(errors.app_tax){ this.e_apptax = errors.app_tax[0]; }else{this.e_apptax=''}
                    if(errors.tax_to_receive){ this.e_user_tax = errors.tax_to_receive[0]; }else{this.e_user_tax=''}
                    if(errors.days){ this.e_time = errors.days[0]; }else{this.e_time=''}
                } catch (error) {
                }
            },
    clearFields(){
        this.bid = false
                this.jobID = null;
                this.profile = null;
                this.fileprofile = null;
                this.bid_tax = null;
                this.apptax = null;
                this.user_tax=null;
                this.total_tax=null;
                this.total=null;
                this.e_fileprofile=null;
                this.errorMessage =null;
                this.notifmsg =null;
    },
    makeToast(variant = null) {
        this.$bvToast.toast('Toast body content', {
        title: `Variant ${variant || 'default'}`,
        variant: variant,
        solid: true
        })
    }
  },
  mounted() {

    this.viewJobs();
    this.checkSession();
    this.getBids(this.$route.params.id)
    this.app_tax_percent = localStorage.getItem('app_tax_percent');
    this.username = localStorage.getItem("username");
    this.loggin = localStorage.getItem("loggin");
    this.currency = localStorage.getItem("currency");
  },
};
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

#currency {
  font-weight: bold;
}
</style>

