<template>
  <div>
    <div class="w-[90%] m-auto mt-20 mb-5  p-4 rounded">
      <div class="flex justify-between">
        <h2 class="text-2xl">Students</h2>
        <div class="relative">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="add-people w-14 h-10 rounded shadow hover:bg-slate-200 bg-white cursor-pointer p-2"
            @click="showStudentForm"
            >
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
          </svg>
          <div
            class="add-button absolute z-50 -top-12 opacity-0 -right-10 text-sm w-32 bg-[#1a1a1a] rounded-full text-white p-1.5 text-center">
            Add new student
          </div>
        </div>
      </div>
      <div class="rounded shadow p-4 mt-2 bg-white">
        <div class="flex justify-between">
          <div class="flex">
              <div class="flex justify-between">
                <label for="filter-status" class="mx-3 font-medium"><span class="text-red-600">*</span>Filter By
                  Batch:</label>
                <select v-model="filterByBatch" id="filter-status"
                  class="shadow appearance-none w-44 rounded border border-gray-250 p-[0.4rem] focus:border-2 focus:outline-none focus:border-primary">
                  <option value="All">All</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                </select>
              </div>
            <div class="flex justify-between">
              <label for="filter-status" class="mx-3 font-medium"><span class="text-red-600">*</span>Filter By
                Class:</label>
              <select v-model="filterByClass" id="filter-status"
                class="shadow appearance-none w-44 rounded border border-gray-250 p-[0.4rem] focus:border-2 focus:outline-none focus:border-primary">
                <option value="All">All</option>
                <option value="WEB A">WEB A</option>
                <option value="WEB B">WEB B</option>
                <option value="WEB C">WEB C</option>
                <option value="SNA">SNA</option>
              </select>
            </div>
  
          </div>
          <searchbar-form @newKeyword="updateKeyword" placeholder="Search Name, ID"/>
        </div>
        <div class="flex justify-center mt-4 w-full">
          <people-list :peopleList="filterStudent" @showDetail="showDetail" @alertDelete="alertDelete"/>
        </div>
        <div v-if="listStudents.length <= 0" class="flex flex-col items-center mt-8 mb-3">
          <img class="w-60" src="./../../assets/noRequestFound.png" alt="Image not found">
          <h1 class="text-stone-500">No any requests for now!</h1>
        </div>
        <div v-else-if="filterStudent.length <= 0" class="flex flex-col items-center mt-8 mb-3">
          <img class="w-60" src="./../../assets/requestEmpty.png" alt="Image not found">
          <h1 class="text-stone-500 mt-5 ">No requests found!</h1>
        </div>
          <div class="rounded p-2 m-auto mt-4 w-full flex justify-center relative" v-if="filterStudent.length > 3" >
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
      <student-form v-if="isShowForm" @closeForm="isShowForm=false,errorMessage='',errorIdStudent=''" @create-student="createStudent" :userData="user" :messageError="errorMessage" :errorIdStudent="errorIdStudent"/>
      <delete-alert v-if="isDeleteAlert" @delete-user="deletedPerson" :userId="userId" @cancelDelete="isDeleteAlert=false" />
  </div>
</template>

<script>
import axiosHttp from '../../axios-http';
import peopleList from "../PeopleList.vue"
import studentForm from './StudentForm.vue';
import deleteAlert from "../widgets/delete/DeleteAlert.vue";
import searchBar from '../widgets/search/SearchBar.vue';

export default {
  components: {
    "people-list": peopleList,
    "student-form": studentForm,
    "delete-alert": deleteAlert,
    "searchbar-form": searchBar,
    
  },
  data() {
      return {
        isShowForm: false,
        errorMessage: "",
        listStudents:[],
        isDeleteAlert:false,
        userId:null,
        dataToShow: 3,
        showShortList: true,
        keyword:'',
        errorIdStudent: '',
        filterByBatch: "All",
      filterByClass: "All",
      }
  },
  methods: {
    getStudentData(){
      axiosHttp.get("/users/students").then((res)=>{
        this.listStudents = res.data.reverse();
      })
    },
    showStudentForm(){
      this.isShowForm = true;
    },
    showDetail(){
      this.$emit('show-detail');
    },  
    createStudent(userData,errorMessageBack) {
      axiosHttp.post('/users',userData).then((res) => {
        console.log(res.data);
        this.errorMessage = errorMessageBack;
        this.errorIdStudent = errorMessageBack;
        this.getStudentData()
        this.isShowForm = false;
      }).catch((error) =>{
        if (error.response.status === 422) {
          this.errorMessage = error.response.data.message;
        }
        if (error.response.status === 402) {
          this.errorMessage = '';
          this.errorIdStudent = error.response.data.message;
        }
      });
    },
    updateKeyword(keyword){
      this.keyword = keyword
    },
    deletedPerson(){
      this.isDeleteAlert = false;
    },
    alertDelete(id){
      this.isDeleteAlert = true;
      this.userId = id;
    },
    showAll(){
      this.showShortList = !this.showShortList;
    },
  },
  mounted(){
    this.getStudentData();
  },
  computed:{
    filterStudent(){
      let studentToDisplay = this.listStudents;
      if(this.keyword){
        studentToDisplay = this.listStudents.filter((person) => (person.first_name+" "+person.last_name+" "+person.id_student).toLowerCase().includes(this.keyword.toLowerCase()));
      }
      if (this.showShortList){
        studentToDisplay = studentToDisplay.slice(0,this.dataToShow);
      }
      if (this.filterByBatch != "All" && this.filterByClass != "All") {
        studentToDisplay = studentToDisplay.filter((person) => person.batch == this.filterByBatch && person.class == this.filterByClass);
      } else if (this.filterByBatch != "All") {
        studentToDisplay = studentToDisplay.filter((person) => person.batch == this.filterByBatch);
      } else if (this.filterByClass != "All") {
        studentToDisplay = studentToDisplay.filter((person) => person.class == this.filterByClass);
      }
      return studentToDisplay
    }
  },
}

</script>

<style>
.add-button:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  background: #1a1a1a;
  left: 60px;
  top: 26px;
  transform: translateX(-50%) rotate(45deg);
}

.add-people:hover+.add-button {
  opacity: 100;
  transition: all 0.6s ease-in-out;
}
</style>
