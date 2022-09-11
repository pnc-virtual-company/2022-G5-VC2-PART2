<template>
  <div class="w-[90%] m-auto mt-4">
    <div class="flex justify-between">
      <h2 class="text-2xl">Teachers</h2>
      <div class="relative">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="add-people w-12 h-9 rounded shadow hover:bg-blue-600  bg-white cursor-pointer p-2 "
            @click="showTeacherForm"
        >
            <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
            />
        </svg>
        <div class="add-button absolute -top-12 z-50 text-center opacity-0 -right-10 text-sm w-32 bg-gray-900 rounded-full text-white p-1.5">Add new teacher</div>
      </div>
    </div>
    <div class="rounded shadow p-4 relative mt-2">
      <div class="flex justify-end items-center">
        <label for="">Search</label>
        <input
          type="text"
          class="rounded p-2 shadow ml-3 outline-none border"
          placeholder="search teacher"
        />
      </div>
      <div class="flex justify-center mt-4">
        <people-list :peopleList="listTeachers" :dataToShow="dataToShow"/>
      </div>
        <div class="rounded p-2 m-auto mt-4 w-full flex justify-center relative" v-if="listTeachers.length > dataToShow">
            <button class="flex shadow p-2 px-3 rounded hover:bg-blue-500 absolute bg-white" @click="dataToShow = listTeachers.length">
                Views all
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>   
        </div>
    </div>
  </div>
    <teacher-form v-if="isShowForm" @closeForm="isShowForm=false" />
</template>

<script>
import peopleList from "../PeopleList.vue"
import teacherForm from "./TeacherForm.vue";
export default {
    components:{
        "people-list": peopleList,
        "teacher-form":teacherForm,
    },
    props: {
        listTeachers: Array,
    },
    data(){
      return {
        isShowForm:false,
        dataToShow: 6,
      }
    },
    methods: {
      showTeacherForm(){
        this.isShowForm = true;
      }
    }
};
</script>

<style></style>
