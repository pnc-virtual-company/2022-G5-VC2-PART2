<template>
  <div class="home">
    <teacher/>
    <student/>
  </div>
</template>

<script>
import teacher from "./Admin/teacher/TeacherView.vue";
import student from "./Admin/student/StudentView.vue";
export default {
  components:{
    teacher,
    student
  }
}
</script>

