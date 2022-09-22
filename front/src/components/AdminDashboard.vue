<template>
    <div class="w-[90%] h-auto mt-32 m-auto flex justify-center rounded shadow p-4 relative text-white">
        <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh] mt-2">
            <router-link to="/teacher" class="hover:bg-slate-100 duration-200 ease-in-out">
                <h1 class="bg-blue-600 flex justify-center p-2">Teacher</h1>
                <div class=" w-full h-full p-4 relative hover:bg-slate-100 duration-200 ease-in">
                    <img src="../assets/teacher.png" alt="" class="w-[60%] h-full">
                    <span class="absolute top-12 text-6xl text-primary right-12">{{numberTeacher}}</span>
                </div>
            </router-link>
        </div>
        <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh] mt-2">
            <router-link to="/student" class=" hover:bg-slate-100 duration-200 ease-in-out">
                <h1 class="bg-blue-600 flex justify-center p-2">Student</h1> 
                <div class="w-full h-full p-4 relative hover:bg-slate-100 duration-200 ease-in">
                    <img src="../assets/student.png" alt="" class="w-[60%] h-full">
                    <span class="absolute top-12 text-6xl text-primary right-12">{{numberStudent}}</span>
                </div>
            </router-link>
        </div>
        <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh] mt-2">
            <router-link to="/followUp" class="hover:bg-slate-100 duration-200 ease-in-out">
                <h1 class="bg-blue-600 flex justify-center p-2">Student Follow up</h1>
                <div class="w-full h-full p-4 relative hover:bg-slate-100 duration-200 ease-in">
                    <img src="../assets/followup.png" alt="" class="w-[60%] h-full">
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