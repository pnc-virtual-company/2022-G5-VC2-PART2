<template>
  <teacher-list :listTeachers="listTeachers" />
</template>

<script>
import TeacherList from "../../../../components/teacher/TeacherList.vue";
export default {
  components: {
    "teacher-list": TeacherList,
  },
  data() {
    return {
      listTeachers: [
        {
          id: "1",
          roles: "teacher",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "Rady",
          lastName: "Y",
          email: "mey@student.passerellesnumeriques.com",
        },
        {
          id: "2",
          roles: "teacher",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "Him",
          lastName: "Hey",
          email: "mey@student.passerellesnumeriques.com",
        },
        {
          id: "3",
          roles: "teacher",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "Ronan",
          lastName: "The best",
          email: "mey@student.passerellesnumeriques.com",
        },
        {
          id: "4",
          roles: "teacher",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "Mengheang",
          lastName: "Pho",
          email: "sreykea.reun@student.passerellesnumeriques.com",
        },
        {
          id: "4",
          roles: "teacher",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "Mengheang",
          lastName: "Pho",
          email: "sreykea.reun@student.passerellesnumeriques.com",
        },
        {
          id: "4",
          roles: "teacher",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "Mengheang",
          lastName: "Pho",
          email: "sreykea.reun@student.passerellesnumeriques.com",
        },
        {
          id: "4",
          roles: "teacher",
          profile:
            "https://image.winudf.com/v2/image1/Y29tLmxha25haWRyaWFwcHMuZ2lybHNjYXJ0b29uX3NjcmVlbl80XzE2Mjg5NDQxNjBfMDM3/screen-4.jpg?fakeurl=1&type=.webp",
          firstName: "Mengheang",
          lastName: "Pho",
          email: "sreykea.reun@student.passerellesnumeriques.com",
        },
        
      ],
    };
  },
};
</script>

<style></style>