<template>
  <div>
    <div class="w-[90%] m-auto mt-20 mb-5  p-4 rounded">
      <div class="relative  mt-0 mb-2 w-full" v-if="isSuccess" >
          <alert-success :content="message"/>
      </div>
      <div class="flex justify-between">
        <h2 class="text-2xl">Teachers</h2>
        <div class="relative flex items-center">
        <searchbar-form @newKeyword="filterTeacher" placeholder="Search Name"/>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="add-people w-14 h-10 ml-2  rounded shadow hover:bg-slate-200 bg-white cursor-pointer p-2"
            @click="showTeacherForm"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
            />
          </svg>
          <div
            class="add-button absolute -top-12 z-50 text-center opacity-0 -right-10 text-sm w-32 bg-[#1a1a1a] rounded-full text-white p-1.5"
          >
            Add new teacher
          </div>
        </div>
        
      </div>
      <div class="rounded shadow p-4 relative mt-2 bg-white">
        <div class="flex justify-center mt-4">
          <people-list :peopleList="listTeachers" @showDetail="showDetail" @alertDelete="alertDelete" />
        </div>
        <div class="ml-[38vw] mt-3" v-if="loading">
          <span class="" id="wait">
            <svg class="ml-4 w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
              <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            Loading.....
          </span>
        </div>
        <div v-else-if="listTeachers.length === 0" class="flex flex-col items-center mt-8 mb-3">
          <img class="w-40" src="./../../assets/noRequestFound.png" alt="Image not found">
          <h1 class="text-stone-500 mt-5">No Teacher</h1>
        </div>
          <div class="rounded p-2 m-auto mt-4 w-full flex justify-center relative" v-if="listTeachers.length > 3"> 
              <button class="flex items-center shadow p-2 px-3 rounded hover:bg-slate-200 absolute bg-white text-sm" @click="showAll"  >
                <div v-if="showShortList" class="flex">
                  <p class="text-sm">View All</p>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
                </div>
                <div v-else class="flex">
                  <p class="text-sm">Hide</p>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                  </svg>
                </div>
              </button>   
          </div>
      </div>
    </div>
      <teacher-form v-if="isShowForm" @closeForm="isShowForm=false,messageError=''" @create-teacher="createTeacher" :message="messageError"/>
      <delete-alert v-if="isDeleteAlert" @delete-user="deletedPerson" :userId="userId" @cancelDelete="isDeleteAlert=false" />
  </div>
</template>

<script>
import axiosHttp from "../../axios-http";
import peopleList from "../PeopleList.vue";
import teacherForm from "../teacher/TeacherForm.vue";
import deleteAlert from "../widgets/action/DeleteAlert.vue";
import searchBar from '../search/SearchBar.vue';
import alertSuccess from "../widgets/AlertSuccess.vue"
export default {
  components:{
      "people-list": peopleList,
      "teacher-form":teacherForm,
      "delete-alert": deleteAlert,
      "searchbar-form": searchBar,
      "alert-success" : alertSuccess
  },
  data(){
    return {
      isShowForm:false,
      listTeachers: [],
      messageError: '',
      isDeleteAlert:false,
      userId:null,
      dataToShow: 3,
      showShortList: true,
      isSuccess: false,
      loading: true,
      message: "Created teacher successful"
    }
  },
  methods: {
    getTeacherData(){
      axiosHttp.get("/users/teachers").then((res)=>{
        this.listTeachers = res.data.reverse();
        console.log(this.listTeachers);
      })
    },
    showTeacherForm(){
      this.isShowForm = true;
    },
    showDetail(){
      this.$emit('show-detail');
    },
    deletedPerson(){
      this.getTeacherData();
      this.isDeleteAlert = false;
    },
    alertDelete(id,event){
      this.isDeleteAlert = true;
      event.stopPropagation();
      this.userId = id;
    },
    createTeacher(userData,messageBack) {
      axiosHttp.post("/users", userData).then(() => {
        this.getTeacherData();
        this.messageError = messageBack;
        this.isShowForm = false;
        this.isSuccess  = true
        setTimeout(() => {
          this.isSuccess = false;
        },4000);
      }).catch((error) =>{
        if (error.response.status === 422) {
          this.messageError = error.response.data.message;
        }
      });
    },
    filterTeacher(keyword) {
    axiosHttp.get('/users/teachers').then(res => {
      this.listTeachers = res.data.filter((teacher) => teacher.first_name.toLowerCase().includes(keyword.toLowerCase()) || teacher.last_name.toLowerCase().includes(keyword.toLowerCase()));
    });
  },
  },
  mounted(){
    setTimeout(() => {
      this.loading = false;
    },1000);
    this.getTeacherData();
  },
  
};
</script>

<style></style>
