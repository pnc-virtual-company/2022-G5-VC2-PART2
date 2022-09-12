<template>
  <div class="w-[90%] m-auto mt-6 bg-white p-4 rounded">
    <div class="flex justify-between">
      <h2 class="text-2xl">Teachers</h2>
      <div class="relative">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="add-people w-12 h-9 rounded shadow hover:bg-blue-600 bg-white cursor-pointer p-2"
          @click="showTeacherForm"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
          />
        </svg>
        <div
          class="add-button absolute -top-12 z-50 text-center opacity-0 -right-10 text-sm w-32 bg-gray-900 rounded-full text-white p-1.5"
        >
          Add new teacher
        </div>
      </div>
    </div>
    <div class="rounded shadow p-4 relative mt-2">
      <searchbar-form @newKeyword="newKeyword"/>
      <div class="flex justify-center mt-4">
        <people-list :peopleList="filterTeacher" @showDetail="showDetail"/>
      </div>
        <div class="rounded p-2 m-auto mt-4 w-full flex justify-center relative" >
            <button class="flex items-center shadow p-2 px-3 rounded hover:bg-blue-500 absolute bg-white text-sm" >
                Views all
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>   
        </div>
    </div>
  </div>
    <teacher-form v-if="isShowForm" @closeForm="isShowForm=false" @create-teacher="createTeacher"/>

</template>

<script>
import axiosHttp from "../../axios-http";
import peopleList from "../PeopleList.vue";
import teacherForm from "./TeacherForm.vue";
import searchBar from '../search/SearchBar.vue'

export default {
  components:{
      "people-list": peopleList,
      "teacher-form":teacherForm,
      "searchbar-form": searchBar
  },
  emits:['show-detail'],
  data(){
    return {
      isShowForm:false,
      listTeachers: [],
      keyword:''
    }
  },
  computed:{
    filterTeacher(){
      let teacherToDisplay = this.listTeachers
      if(this.keyword){
        teacherToDisplay = this.listTeachers.filter((person) => (person.first_name +" "+ person.last_name).toLowerCase().includes(this.keyword.toLowerCase()));
      }
      return teacherToDisplay
    }

  },
    methods: {
      getTeacherData(){
        axiosHttp.get("/users/teachers").then((res)=>{
          console.log(res.data);
          this.listTeachers = res.data;
        })
      },
      showTeacherForm(){
        this.isShowForm = true;
      },
      showDetail(){
        this.$emit('show-detail');
      },
      createTeacher(userData) {
        axiosHttp.post("/users", userData).then((res) => {
          console.log(res.data);
          this.getTeacherData()
          this.isShowForm = false;
        });
      },
      newKeyword(keyword){
        this.keyword= keyword
      }
    },
    mounted(){
      this.getTeacherData()
    }
};
</script>

<style></style>
