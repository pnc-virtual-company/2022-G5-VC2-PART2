<template>
  <student-list :listStudents="listStudents" @show-detail="showDetail"/>
</template>

<script>

import StudentList from "../../../../components/student/StudentList.vue";

export default {
  components: {
    "student-list": StudentList,

  },
  emits:['show-detail'],
  data() {
    return {
      isShowDetail:false,
    };
  },
  methods:{
    showDetail(){
      this.$emit('show-detail');
    }
  }
};
</script>

<style></style>