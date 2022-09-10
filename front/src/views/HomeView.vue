<template>
  <!-- <div class="home">
    <img alt="Vue logo" src="../assets/logo.png" width="100">
    <HelloWorld msg="WELCOME TO VIRTUAL COMPANY II 2022"/>
  </div> -->
  <StudentForm />
</template>

<script>
// @ is an alias to /src
import StudentForm from "@/components/student/StudentForm.vue";

export default {
  components: {
    StudentForm,
  }
}
</script>
