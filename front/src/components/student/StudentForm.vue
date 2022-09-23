<template>
  <div class="w-full h-full bg-black z-50 bg-opacity-30 flex items-center justify-center fixed top-0">
    <div class=" w-[40%] ">
      <div class="p-2 bg-primary shadow text-center border-b-2 text-white text-lg uppercase rounded-t">
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
              :disabled = isCreate
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
              :disabled = isCreate
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
            :disabled = isCreate
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
            :disabled = isCreate
          />
          <span class="text-sm text-primary">Optional*</span>
        </div>
        <div class="flex mb-1 box-border relative">
          <div>
            <label for="batchInput">Batch</label>
            <br />
            <select class="form-select w-[12.2vw] shadow appearance-none border rounded px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline" v-model="batchId" :disabled = isCreate>
              <option v-for="(batch,index) in allBatch" :key="index" :value = batch.id>{{batch.year}}</option>
            </select>
          </div>
          <div>
            <label for="classInput">Class</label>
            <br />
            <select class="form-select w-[12.2vw] shadow appearance-none ml-1 border rounded px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline" v-model="classId" :disabled = isCreate>
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
              :disabled = isCreate
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
              :disabled = isCreate
            />
              <p>{{forgotDateBirth}}</p>
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
    <loading-animation v-if="isCreate" :content="message"></loading-animation>
  </div>
</template>
<script>
  import axiosHttp from '../../axios-http';
  import loadingAnimated from "../animations/LoadingAnimate.vue"
  export default{
    emits: ['create-student'],
    components: {
      'loading-animation':loadingAnimated
    },
    data() {
      return {
        firstName: '',
        lastName: '',
        email: '',
        batchId: 1,
        classId: 1,
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
        message: "In processing...",
        errorMessage: '',
        errorIdStudent: ''
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
          axiosHttp.post('/users',userData).then(() => {
            this.isCreate = false;
            this.$emit('create-student');
            this.isShowForm = false;
          }).catch((error) =>{
            this.errorMessage = '';
            if (error.response.status === 422) {
              this.errorMessage = error.response.data.message;
            }
            if (error.response.status === 402) {
              this.errorIdStudent = error.response.data.message;
            }
          })
        }
      },
      getAllBatch() {
        axiosHttp.get('/batches').then(res => {
          this.allBatch = res.data;
        });
      },
      getAllClass() {
        axiosHttp.get('/classes').then(res => {
          this.allClass = res.data;
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
