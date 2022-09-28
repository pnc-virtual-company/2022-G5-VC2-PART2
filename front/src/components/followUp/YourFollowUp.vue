<template>
    <div class="w-[60%] m-0 p-0 mx-auto mt-[4rem]">
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
              <b><p v-for="typeOf of followup.type" :key="typeOf"> {{type}},</p></b>
            </div>
            <h4>End Date: <b>{{formatDate(followup.updated_at)}} </b></h4>
          </div>
          <div v-if="followupDetailBefore.length === 0">
            <h1 class="text-center text-blue-500">No Follow Up</h1>
          </div>
        </div>
      </div>
      <div class="p-4 ml-9">
        <div class="mt-3 mb-3">
          <h1>
            <b>Current :</b>
          </h1>
          <div>
            <div v-for="(followup,index) in followupDatailCurrent" :key="index" class="border-b-2">
                <h4>Started Date: <b>{{formatDate(followup.created_at)}} </b></h4>
                <h4>Description: {{followup.description}} </h4>
                <div class="flex">
                <h4 class="mr-2">Type of Follow up : </h4>
                <h4 v-for="typeOf of followup.type" :key="typeOf"> {{typeOf}}, </h4>
                </div>
            </div>
          </div>
          <div class="ml-[5vw] mt-3" v-if="loading">
              <span>
                <svg class="ml-4 w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                  <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                Loading.....
                </span>
            </div>
          <div v-else-if="followupDatailCurrent.length === 0">
            <h1 class="text-center text-blue-500 te mt-5"><b>No Follow Up</b> </h1>
          </div>
        </div>
        <div class="mt-3 mb-3" v-if="followupDatailCurrent.length !== 0">
          <h1><b>Comments:</b></h1>
          <div class="">
            <div v-for="(comment,index) in comments" :key="index" class="bg-gray-50 m-3 rounded p-3 border-x-4">
              <div class="flex ">
                <span class="text-gray-500">{{formatDate(comment.created_at)}}</span>
              </div>
              <p class="text-start mr-10">{{comment.comment}}</p>
              <div>
                <div class="flex justify-start items-center">
                  <!-- <img :src= getProfile() alt="" class="w-10 rounded-full"> -->
                </div>
              </div>
            </div>
          </div>
          <div class="mt-3 mb-10" v-if="followupDatailCurrent.length !== 0">
            <form @submit.prevent="postComment">
              <div class="flex">
                <div class="flex items-start">
                  <img class="w-10 rounded-full " :src= getProfile(userDataDetail.profile) v-if="isComment">
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
      loading: true,
      teacher_id: null
    }
  },
  methods:{
    showImfo(){
      this.isShow = !this.isShow
    },
    getInfoDetail() {
      axios.get('/users/student/' + localStorage.getItem('userId')).then((res)=>{
        this.userDataDetail = res.data.userData[0];
        this.studentDataDetail = res.data.studentData;
      });
    },
    getStudentFollowUpDetail() {
      this.loading = true;
      axios.get('/follow_ups/' + localStorage.getItem('userId')).then(res => {
        for(let followup of res.data) {
          if (followup['status'] === 0) {
            this.followupDetailBefore.push(followup);
          }else{
            this.followupDatailCurrent.push(followup);
          }
        }
        setTimeout(() =>{
            this.loading = false;
        },1000);
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
          user_id: null,
          student_id: localStorage.getItem('userId'),
        };
        axios.post('/comments/reply',newComment).then(() =>{
          this.comment = '';
          this.getComment();
        });
      }
    },
    getComment() {
      axios.get('/comments/'+ localStorage.getItem('userId')).then (res => {
        this.comments = res.data;
        this.teacher_id = this.comments[0].user_id;
      });
    },
    getTeacher() {
      axios.get('/comments/')
    }
  },
  mounted() {
    this.getInfoDetail();
    this.getStudentFollowUpDetail();
    this.getComment();
    this.getTeacher();
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