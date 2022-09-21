<template>
    <div class="flex items-center justify-center w-full mb-4">
    <div class="w-[80%]">
        <div class="mt-20">
            <p v-if="userDataDetail.roles == 'TEACHER'" class="text-3xl text-center capitalize">teacher informaion </p>
            <p v-if="userDataDetail.roles == 'STUDENT'" class="text-3xl text-center capitalize">student informaion </p>
            <div class="shadow bg-white flex items-center mt-5 p-8 relative rounded">
                <div class="relative" >
                    <img class="w-40 h-40 rounded-full" :src="getProfile(userDataDetail.profile)" alt="">
                </div>
                <div class="ml-5 leading-9 text-xl">
                    <b><p class="capitalize">{{userDataDetail.first_name}} {{userDataDetail.last_name}}</p></b>
                    <p>{{userDataDetail.email}}</p>
                    <p>{{userDataDetail.phone}}</p>
                </div>
            </div>
        </div>
        <div class="">  
            <div class="shadow rounded flex items-center mt-5 p-8 relative bg-white" v-if="userDataDetail.roles == 'STUDENT'">
                <svg  @click="onUpdate" class="w-12 h-12 absolute right-6 top-6 cursor-pointer shadow hover:bg-blue-500 hover:text-white rounded-full p-2 duration-300 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                <div class="ml-5 leading-9 text-xl font-bold">
                    <p>Gender</p>>
                    <p>Date of birth</p>
                    <p>Batch</p>
                    <p>Class</p>
                    <p>Personal ID</p>
                </div> 
                <div class=" leading-9 text-xl ml-20">
                    <p>{{userDataDetail.gender}}</p>
                    <p>{{studentDataDetail.date_birth}}</p>
                    <p>{{studentDataDetail.year}}</p>
                    <p class="capitalize">{{studentDataDetail.class_name}}</p>
                    <p>{{studentDataDetail.id_student}}</p>
                </div> 
            </div>
        </div>
    </div>
<form-edit :userDataDetail="userDataDetail" :studentDataDetail="studentDataDetail" v-if="isEditStudent" @closeForm="isEditStudent=false" @save-edit="saveEdit"/>
</div>

</template>

<script>
import formEdit from "./student/FormEditStudent.vue";
import axios from "../axios-http";
export default {
    components:{
        'form-edit':formEdit,
    },
    data(){
        return{
            isEditStudent:false,
            id: null,
            userDataDetail: [],
            studentDataDetail: [],
            role: null,
        }
    },

    methods:{
        onUpdate(){
            this.isEditStudent = true;
        },
        saveEdit(){
            this.isEditStudent = false;
            this.getPeopleDetail();
        },
        getPeopleDetail(){
            this.role = this.$route.params.role;
            let url = "/users/teacher/";
            if (this.role == "STUDENT"){
                url = "/users/student/";
                axios.get(url+this.$route.params.id).then((res)=>{
                    this.userDataDetail = res.data.userData[0];
                    this.studentDataDetail = res.data.studentData;
                })
            }
            else{
                axios.get(url+this.$route.params.id).then((res)=>{
                    this.userDataDetail = res.data.userData;
                })
            }
            
        },
        getProfile(image){
            return axios.defaults.baseURL + "storage/image/" + image ;
        }
    },
    mounted(){
        this.getPeopleDetail();
    }
}
</script>

<style>

</style>