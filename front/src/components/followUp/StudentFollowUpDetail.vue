<template>
  <div class="w-[60%] m-0 p-0 mx-auto mt-[4rem]">
    <!-- icon back to followup page -->
    <div class="p-5  text-center text-lg uppercase">
      <router-link to="/followUp">
        <svg class="h-7 w-7 text-black-100 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </router-link>
    </div>
    <div class="cursor-pointer" @click="showImfo">
      <div class=" flex items-center ml-10 relative rounded" >
        <div class="relative ">
          <img class="w-20 rounded-full " :src= getProfile(userDataDetail.profile)>
        </div>
        <div class="ml-5 leading-9 text-[25px]">
          <p>{{userDataDetail.first_name}} {{userDataDetail.last_name}}</p>
        </div>
      </div>
    </div>
    <!-- information of student -->
    <div class="p-8 bg-white-500 shawdow" v-if="isShow">
      <div class="flex justify-between ml-5">
        <div>
        <h3 class="text-[15px]"><b>Gender: </b>{{userDataDetail.gender}}</h3>
        <h3 class="text-[15px]"><b>Class: </b>{{studentDataDetail.class_name}}</h3>
        </div>
        <div>
          <h3 class="text-[15px]"><b>Batch: </b>{{studentDataDetail.year}}</h3>
          <h3 class="text-[15px]"><b>Email: </b>{{userDataDetail.email}}</h3>
        </div>
      </div>
      <div class="ml-2 p-3 mt-5">
        <h3><b>Before :</b></h3>
        <div v-for="(followup,index) in followupDetailBefore" :key="index" class="border-b-2">
          <h4>Started Date: <b>{{formatDate(followup.created_at)}} </b></h4>
          <h4 class="text-start">Description: {{followup.description}}.</h4>
          <div class="flex">
            <h4 class="mr-2">Type of Follow up : </h4>
            <b><p v-for="typeOf of followup.type" :key="typeOf"> {{typeOf}},</p></b>
          </div>
          <h4>End Date: <b>{{formatDate(followup.updated_at)}} </b></h4>
        </div>
        <div v-if="followupDetailBefore.length === 0">
          <h1>No Follow Up</h1>
        </div>
      </div>
    </div>
    <div class="p-4 ml-9">
      <div class="mt-3 mb-3">
        <h1>
          <b>Current :</b>
        </h1>
        <div v-for="(followup,index) in followupDatailCurrent" :key="index" class="border-b-2">
          <h4>Started Date: <b>{{formatDate(followup.created_at)}} </b></h4>
          <h4>Description: {{followup.description}} </h4>
          <h4>Tutor: {{tutor(followup.user_id)}} <b>{{tutorName}} </b></h4>
          <div class="flex">
            <h4 class="mr-2">Type of Follow up : </h4>
            <h4 v-for="typeOf of followup.type" :key="typeOf"> {{typeOf}}, </h4>
          </div>
        </div>
      </div>
      <div class="mt-3 mb-3">
        <h1><b>Comments:</b></h1>
        <div class="">
          <div v-for="(comment,index) in comments" :key="index" class="bg-gray-50 m-3 rounded p-3 border-x-4">
            <div class="flex ">
              <span class="text-gray-500">{{formatDate(comment.created_at)}}</span>
            </div>
            <p class="text-end mr-10">{{comment.comment}}</p>
            <div>
              <div class="flex justify-end items-center">
                <img :src= getProfile(user.profile) alt="" class="w-10 rounded-full">
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 mb-10">
          <form @submit.prevent="postComment">
            <div class="flex">
              <div class="flex items-start">
                <img class="w-10 rounded-full " :src= getProfile(user.profile) v-if="isComment">
              </div>
              <textarea cols="5" rows="5" placeholder="Comment...." class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline" @click="clickComment" v-model="comment" :class="{'border-red-500' :error}"></textarea>
            </div>
            <div class="mt-3 flex justify-end" v-if="isComment">
              <button-cancel  @click="cancel">
                <template v-slot:button_cancel>Cancel</template>     
              </button-cancel>
              <button-create>
                <template v-slot:button_create>Comment</template>      
              </button-create>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../../axios-http';
import moment from 'moment';
export default {
props: {
  user:Object,
},

data(){
  return{
    userDataDetail: [],
    studentDataDetail: [],
    isShow:false,
    followupDetailBefore: [],
    followupDatailCurrent: [],
    isComment: false,
    comment: '',
    error: false,
    comments: [],
    tutorName: ''
  }
},
methods:{
  showImfo(){
    this.isShow = !this.isShow
  },
  getInfoDetail() {
    axios.get('/users/student/' + this.$route.params.id).then((res)=>{
      this.userDataDetail = res.data.userData[0];
      this.studentDataDetail = res.data.studentData;
    });
  },
  getStudentFollowUpDetail() {
    axios.get('/follow_ups/' + this.$route.params.id).then(res => {
      for(let followup of res.data) {
        if (followup['status'] === 0) {
          this.followupDetailBefore.push(followup);
        }else{
          this.followupDatailCurrent.push(followup);
        }
      }
    });
  },
  getProfile(image) {
    return axios.defaults.baseURL + "storage/image/" + image;
  },
  formatDate(value) {
   return moment(String(value)).format('MM/DD/YYYY');
  },
  clickComment() {
    this.isComment = true;
  },
  cancel() {
    this.isComment = false;
    this.comment = '';
  },
  postComment() {
    if(this.comment == '') {
      this.error = true;
    }else{
      this.error = false;
      let newComment = {
        comment: this.comment,
        user_id: localStorage.getItem('userId'),
        student_id: this.$route.params.id,
      };
      axios.post('/comments',newComment).then(() =>{
        this.comment = '';
        this.getComment();
      });
    }
  },
  getComment() {
    axios.get('/comments/'+ this.$route.params.id).then (res => {
      this.comments = res.data;
    });
  },
  tutor(user_id) {
    axios.get('/users/teacher/'+ user_id).then(res=>{
      this.tutorName = res.data.userData.first_name+ ' ' + res.data.userData.last_name ;
    })
  
  }

},
mounted() {
  this.getInfoDetail();
  this.getStudentFollowUpDetail();
  this.getComment();
}
}
</script>

<style scoped>
  h4{
    margin: 4px 0;
  }
  span{
    font-size: small;
  }
  #text{
    text-align: left;
  }
</style>