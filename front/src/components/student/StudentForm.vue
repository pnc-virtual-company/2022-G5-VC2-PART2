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
          <select class="form-select w-[12.2vw] shadow appearance-none border rounded px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline" v-model="batch">
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
          </select>
        </div>
        <div>
          <b><label for="classInput">Class</label></b>
          <br />
          <select class="form-select w-[12.2vw] shadow appearance-none ml-1 border rounded px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline" v-model="classes">
            <option value="WEB A">WEB A</option>
            <option value="WEB B">WEB B</option>
            <option value="WEB C">WEB C</option>
            <option value="SNA">SNA</option>
          </select>
        </div>
        <div>
          <b><label for="studentIdInput">Student ID</label></b>
          <br />
          <input
            type="text"
            name="studentIdInput"
            class="shadow appearance-none border ml-1 mr-6 rounded w-[12.2vw] px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="studentIdInput"
            placeholder="PNC_2022_000....."
            v-model="idStudent"
            :class="{'border-red-600' :forgotIdStudent + errorIdStudent}"
          />
          <p>{{errorIdStudent}}</p>
        </div>
      </div>
      <div class="{}">
        <b><label for="classInput">Date of Birth</label></b>
        <input
            type="date"
            name="studentDateBirth"
            class="shadow appearance-none border ml-1 mr-6 rounded w-[98%] px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            v-model="dateOfBirth"
            :class="{'border-red-600' :forgotDateBirth}"
          />
           <p>{{forgotDateBirth}}</p>
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
import axiosHttp from '../../axios-http';
export default{
  emits: ['create-student'],
  props:['messageError','errorIdStudent'],
  data() {
    return {
      firstName: '',
      lastName: '',
      email: '',
      batch: '2022',
      classes: 'WEB A',
      studentId: null,
      gender: 'Male',
      phoneNumber: null,
      idStudent: null,
      dateOfBirth: '',
      forgotFirstName: '',
      forgotLastName: '',
      forgotEmail: '',
      forgotIdStudent: '',
      forgotDateBirth: '',
    }
  },
  methods: {
    createNewStudent() {
      if (this.firstName === '') {
        this.forgotLastName = '';
        this.forgotFirstName = 'Please put first name!*';
      }else if(this.lastName === '') {
        this.forgotFirstName = '';
        this.forgotLastName = 'Please put last name!*';
      }else if(this.email === '') {
        this.forgotFirstName = '';
        this.forgotLastName = '';
        this.forgotEmail = 'Please put email!*';
      }else if(this.idStudent === null){
        this.forgotFirstName = '';
        this.forgotLastName = '';
        this.forgotIdStudent = 'Please put Id student!*';
      }
      else if(this.dateOfBirth === '') {
        this.forgotIdStudent = '';
        this.forgotDateBirth = 'Please put date of birth!*';
      }
      else{
        this.forgotIdStudent = '';
        this.forgotDateBirth = '';
        let errorMessageBack = '';
        let userData = {
          first_name: this.firstName,
          last_name: this.lastName,
          email: this.email,
          password: this.generatePassword(),
          gender: this.gender,
          roles: 'STUDENT',
          student_id: this.studentId,
          id_student: this.idStudent,
          class_id: 1,
          batch_id: 1,
          phone: this.phoneNumber,
          date_birth: this.dateOfBirth,
        };
        this.$emit('create-student',userData,errorMessageBack);
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
    },
    firstName: function(newValue) {
      this.email = newValue.toLowerCase().trim() + '.' + this.lastName.toLowerCase().trim() + '@student.passerellesnumeriques.org';
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
