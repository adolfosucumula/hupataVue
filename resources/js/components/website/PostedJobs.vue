<template>
  <div>
    <div class="form">
      <div class="sidebar-item search-form">
        <form v-on:submit.prevent="searchJobs()" method="post">
          <input
            type="text"
            @keyup="searchJobs()"
            v-model="search"
            placeholder="Search for job"
            class="form-control"
          />
          <button type="submit"><i class="bi bi-search"></i></button>
        </form>
      </div>
      <!-- End sidebar search formn-->
    </div>
    <div class="card sidebar-rigth">
      <div class="card-header">
        <span class="card-title">Jobs you had posted</span>
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
        <div class="row">
          <div class="col-md-11 bid">
            <button
              v-if="!bid"
              @click="editJob(item.id, item.title)"
              class="btn btn-primary btn-sm"
            >
              <i class="fas fa-edit"></i>
              Edit
            </button>
            <button @click="deleteJob(item.id)" class="btn btn-danger btn-sm">
              <i class="fas fa-trash"></i>
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
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
    editJob(id, title) {
      const myArray = title.split(" ");
      let i = 0;
      let newTitle = "";

      for (i = 0; i < myArray.length; i++) {
        if (i == 0) {
          newTitle = myArray[i];
        } else {
          newTitle = newTitle + "-" + myArray[i];
        }
      }
      this.$router.push(
        "/web/dashboard/job/edit/" + id + "/" + newTitle.toLowerCase()
      );
    },
    async deleteJob(id) {
      if (id) {
        await axios.delete("/jobs/" + id)
          .then((res) => {
            if (res.status != 200) {
              console.log(res);
            } else { console.log(res);
              this.getPostedJobs();
            }
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
      }
    },
    async searchJobs() {
      if (this.search) {
        await axios
          .post("/select/jobs", { search: this.search })
          .then((res) => {
            if (res.status == 200) {
              if (res.data.length > 0) {
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
  },
  mounted() {
    this.getPostedJobs();
  },
};
</script>

<style scoped>
.widegets {
  text-align: right;
}
.job-title {
  cursor: pointer;
  color: rgb(48, 136, 7);
}
.job-title:hover {
  color: #0a2a50;
}
.certificate {
  color: rgb(122, 122, 121);
  font-size: 11pt;
}
.user-photo {
  max-width: 80px;
  max-height: 80px;
  border-radius: 40px;
}
.name {
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
.tab {
  background-color: #012a50;
  border-bottom: 0px;
}

.sidebar-rigth {
  border-radius: 0px 0px 0px 0px;
}

.card-title {
  font-weight: bold;
  font-size: 1.3em;
  color: #fff;
}
.card-header {
  padding: 4px;
  background-color: #012a50;
  border-bottom: 0px;
}
.menu {
  position: absolute;
  display: block;
  margin-top: 1%;
  background: #012a50;
}

.menu .title {
  padding: 0%;
  margin-left: 0%;
  text-decoration: none;
  color: #ddd;
}
.menu-job {
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
.blog .sideba .search-form form input[type="text"] {
  border: 0;
  padding: 4px;
  border-radius: 4px;
  width: calc(100% - 40px);
}
form input[type="text"] {
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

nav {
  position: relative;
  padding-bottom: 12px;
}
.line {
  height: 2px;
  position: absolute;
  bottom: 0;
  margin: 10px 0 0 0;
  background: #ff1847;
}

ul {
  padding: 0;
  margin: 0;
  list-style: none;
  display: flex;
}

li {
  margin: 0 40px 0 0;
  opacity: 0.4;
  transition: all 0.4s ease;
}

li:hover {
  opacity: 0.7;
}

li .active {
  opacity: 1;
}

li:last-child {
  margin-right: 0;
}

a {
  text-decoration: none;
  color: #fff;
  text-transform: uppercase;
  display: block;
  font-weight: 600;
  letter-spacing: 0.2em;
  font-size: 14px;
}
</style>


