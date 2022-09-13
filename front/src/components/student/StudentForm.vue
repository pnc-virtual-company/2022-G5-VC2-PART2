<template>
<div class="w-full h-full bg-black z-50 bg-opacity-60 flex items-center justify-center fixed top-0">
  <div class="main-form w-[40%] ">
    <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
      <p></p>
      <h2><b>Create Student</b></h2>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" @click="$emit('closeForm')">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>

    </div>
    <form class="shadow p-4 bg-white" @submit.prevent="createNewStudent">
      <div class="flex w-full justify-between  mb-2">
        <div class="w-full mr-2 mb-2">
          <b><label for="firstNameInput">First name</label></b>
          <br />
          <input
            type="text"
            class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            name="firstNameInput"
            id="firstNameInput"
            placeholder="First name ..."
            v-model="firstName"
            :class="{'border-red-600' :forgotFirstName}"
          />
          <p>{{forgotFirstName}}</p>
        </div>
        <div class="w-full">
          <b><label for="lastNameInput">Last name</label></b>
          <br />
          <input
            type="text"
            name="lastNameInput"
            class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="lastNameInput"
            placeholder="Last name ..."
            v-model="lastName"
            :class="{'border-red-600' :forgotLastName}"
          />
          <p>{{forgotLastName}}</p>
        </div>
      </div>
      <div class="email mb-2">
        <b><label for="emailInput">Email</label></b>
        <br />
        <input
          type="email"
          name="emailInput"
          class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
          id="emailInput"
          placeholder="Email ..."
          v-model="email"
          :class="{'border-red-600' :messageError + forgotEmail}"
        />
        <p>{{messageError}}</p>
        <p>{{forgotEmail}}</p>
      </div>
      <div class="phone mb-2">
        <b><label for="phoneInput">Phone</label></b>
        <br />
        <input
          type="phone"
          name="phoneInput"
          class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
          id="phoneInput"
          placeholder="Phone ..."
          v-model="phoneNumber"
        />
        <span>Optional*</span>
      </div>
      <div class="flex mb-2 box-border relative">
        <div>
          <b><label for="batchInput">Batch</label></b>
          <br />
          <input
            type="number"
            name="batchInput"
            class="shadow appearance-none border mr-1 rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="batchInput"
            placeholder="Batch ..."
            v-model="batch"
            :class="{'border-red-600' :forgotBatch}"
          />
          <p>{{forgotBatch}}</p>
        </div>
        <div>
          <b><label for="classInput">Class</label></b>
          <br />
          <input
            type="text"
            name="classInput"
            class="shadow appearance-none ml-1 border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="classInput"
            placeholder="Class ..."
            v-model="classes"
            :class="{'border-red-600' :forgotClass}"
          />
          <p>{{forgotClass}}</p>
        </div>
        <div>
          <b><label for="studentIdInput">Student ID</label></b>
          <br />
          <input
            type="text"
            name="studentIdInput"
            class="shadow appearance-none border ml-1 rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="studentIdInput"
            placeholder="Id ..."
            v-model="idStudent"
            :class="{'border-red-600' :forgotIdStudent + errorIdStudent}"
          />
          <p>{{forgotIdStudent}}</p>
          <p>{{errorIdStudent}}</p>
        </div>
      </div>
      <div class="gender mr-2 mb-2">
        <b>Gender</b>
        <div class="mt-2 flex">
          <div class="male">
            <input type="radio" class="ml-2 cursor-pointer" name="gender" value="Male" id="maleClick" v-model="gender"/>
            <label for="maleClick" class="ml-2 cursor-pointer">Male</label>
          </div>
          <div class="female ml-8">
            <input type="radio" class="ml-2 cursor-pointer" name="gender" value="Female" id="femaleClick" v-model="gender"/>
            <label for="femaleClick" class="ml-2 cursor-pointer">Female </label>
          </div>
        </div>
      </div>
      <div class="flex justify-end">
        <button type="button" @click="$emit('closeForm')" class="bg-red-500 hover:bg-red-600  text-white p-1.5 px-3  rounded focus:outline-none focus:shadow-outline">Cancel</button>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 mx-2 text-white p-1.5 px-3 rounded focus:outline-none focus:shadow-outline">Add Student</button>
      </div>
    </form>
  </div>
</div>
</template>
<script>
import axiosHttp from '../../axios-http';
export default{
  emits: ['create-student'],
  props:['messageError','errorIdStudent'],
  data() {
    return {
      firstName: '',
      lastName: '',
      email: '',
      batch: '',
      classes: '',
      studentId: null,
      gender: 'Male',
      phoneNumber: null,
      idStudent: null,
      forgotFirstName: '',
      forgotLastName: '',
      forgotEmail: '',
      forgotBatch: '',
      forgotClass: '',
      forgotIdStudent: '',
    }
  },
  methods: {
    createNewStudent() {
      if (this.firstName === '') {
        this.forgotFirstName = 'Please put first name!*';
      }else if(this.lastName === '') {
        this.forgotFirstName = '';
        this.forgotLastName = 'Please put last name!*';
      }else if(this.email === '') {
        this.forgotFirstName = '';
        this.forgotLastName = '';
        this.forgotEmail = 'Please put email!*';
      }else if(this.batch === '') {
        this.forgotFirstName = '';
        this.forgotLastName = '';
        this.forgotEmail = '';
        this.forgotBatch = 'Please put batch!*';
      }else if(this.classes === '') {
        this.forgotBatch = '';
        this.forgotClass = 'Please put class!*';
      }else if(this.idStudent === null){
        this.forgotClass = '';
        this.forgotIdStudent = 'Please put Id student!*';
      }
      else{
        let userData = {
          first_name: this.firstName,
          last_name: this.lastName,
          email: this.email,
          password: this.generatePassword(),
          gender: this.gender,
          roles: 'STUDENT',
          student_id: this.studentId,
          id_student: this.idStudent,
          class: this.classes,
          batch: this.batch,
          phone: this.phoneNumber
        };
        this.$emit('create-student',userData);
      }
      
    },
    generatePassword() {
      let chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      let stringLength = 8;
      let randomString = "";
      for (let i = 0; i < stringLength; i++) {
        let rnum = Math.floor(Math.random() * chars.length)
        randomString += chars.substring(rnum, rnum + 1);
      }
      this.password = randomString;
      return this.password;
    },
    getLastStudentId() {
      axiosHttp.get('/students/getLastStudent').then(res => {
        if (res.data == []) {
          this.studentId = 1
        }else{
          this.studentId = res.data.id + 1;
        }
      })
    }
  },
  watch: {
    lastName: function(newValue) {
      if (newValue != '') {
        this.email = this.firstName.toLowerCase().trim() + '.' + newValue.toLowerCase().trim() + '@student.passerellesnumeriques.org';
      }else{
        this.email = '';
      }
    }
  },
  mounted() {
    this.getLastStudentId();
  }
}

</script>
<style scoped>
p{
  color: red;
  font-size: 15px;
}
span{
  color: rgb(61, 61, 254);
  font-size: 13px;
  margin: 0;
  padding: 0;
}
</style>
