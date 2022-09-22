<template>
    <div class="w-[90%] h-auto mt-24 m-auto bg-white flex justify-center items-center rounded shadow p-4 relative text-primary">
        <div class="w-full flex h-36 box-border justify-center items-center rounded shadow p-4 relative text-primary">  
            <div class="w-3/12">
                <img src="../assets/welcome.png" alt="" class="w-full h-full">
            </div>
            <h1 class="w-4.5/12 text-xl break">Welcome to Student follow up system management</h1>
            <div class="w-3/12 box-border">
                <img src="../assets/student.png" alt="" class="w-full h-full">
            </div>
        </div>
    </div>
    <div class="w-[90%] h-auto mt-6 m-auto flex justify-center rounded shadow p-4 relative text-white bg-white">
        <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
            <router-link to="/teacher" >
                <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Teacher</h1>
                <div class=" w-full h-full p-4 relative">
                    <img src="../assets/teacher.png" alt="" class="w-[60%] h-full mb-4">
                    <span class="absolute top-12 text-6xl text-primary right-12">{{numberTeacher}}</span>
                </div>
            </router-link>
        </div>
        <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
            <router-link to="/student">
                <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Student</h1> 
                <div class="w-full h-full p-4 relative">
                    <img src="../assets/students.png" alt="" class="w-[60%] h-full">
                    <span class="absolute top-12 text-6xl text-primary right-12">{{numberStudent}}</span>
                </div>
            </router-link>
        </div>
        <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
            <router-link to="/followUp">
                <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Student In Follow up</h1>
                <div class="w-full h-full p-4 relative">
                    <img src="../assets/student.png" alt="" class="w-[60%] h-full">
                    <span class="absolute top-12 text-6xl text-primary right-12" >{{numberFollowup}}</span>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
import axios from "../axios-http"
export default {
    data(){
        return{
            numberTeacher: null,
            numberStudent: null,
            numberFollowup: null,
        }
    },
    created(){
        axios.get('/users/teacherOnly').then((res)=>{
            this.numberTeacher = res.data.lenth;
        })
        axios.get('/users/studenOnly').then((res)=>{
            this.numberStudent = res.data.lenth;
        })
        axios.get('/follow_ups').then((res)=>{
            this.numberFollowup = res.data.lenth;
        })
    }
}
</script>

<style>

</style>