<template>
  <Dashboard>
    <div slot="">
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
              <span @click="selectJob(item.title, item.id)" class="job-title"
                ><b>{{ item.title }}</b></span
              >
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
    </div>
  </Dashboard>
</template>
<script>
import Dashboard from "../website/DashboardUser.vue";

export default {
  components: {
    Dashboard,
  },
  data() {
    return {
      jobs: [],
    };
  },
  props: {
    userID: null,
    username: "",
  },
  methods: {
    async getPostedJobs() {
      await axios
        .post("/view/posted-jobs", { user: localStorage.getItem("userID") })
        .then((res) => {
          if (res.status == 200) {
            if (!res.data) {
            } else {
              this.jobs = res.data;
            }
          } else {
            console.log(res.data);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getPostedJobs();
    //alert(localStorage.getItem('userID'))
  },
};
</script>
