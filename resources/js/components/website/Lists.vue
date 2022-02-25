
<template>
   <div class="main">
       <div class="container">
           <div class="card">
               <div class="card-header">
                   <div class="row">
                       <div class="col-md-3">
                           <a href="javascript:;" @click="updateTable()" ><i class="bi bi-table"></i> List Of Web Message</a>
                       </div>
                       <div class="col-md-5">
                           <form v-on:submit.prevent="onSearch()" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="from-group">
                                    <div class="input-group">
                                        <input type="text" v-model="search" class="form-control">
                                        <button class="btn btn-info" type="submit"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>

                            </div>
                       </form>
                       </div>
                   </div>
               </div>
               <div class="card-body">
                   <table class="table">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Subject</th>
                               <th>Message</th>
                               <th>Date</th>
                               <th>Option</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr v-for="item in contacts" :key="item.id">
                               <td><input type="checkbox" v-model="selected"  :value="item.id" ></td>
                               <td>{{ item.name }}</td>
                               <td>{{ item.email }}</td>
                               <td>{{ item.subject }}</td>
                               <td>{{ item.message }}</td>
                               <td>{{ item.created_at }}</td>
                               <td>
                                   <div class="row">
                                       <div class="col-md-3">
                                       <router-link :to="'/edit/'+item.id" class="text-primary"><i class="bi-pencil"></i></router-link>
                                   </div>
                                   <div class="col-md-3">
                                       <a href="javascript:;" @click="deleteC(item.id)" class="text-danger"><i class="bi-trash"></i></a>
                                   </div>
                                   </div>
                               </td>
                           </tr>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
import axios from 'axios'
    export default {
        data(){
            return {
                contacts: [],
                selected: [],
                search: '',
            }
        },
        methods: {
            async onSearch(){
                await axios.post('/select/webcontact',{search:this.search}).then((res) =>{
                    if(res.status != 200){
                        console.log('Um defeito aconteceu: '+res.status);
                    }else{
                        this.contacts = res.data;
                    }
                   console.log(res.data)
                }).catch((error) => {
                if(error.response.status !=404)
                    console.log('Error: '+error);
                })
            },

            async updateTable(){
                await axios.get('/webcontacts').then((res) =>{
                    if(res.status != 200){
                        alert('Error'+res.status);
                    }else{
                        this.contacts = res.data;
                    }
                }).catch((error) => {
                    console.log(error.response.data)
                })
            },
            async deleteC(id){
                await axios.delete('/webcontacts/'+id).then((res) =>{
                    if(res.status != 200){
                        alert('Error'+res.status);
                    }else{
                        this.updateTable();
                    }
                }).catch((error) => {
                    console.log('Error to delete: '+ error.response.data)
                })
            },
            checkCompleted(param){
                if(param == 1){
                    return true;
                }else{
                    return false;
                }
            }

        },
        created(){
            axios.get('/webcontacts').then((res) =>{
                    if(res.status != 200){
                        alert('Error'+res.status);
                    }else{
                        this.contacts = res.data;
                    }
                }).catch((error) => {
                    console.log(error.response.data)
                })

        },
        mounted(){
            //this.getMessages();
        }
    }
</script>
