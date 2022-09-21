<template>
  <div>
    <div class="w-[90%] m-auto mt-20 mb-5  p-4 rounded">
      <div class="relative  mt-0 mb-2 w-full" v-if="isSuccess" >
          <alert-success :content="message"/>
      </div>
      <div class="flex justify-between">
        <h2 class="text-2xl">Students</h2>
        <div class="flex" v-if="user.roles == 'Coordinator'">
            <div class="relative mr-2">
            <router-link to="/batch">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="add-people w-12 h-10 rounded shadow hover:bg-slate-200 bg-white cursor-pointer p-2 text-primary">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
            </svg>
            <div class="add-button absolute -top-12 z-50 text-center opacity-0 -right-10 text-sm w-32 bg-[#1a1a1a] rounded-full text-white p-1.5">
              See the batch
            </div>
            </router-link>
            </div>
            <div class="relative">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="add-people w-14 h-10 rounded shadow hover:bg-slate-200 bg-white cursor-pointer p-2 text-primary"
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
      </div>
      <div class="rounded shadow p-4 mt-2 bg-white">
        <div class="flex justify-between">
          <div class="flex">
              <div class="flex justify-between">
                <label for="filter-status" class="mx-3 font-medium mt-2"><span class="text-red-600">*</span>Filter By
                  Batch:
                </label>
                <select v-model="filterByBatch" id="filter-status" @change="filterStudent"
                  class="shadow appearance-none w-44 rounded border border-gray-250 p-[0.4rem] focus:border-2 focus:outline-none focus:border-primary">
                  <option value="All">All</option>
                  <option v-for="(batch,index) in allBatch" :key="index" :value="batch.id">{{batch.year}}</option>
                </select>
              </div>
            <div class="flex justify-between">
              <label for="filter-status" class="mx-3 font-medium mt-2"><span class="text-red-600">*</span>Filter By
                Class:
              </label>
              <select v-model="filterByClass" id="filter-status" @change="filterStudent"
                class="shadow appearance-none w-44 rounded border border-gray-250 p-[0.4rem] focus:border-2 focus:outline-none focus:border-primary">
                <option value="All">All</option>
                <option v-for="(oneClass,index) in allClass" :key="index" :value="oneClass.id">{{oneClass.class_name}}</option>
              </select>
            </div>
  
          </div>
          <searchbar-form @newKeyword="filterSearch" placeholder="Search Name "/>
        </div>
        <div class="flex justify-center mt-4 w-full">
          <people-list :peopleList="listStudents" @showDetail="showDetail" @alertDelete="alertDelete"/>
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
        <div v-else-if="listStudents.length === 0" class="flex flex-col items-center mt-8 mb-3">
          <img class="w-40" src="./../../assets/noRequestFound.png" alt="Image not found">
          <h1 class="text-stone-500 mt-5 ">No Student!</h1>
        </div>
          <div class="rounded p-2 m-auto mt-4 w-full flex justify-center relative" v-if="listStudents.length > 3" >
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
      <delete-alert v-if="isDeleteAlert" @delete-user="deletedPerson" :id="userId" @cancelDelete="isDeleteAlert=false" />
  </div>
</template>

<script>
import axiosHttp from '../../axios-http';
import peopleList from "../PeopleList.vue"
import studentForm from './StudentForm.vue';
import deleteAlert from "../widgets/action/DeleteAlert.vue";
import searchBar from '../search/SearchBar.vue';
import alertSuccess from "../widgets/AlertSuccess.vue"
export default {
  components: {
    "people-list": peopleList,
    "student-form": studentForm,
    "delete-alert": deleteAlert,
    "searchbar-form": searchBar,
    "alert-success" : alertSuccess
    
  },
  props: {
    user: Object
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
        errorIdStudent: '',
        filterByBatch: "All",
        filterByClass: "All",
        allBatch: [],
        allClass: [],
        isSuccess : false,
        loading: true,
        message: "Created student successful"
      }
  },
  methods: {
    getStudentData(){
      axiosHttp.get("/users/students").then((res)=>{
        this.listStudents = res.data.reverse();
        console.log(this.listStudents);
      })
    },
    showStudentForm(){
      this.isShowForm = true;
    },
    showDetail(){
      this.$emit('show-detail');
    },  
    createStudent(userData,errorMessageBack) {
      axiosHttp.post('/users',userData).then(() => {
        this.errorMessage = errorMessageBack;
        this.errorIdStudent = errorMessageBack;
        this.isSuccess  = true
        this.isShowForm = false;
        this.getStudentData();
        setTimeout(() => {
          this.isSuccess = false;
        },4000);
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
    deletedPerson(){
      this.getStudentData();
      this.isDeleteAlert = false;
    },
    alertDelete(id){
      this.isDeleteAlert = true;
      this.userId = id;
      console.log(id);
    },
    showAll(){
      this.showShortList = !this.showShortList;
    },
    getAllBatch() {
      axiosHttp.get('/batches').then(res => {
        this.allBatch = res.data;
      });
    },
    getAllClass() {
      axiosHttp.get('/classes').then(res => {
        this.allClass = res.data;
      });
    },
    filterStudent() {
      if (this.filterByBatch !== 'All' && this.filterByClass !== 'All') {
        axiosHttp.get('/users/students').then(res => {
          this.listStudents = res.data.filter((student) => student.class_id == this.filterByClass && student.batch_id == this.filterByBatch);
        });
      }else if (this.filterByBatch == 'All' && this.filterByClass !== 'All') {
        axiosHttp.get('/users/students').then(res => {
          this.listStudents = res.data.filter((student) => student.class_id == this.filterByClass);
        });
      }
      else if (this.filterByClass == 'All' && this.filterByBatch !== 'All') {
        axiosHttp.get('/users/students').then(res => {
          this.listStudents = res.data.filter((student) => student.batch_id == this.filterByBatch);
        });
      }else
      {
        this.getStudentData();
      }
    },
    filterSearch(keyword) {
      axiosHttp.get('users/students').then(res => {
        this.listStudents = res.data.filter((student) => student.first_name.toLowerCase().includes(keyword.toLowerCase()) || student.last_name.toLowerCase().includes(keyword.toLowerCase()));
      });
    }
  },
  mounted(){
    setTimeout(() => {
      this.loading = false;
    },1000);
    this.getStudentData();
    this.getAllBatch();
    this.getAllClass();
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
