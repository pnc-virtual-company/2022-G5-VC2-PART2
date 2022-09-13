<template>
  <div>
    <div class="w-[90%] m-auto mt-6  p-4 rounded">
      <div class="flex justify-between">
        <h2 class="text-2xl">Teachers</h2>
        <div class="relative">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="add-people w-14 h-10  rounded shadow hover:bg-slate-200 bg-white cursor-pointer p-2"
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
        <searchbar-form @newKeyword="newKeyword"/>
        <div class="flex justify-center mt-4">
          <people-list :peopleList="filterTeacher" @showDetail="showDetail" @alertDelete="alertDelete"/>
        </div>
          <div class="rounded p-2 m-auto mt-4 w-full flex justify-center relative" v-if="filterTeacher.length > 2"> 
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
      <teacher-form v-if="isShowForm" @closeForm="isShowForm=false" @create-teacher="createTeacher"/>
      <delete-alert v-if="isDeleteAlert" @delete-user="deletedPerson" :userId="userId" @cancelDelete="isDeleteAlert=false" />
  </div>
    <teacher-form v-if="isShowForm" @closeForm="isShowForm=false,messageError=''" @create-teacher="createTeacher" :message="messageError"/>
</template>

<script>
import axiosHttp from "../../axios-http";
import peopleList from "../PeopleList.vue";
import teacherForm from "./TeacherForm.vue";
import deleteAlert from "../delete/DeleteAlert.vue";
import searchBar from '../search/SearchBar.vue'

export default {
  components:{
      "people-list": peopleList,
      "teacher-form":teacherForm,
      "delete-alert": deleteAlert,
      "searchbar-form": searchBar
  },
  data(){
    return {
      isShowForm:false,
      listTeachers: [],
      keyword:'',
      messageError: '',
      isDeleteAlert:false,
      userId:null,
      dataToShow: 3,
      showShortList: true,
    }
  },
  methods: {
    getTeacherData(){
      axiosHttp.get("/users/teachers").then((res)=>{
        this.listTeachers = res.data;
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
    alertDelete(id){
      this.isDeleteAlert = true;
      this.userId = id;
    },
    createTeacher(userData,messageBack) {
      axiosHttp.post("/users", userData).then(() => {
        this.getTeacherData();
        this.messageError = messageBack;
        this.isShowForm = false;
      }).catch((error) =>{
        if (error.response.status === 422) {
          this.messageError = error.response.data.message;
        }
      });
    },
    newKeyword(keyword){
      this.keyword= keyword
    },
    showAll(){
      this.showShortList = !this.showShortList;
    }
  },
  mounted(){
    this.getTeacherData();
  },
  computed:{
    filterTeacher(){
      let teacherToDisplay = this.listTeachers
      if(this.keyword){
        teacherToDisplay = this.listTeachers.filter((person) => (person.first_name +" "+ person.last_name).toLowerCase().includes(this.keyword.toLowerCase()));
      }
      if (this.showShortList){
        teacherToDisplay = teacherToDisplay.slice(0,this.dataToShow);
      }
      console.log(teacherToDisplay);
      return teacherToDisplay
    }
  },
};
</script>

<style></style>
