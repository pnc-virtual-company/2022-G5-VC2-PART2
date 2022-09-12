<template>
  <teacher-list @show-detail="showDetail"/>
</template>

<script>
import TeacherList from "../../../../components/teacher/TeacherList.vue";
export default {
  components: {
    "teacher-list": TeacherList,
  },
  emits:['show-detail'],
  methods:{
    showDetail(){
      this.$emit('show-detail');
    }
  }
};
</script>

<style></style>