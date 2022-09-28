<template>
<div>
    <div v-if="userRole !== 'STUDENT'">
        <div class="w-[90%] h-auto mt-24 m-auto bg-white flex justify-center items-center rounded shadow p-4 relative text-primary">
            <div class="w-full flex h-36 box-border justify-center items-center rounded shadow p-4 relative text-primary">  
                <div class="w-3/12">
                    <img src="../../../assets/welcome.jpg" alt="" class="w-[80%] h-full">
                </div>
                <h1 class="w-4.5/12 text-xl break"><b>Welcome to Student follow up system management</b></h1>
                <div class="w-3/12 box-border">
                    <img src="../../../assets/student.jpg" alt="" class="w-[50%] h-full">
                </div>
            </div>
        </div>
        <div class="w-[90%] h-auto mt-6 m-auto flex justify-center rounded shadow p-4 relative text-white bg-white">
            <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
                <router-link to="/teacher" >
                    <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Teacher</h1>
                    <div class=" w-full h-full p-4 relative">
                        <img src="../../../assets/teacher.jpg" alt="" class="w-[50%] mb-4">
                        <span class="absolute top-12 text-6xl text-primary right-12">{{numberTeacher}}</span>
                    </div>
                </router-link>
            </div>
            <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
                <router-link to="/student">
                    <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Student</h1> 
                    <div class="w-full h-full p-4 relative">
                        <img src="../../../assets/student.jpg" alt="" class="w-[50%]">
                        <span class="absolute top-12 text-6xl text-primary right-12">{{numberStudent}}</span>
                    </div>
                </router-link>
            </div>
            <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
                <router-link to="/followUp">
                    <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Student In Follow up</h1>
                    <div class="w-full h-full p-4 relative">
                        <img src="../../../assets/student.jpg" alt="" class="w-[50%]">
                        <span class="absolute top-12 text-6xl text-primary right-12" >{{numberFollowup}}</span>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="w-[90%] h-auto mt-24 m-auto bg-white flex justify-center items-center rounded shadow p-4 relative text-primary">
            <div class="w-full flex h-36 box-border justify-center items-center rounded shadow p-4 relative text-primary">  
                <div class="w-3/12">
                    <img src="../../../assets/welcome.jpg" alt="" class="w-[80%] h-full">
                </div>
                <h1 class="w-4.5/12 text-xl break"><b>Welcome to Student follow up system management</b></h1>
                <div class="w-3/12 box-border">
                    <img src="../../../assets/student.jpg" alt="" class="w-[50%] h-full">
                </div>
            </div>
        </div>
        <div class="w-[90%] h-auto mt-6 m-auto flex justify-center rounded shadow p-4 relative text-white bg-white">
            <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-auto">
                <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Respect</h1> 
                <div class="w-full h-auto p-4 relative flex justify-center items-center">
                    <img src="../../../assets/student.jpg" alt="" class="w-[80%]">
                </div>
            </div>
            <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
                <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Responsibility</h1> 
                <div class="w-full h-auto p-4 relative flex justify-center items-center">
                    <img src="../../../assets/student.jpg" alt="" class="w-[80%]">
                </div>
            </div>
            <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
                <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Solidarity</h1> 
                <div class="w-full h-auto p-4 relative flex justify-center items-center">
                    <img src="../../../assets/student.jpg" alt="" class="w-[80%]">
                </div>
            </div>
            <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
                <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Trust</h1> 
                <div class="w-full h-auto p-4 relative flex justify-center items-center">
                    <img src="../../../assets/student.jpg" alt="" class="w-[80%]">
                </div>
            </div>
            <div class="rounded shadow  bg-slate-200 mr-2 w-[60%] h-[40vh]">
                <h1 class="bg-primary flex justify-center p-2 text-lg font-bold">Deminding Approch</h1> 
                <div class="w-full h-auto p-4 relative flex justify-center items-center">
                    <img src="../../../assets/student.jpg" alt="" class="w-[80%]">
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from '../../../axios-http';
export default {
    data(){
        return{
            numberTeacher: null,
            numberStudent: null,
            numberFollowup: null,
            userRole : null,
        }
    },
    methods:{
        getAll(){
            axios.get('/users/teachers').then((res)=>{
                this.numberTeacher = res.data.length;
            });
            axios.get('/users/students').then((res)=>{
                this.numberStudent = res.data.length;
            });
            axios.get('/follow_ups').then((res)=>{
                this.numberFollowup = res.data.length;
            });
        },
        getRole() {
            this.userRole = localStorage.getItem('role');
        }
    },
    mounted() {
        this.getRole();
        this.getAll();
    }
}
</script>

<style>

</style>