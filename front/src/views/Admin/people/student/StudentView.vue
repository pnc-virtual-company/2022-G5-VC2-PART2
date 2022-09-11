<template>
  <student-list :listStudents="listStudents" />

</template>

<script>

import StudentList from "../../../../components/student/StudentList.vue";
export default {
  components: {
    "student-list": StudentList,
  },
  data() {
    return {
      listStudents: [
        {
          id: "1",
          role: "student",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "John",
          lastName: "Mey",
          gender: "Female",
          class: "WEB B",
          email: "mey@student.passerellesnumeriques.com",
        },
        {
          id: "2",
          role: "student",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "John",
          lastName: "sauth",
          gender: "Male",
          class: "WEB A",
          email: "mey@student.passerellesnumeriques.com",
        },
        {
          id: "3",
          role: "student",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "nana",
          lastName: "kaka",
          gender: "Female",
          class: "WEB B",
          email: "mey@student.passerellesnumeriques.com",
        },
        {
          id: "4",
          role: "student",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "sreyka",
          lastName: "riya",
          gender: "Female",
          class: "WEB B",
          email: "sreykea.reun@student.passerellesnumeriques.com",
        },
      ],
    };
  },
};
</script>

<style></style>