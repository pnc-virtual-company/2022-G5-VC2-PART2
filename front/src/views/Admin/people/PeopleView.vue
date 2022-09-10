<template>
  <div class="mt-24">
    <teacher/>
    <student/>
  </div>
</template>

<script>
import teacher from "./teacher/TeacherView.vue"
import student from "./student/StudentView.vue"
export default {
  components:{
    teacher,
    student
  }
}
</script>
