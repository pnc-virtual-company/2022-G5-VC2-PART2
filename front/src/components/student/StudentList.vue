<template>
  <div class="w-[90%] m-auto mt-6 bg-white p-4 rounded">
    <div class="flex justify-between">
      <h2 class="text-2xl">Students</h2>
      <div class="relative">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="add-people w-12 h-9 rounded shadow hover:bg-blue-600 bg-white cursor-pointer p-2"
          @click="showStudentForm">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
        </svg>
        <div
          class="add-button absolute z-50 -top-12 opacity-0 -right-10 text-sm w-32 bg-gray-900 rounded-full text-white p-1.5 text-center">
          Add new student
        </div>
      </div>
    </div>
    <div class="rounded shadow p-4 mt-2">
      <searchbar-form @newKeyword="updateKeyword"/>
      <div class="flex justify-center mt-4 w-full">
        <people-list :peopleList="filterStudent" @showDetail="showDetail" @deletePerson="deletePerson"/>
      </div>
        <div class="rounded p-2 m-auto mt-4 w-full flex justify-center relative" >
            <button class="flex items-center shadow p-2 px-3 rounded hover:bg-slate-200 absolute bg-white text-sm" @click="showAll"  >
                <p v-if="showShortList">View All</p>
                <p v-else>Hide</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>   
        </div>
    </div>
  </div>
    <student-form v-if="isShowForm" @closeForm="isShowForm=false" @create-student="createStudent" :userData="user" :studentData="user"/>
    <delete-alert v-if="isDeleteAlert" @delete-user="deletedPerson" :userId="userId" @cancelDelete="isDeleteAlert=false" />
</template>

<script>
import axiosHttp from '../../axios-http';
import peopleList from "../PeopleList.vue"
import studentForm from './StudentForm.vue';
import deleteAlert from "../delete/DeleteAlert.vue";
import searchBar from '../search/SearchBar.vue';
export default {
  components: {
    "people-list": peopleList,
    "student-form": studentForm,
    "delete-alert": deleteAlert,
    "searchbar-form": searchBar
  },
  emits:['show-detail'],
  data() {
      return {
        isShowForm: false,
        messageError: "",
        listStudents:[],
        isDeleteAlert:false,
        userId:null,
        dataToShow: 3,
        showShortList: true,
        keyword:''
      }
  },
  computed:{
    filterStudent(){
      let studentToDisplay = this.listStudents;
      if(this.keyword){
        studentToDisplay = this.listStudents.filter((person) => (person.first_name+" "+person.last_name).toLowerCase().includes(this.keyword.toLowerCase()));
      }
      if (this.showShortList){
        studentToDisplay = studentToDisplay.slice(0,this.dataToShow);
      }
      return studentToDisplay
    }
  },
  methods: {
      getStudentData(){
        axiosHttp.get("/users/students").then((res)=>{
          console.log(res.data);
          this.listStudents = res.data;
        })
      },
      showStudentForm(){
        this.isShowForm = true;
      },
      showDetail(){
        this.$emit('show-detail');
      },  
      deletedPerson(){
      this.getStudentData();
      this.isDeleteAlert = false;
      },
      deletePerson(id){
        this.isDeleteAlert = true;
        this.userId = id;
        console.log(id);
      },
      createStudent(userData,studentData) {
        axiosHttp.post('/users',userData).then((res) => {
          console.log(res.data);
          this.isShowForm = false;
        })
        .catch((error) =>{
          if (error.response.status === 401){
            this.messageError = error.response.data.message;
            console.log(this.messageError)
          }
          });
        axiosHttp.post('/students',studentData).then((res) => {
          console.log(res);
          this.isShowForm = false;
          this.getStudentData();
        }).catch((error) => {
          if (error.response.status === 401) {
            this.messageError = error.response.data.message;
          }
        });
      },
      updateKeyword(keyword){
        this.keyword = keyword
      },
      showAll(){
      this.showShortList = !this.showShortList;
    }
  },
  mounted(){
    this.getStudentData();
  },
}

</script>

<style>
.add-button:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  background: rgb(14, 14, 14);
  left: 60px;
  top: 26px;
  transform: translateX(-50%) rotate(45deg);
}

.add-people:hover+.add-button {
  opacity: 100;
  transition: all 0.6s ease-in-out;
}
</style>
