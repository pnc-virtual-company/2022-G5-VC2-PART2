<template>
  <div class="mt-24 mb-24">
    <div v-if="!isShowDetail">
      <teacher @show-detail="isShowDetail=true"/>
      <student @show-detail="isShowDetail=true"/>
    </div>
    <div v-else>
        <svg @click="isShowDetail=false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 shadow cursor-pointer ml-4 hover:bg-white h-10 rounded p-2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
      <student-detail/>
    </div>
  </div>
</template>

<script>
import teacher from "./teacher/TeacherView.vue"
import student from "./student/StudentView.vue"
import StudentDetail from "../../../components/student/StudentDetail.vue";
export default {
  components:{
    teacher,
    student,
    "student-detail": StudentDetail,
  },
  data(){
    return {
      isShowDetail:false
    }
  }
}
</script>
