<template>
  <student-list :user="user"/>
</template>

<script>

import StudentList from "../../../../components/student/StudentList.vue";
export default {
  components: {
    "student-list": StudentList,
  },
  props: {
    user: Object
  }
};
</script>

<style></style>