<template>
<div class="w-full h-full bg-black z-50 bg-opacity-30 flex items-center justify-center fixed top-0">
  <div class="main-form w-[40%] ">
    <div class="p-2 bg-white shadow text-center border-b-2 text-primary text-lg uppercase rounded-t">
      <h2>Create Student</h2>
    </div>
    <form class="shadow rounded-b p-4 bg-white" @submit.prevent="createNewStudent">
      <div class="flex w-full justify-between  mb-1">
        <div class="w-full mr-2 mb-1">
          <label for="firstNameInput">First name</label>
          <br />
          <input
            type="text"
            class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline"
            name="firstNameInput"
            id="firstNameInput"
            placeholder="First name ..."
            v-model="firstName"
            :class="{'border-red-600' :forgotFirstName}"
          />
        </div>
        <div class="w-full">
          <label for="lastNameInput">Last name</label>
          <br />
          <input
            type="text"
            name="lastNameInput"
            class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="lastNameInput"
            placeholder="Last name ..."
            v-model="lastName"
            :class="{'border-red-600' :forgotLastName}"
          />
        </div>
      </div>
      <div class="email mb-1">
        <label for="emailInput">Email</label>
        <br />
        <input
          type="email"
          name="emailInput"
          class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline"
          id="emailInput"
          placeholder="Email ..."
          v-model="email"
          :class="{'border-red-600' :messageError + forgotEmail}"
        />
        <p>{{messageError}}</p>
        <p>{{forgotEmail}}</p>
      </div>
      <div class="phone mb-1">
        <label for="phoneInput">Phone</label>
        <br />
        <input
          type="phone"
          name="phoneInput"
          class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700  leading-tight focus:outline-blue-500 focus:shadow-outline"
          id="phoneInput"
          placeholder="Phone ..."
          v-model="phoneNumber"
        />
        <span class="text-sm text-primary">Optional*</span>
      </div>
      <div class="flex mb-1 box-border relative">
        <div>
          <label for="batchInput">Batch</label>
          <br />
          <select class="form-select w-[12.2vw] shadow appearance-none border rounded px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline" v-model="batchId">
            <option v-for="(batch,index) in allBatch" :key="index" :value = batch.id>{{batch.year}}</option>
          </select>
        </div>
        <div>
          <label for="classInput">Class</label>
          <br />
          <select class="form-select w-[12.2vw] shadow appearance-none ml-1 border rounded px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline" v-model="classId" >
            <option v-for="(oneClass,index) in allClass" :key="index" :value = oneClass.id>{{oneClass.class_name}}</option>
          </select>
        </div>
        <div>
          <label for="studentIdInput">Student ID</label>
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
      <div>
        <label for="classInput">Date of Birth</label>
        <input
            type="date"
            name="studentDateBirth"
            class="shadow appearance-none border ml-1 mr-6 rounded w-[98%] px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            v-model="dateOfBirth"
            :class="{'border-red-600' :forgotDateBirth}"
            max="2004-12-01"
            min="1999-01-01"
          />
      </div>
      <div class="gender mr-2 mb-2">
        Gender
        <div class="mt-1 flex">
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
  <div class="fixed text-4xl w-full h-screen bg-black bg-opacity-60 flex items-center justify-center top-0" v-if="isCreate">
    <span class="text-md text-white-500" id="wait">
      <svg class="ml-[40px] w-6 h-6 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
      </svg>
      In processing....
    </span>
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
      batchId:null,
      classId: null,
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
      allBatch: [],
      allClass: [],
      isCreate: false,
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
          gender: this.gender,
          roles: 'STUDENT',
          student_id: this.studentId,
          id_student: this.idStudent,
          class_id: this.classId,
          batch_id: this.batchId,
          phone: this.phoneNumber,
          date_birth: this.dateOfBirth,
        };
        this.isCreate = true;
        this.$emit('create-student',userData,errorMessageBack);
        setTimeout(() =>{
          this.isCreate = false
        },9000);
      }
      
    },
    getAllBatch() {
      axiosHttp.get('/batches').then(res => {
        this.allBatch = res.data;
        this.batchId = this.allBatch[0].id
      })
    },
    getAllClass() {
      axiosHttp.get('/classes').then(res => {
        this.allClass = res.data;
        this.classId = this.allClass[0].id
      });
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
    this.getAllBatch();
    this.getAllClass();
    this.getLastStudentId();
  }
}
</script>
<style scoped>
p{
  color: red;
  font-size: 13px;
}
span{
  font-size: large;
  color: white;
}
</style>
