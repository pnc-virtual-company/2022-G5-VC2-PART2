<template>
  <div class="w-full h-full bg-black z-50 bg-opacity-60 flex items-center justify-center fixed top-0">
    <div class="main-form w-[50%] bg-gray-200 rounded">
      <div class="p-2  text-center flex justify-between text-lg uppercase">
        <p></p>
        <h2>add student to follow up</h2>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-6 h-6 cursor-pointer" @click="$emit('closeForm')">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
      <form @submit.prevent="onAddStudent" class="ml-9 mt-5 relative">
        <label>Search list student </label>
        <input
          class="shadow appearance-none border  rounded w-[95%] px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
          type="text" v-model="searchStudent" placeholder="Search . . ." @click="showListStudent">
        <p>{{messageError}}</p>
        <div v-if="isShowListStudent">
          <ul class="overflow-y-scroll bg-white h-[16rem] w-[95%] absolute" @click="showListStudent">
            <div class="flex p-2 cursor-pointer hover:bg-gray-200 ease-in duration-400"
              v-for:="(student, i ) in filterStudent" @click="clickStudent(student)">
              <li class="ml-2"><img :src="getProfile(student.profile)"
                  class="w-12 h-12 rounded-full border-2 border-primary "></li>
              <li class="p-3 ml-2 " :class="i==0?'font-bold':''">{{student.first_name}} {{student.last_name}} {{student.student_id}}</li>
            </div>
          </ul>
        </div>
        <!-- for search tutor -->
        <label class="mt-2">Assign tutor </label>
        <input
          class="shadow appearance-none border  rounded w-[95%] px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
          type="text" v-model="searchTutor" placeholder="Search . . ." @click="showListTutor">
        <div v-if="isShowListTutor">
          <ul class=" bg-white h-[13rem] w-[95%] absolute" @click="showListTutor">
            <div class="flex p-2 cursor-pointer hover:bg-gray-200 ease-in duration-400"
              v-for:="(tutor, i ) in filterTutor" @click="clickTutor(tutor)">
              <li class="ml-2"><img :src="getProfile(tutor.profile)"
                  class="w-12 h-12 rounded-full border-2 border-primary "></li>
              <li class="p-3 ml-2 " :class="i==0?'font-bold':''">{{tutor.first_name}} {{tutor.last_name}}</li>
            </div>
          </ul>
        </div>
        <div class="w-[95%] bg-white shadow appearance-none border mt-5">
          <div class=" bg-blue-300 appearance-none border">
            <h2 class="p-2">Root Problem</h2>
          </div>
          <div class="  mt-2">
            <div class="flex justify-around">
              <div>
                <div class="flex  items-center mb-2">
                  <input v-model="type" id="default-checkbox" type="checkbox" value="family"
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
                  <label class="ml-2">Family</label>
                </div>
                <div class="flex items-center mb-1">
                  <input v-model="type" id="default-checkbox" type="checkbox" value="communication"
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
                  <label class="ml-2">Communication</label>
                </div>
              </div>

              <div>
                <div class="flex items-center mb-1">
                  <input v-model="type" id="default-checkbox" type="checkbox" value="relationship"
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
                  <label class="ml-2">Relationship</label>
                </div>
                <div>
                  <div class="flex items-center mb-1">
                    <input v-model="type" id="default-checkbox" type="checkbox" value="attitude"
                      class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
                    <label class="ml-2">Attitude</label>
                  </div>
                </div>
                
              </div>
              <div>
                <div class="flex items-center mb-1">
                  <input v-model="type" id="default-checkbox" type="checkbox" value="study"
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
                  <label class="ml-2">Study</label>
                </div>
                <div class="flex items-center mb-1">
                  <input v-model="type" id="default-checkbox" type="checkbox" value="health"
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
                  <label class="ml-2">Health</label>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="mt-4">
          <label>Description</label>
          <textarea v-model="description" class="mt-2 p-2 w-[95%] resize-none focus:outline-blue-500 focus:shadow-outline" name="" id="" cols="20" rows="2"
            placeholder="Description . . ." required></textarea>
        </div>
        <div class="flex justify-end p-2 mr-10 w-[98%]">
          <button-cancel @click="$emit('closeForm')">
            <template v-slot:button_cancel>Cancel</template>
          </button-cancel>
          <button-create>
            <template v-slot:button_create>Add Student</template>
          </button-create>
        </div>
      </form>

    </div>
  </div>
</template>

<script>
import axios from "../../axios-http";
export default {
  emits: ['add-student'],
  data() {
    return {
      isShowListStudent: false,
      isShowListTutor: false,
      description: "",
      student_id: "",
      tutor_id: "",
      type: [],
      searchStudent: "",
      searchTutor: "",
      listStudents: [],
      listTutor: [],
      messageError: '',
    }
  },

  methods: {
    showListStudent() {
      this.isShowListStudent = !this.isShowListStudent
    },
    showListTutor() {
      this.isShowListTutor = !this.isShowListTutor
    },

    clickStudent(student) {
      this.searchStudent = student.first_name + " " + student.last_name
      this.student_id = student.student_id;
    },
    clickTutor(tutor) {
      this.searchTutor = tutor.first_name + " " + tutor.last_name
      this.tutor_id = tutor.id;
      console.log(tutor)
    },

    getStudentData() {
      axios.get("/users/students").then((res) => {
        this.listStudents = res.data.reverse();
        console.log(this.listStudents);
      })
    },
    getTutorData() {
      axios.get("/users/teachers").then((res) => {
        this.listTutor = res.data.reverse();
      })
    },
    getProfile(image) {
      return axios.defaults.baseURL + "storage/image/" + image;
    },

    // function to add student into the followup 
    onAddStudent() {
      let newFollowUpInfo = {
        student_id: this.student_id,
        description: this.description,
        type: this.type,
        user_id: this.tutor_id
      };
      console.log(newFollowUpInfo);
      axios.post('/users/follow_ups/', newFollowUpInfo).then(res => {
        console.log(res.data)
        this.$emit('add-student');
      }).catch((error) => {
        if (error.response.status == 402) {
          this.messageError = error.response.data.message;
        } else {
          this.messageError = error.response.data.message
        }
      });
    }
  },
  computed: {
    filterStudent() {
      if (this.searchStudent == "") {
        return this.listStudents;
      } else {
        return this.listStudents.filter(student => (student.first_name + " " + student.last_name).toLowerCase().includes(this.searchStudent.toLowerCase()))
      }
    },
    filterTutor() {
      if (this.searchTutor == "") {
        return this.listTutor;
      } else {
        return this.listTutor.filter(tutor => (tutor.first_name + " " + tutor.last_name).toLowerCase().includes(this.searchTutor.toLowerCase()))
      }
    },
  },
  mounted() {
    this.getStudentData()
    this.getTutorData()
  }

}
</script>

<style>

</style>