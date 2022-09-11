<template>
<div class="flex items-center justify-center w-full">
    <div class="w-[80%]">
        <div class="">
            <p class="text-3xl text-center capitalize">student informaion detail</p>
            <div class="shadow bg-white flex items-center mt-5 p-8 relative rounded">
                <div class="relative" >
                    <img class="w-40 h-40 rounded-full" src="../../assets/ducati.jpeg" alt="">
                    <label for="image">
                        <svg fill="none" class="w-10 rounded-full shadow p-2 h-10 bg-white absolute right-0 top-28 cursor-pointer text-black" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </label>
                    <input type="file" id="image" hidden>
                </div>
                <div class="ml-5 leading-9 text-xl">
                    <p class="capitalize">{{userDetail.first_name}} {{userDetail.last_name}}</p>
                    <p>{{userDetail.email}}</p>
                    <p>{{userDetail.phone}}</p>
                </div>
            </div>
        </div>
        <div class="">  
            <div class="shadow rounded flex items-center mt-5 p-8 relative bg-white">
                <svg @click="onUpdate" class="w-12 h-12 absolute right-6 top-6 cursor-pointer shadow hover:bg-blue-500 hover:text-white rounded-full p-2 duration-300 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                <div class="ml-5 leading-9 text-xl font-bold">
                    <p>First name</p>
                    <p>Last name</p>
                    <p>Gender</p>
                    <p>Batch</p>
                    <p>Class</p>
                    <p>Personal ID</p>
                </div> 
                <div class=" leading-9 text-xl ml-20">
                    <p>{{userDetail.first_name}}</p>
                    <p>{{userDetail.last_name}}</p>
                    <p>{{userDetail.gender}}</p>
                    <p>{{userDetail.batch}}</p>
                    <p>{{userDetail.class}}</p>
                    <p>{{userDetail.student_id}}</p>
                </div> 
            </div>
        </div>
    </div>
</div>
<form-edit v-if="isEditStudent" @closeForm="isEditStudent=false"/>
</template>

<script>
import formEdit from "./FormEditStudent.vue";
export default {
    components:{
        'form-edit':formEdit
    },
    props:{
        userDetail: Object
    },
    data(){
        return{
            isEditStudent:false
        }
    },

    methods:{
        onUpdate(){
            this.isEditStudent = true;
        }
    },
}
</script>

<style>

</style>