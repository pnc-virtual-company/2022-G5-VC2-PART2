<template>
  <div class="w-full h-full bg-black z-50 bg-opacity-30 flex items-center justify-center fixed top-0">
    <div class="w-[40%]">
      <div
        class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t"
      >
      <p></p>
        <h2>Create Teacher</h2>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6 cursor-pointer"
          @click="$emit('closeForm')"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </div>
      <form class="shadow p-4 bg-white" @submit.prevent="createTeacher">
        <div class="flex w-full justify-between mr-2 mb-2">
          <div class="w-full mr-2 mb-2">
            <b><label for="firstNameInput">First name</label></b>
            <br />
            <input
              type="text"
              class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
              name="firstNameInput"
              id="firstNameInput"
              placeholder="First name ..."
              v-model="firstName"
              :class="{'border-red-600':messageForgotfirstName}"
            />
          </div>
          <div class="w-full">
            <b><label for="lastNameInput">Last name</label></b>
            <br />
            <input
              type="text"
              name="lastNameInput"
              class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
              id="lastNameInput"
              placeholder="Last name ..."
              v-model="lastName"
              :class="{'border-red-600' :messageForgotlastName}"
            />

          </div>
        </div>
        <div class="flex w-full justify-between mr-2">
          <div class="w-full mr-2 mb-2">
            <b><label for="roleInput">Position</label></b>
            <br />
            <input
              type="text"
              class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline"
              name="roleInput"
              id="roleInput"
              placeholder="Role..."
              v-model="roles"
            />
          </div>
          <div class="w-full">
            <b><label for="phoneInput">Phone number</label></b>
            <br />
            <input
              type="text"
              name="phoneInput"
              class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 leading-tight focus:outline-blue-500 focus:shadow-outline"
              id="phoneInput"
              placeholder="Phone number ..."
              v-model="phone"
            />
            <span class="text-primary text-sm">Optional*</span>
          </div>
        </div>
        <div class="email mb-2">
          <b><label for="emailInput">Email</label></b>
          <br />
          <input
            type="email"
            name="emailInput"
            :class="{'border-red-500':message + messageForgotEmail}"
            class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="emailInput"
            placeholder="Email ..."
            v-model="email"
          />
          <p>{{message}}</p>
        </div>
        <div class="mb-2 ">
          <label for="">Gender</label>
          <div class="mt-1 ml-4 flex">
            <div class="male">
              <input
                type="radio"
                class=" cursor-pointer"
                name="gender"
                id="maleClick"
                value="Male"
                v-model="gender"
              />
              <label for="maleClick" class="ml-2 cursor-pointer">Male</label>
            </div>

<div class="female ml-8">
              <input
                type="radio"
                class=" cursor-pointer"
                name="gender"
                value="Female"
                id="femaleClick"
                v-model="gender"
              />
              <label for="femaleClick" class="ml-2 cursor-pointer"
                >Female
              </label>
            </div>
          </div>
        </div>
        <div class="flex justify-end">
          <button-cancel @click="$emit('closeForm')">
            <template v-slot:button_cancel>Cancel</template>     
          </button-cancel>
          <button-create>
            <template v-slot:button_create>Add Teacher</template>      
          </button-create>
        </div>
      </form>
    </div>
    <loading-animation v-if="isCreate" :content="sms"></loading-animation>
  </div>
</template>

<script>
import axiosHttp from "../../axios-http"
import loadingAnimated from "../animations/LoadingAnimate.vue"
export default {
  components: {
    'loading-animation':loadingAnimated
  },
  emits: ["create-teacher"],
  data() {
    return {
      firstName: "",
      lastName: "",
      roles: "TEACHER",
      phone: "",
      email: "",
      gender: "Male",
      messageForgotfirstName: '',
      messageForgotlastName: '',
      messageForgotEmail: '',
      isCreate: false,
      sms: "In processing...",
      message: ''
    };
  },
  watch: {
    lastName: function (newValue) {
      this.email =
      this.firstName.toLowerCase().trim() + "." + newValue.toLowerCase().trim() + "@passerellesnumeriques.org";
    },
    firstName: function(newValue) {
      this.email = newValue.toLowerCase().trim() + '.' + this.lastName.toLowerCase().trim() + '@passerellesnumeriques.org';
    }
  },
  methods: {
    createTeacher() {
      if (this.firstName === ''){
        this.messageForgotlastName = '';
        this.messageForgotfirstName = 'Please put first name!*';
      }else if(this.lastName === ''){
        this.messageForgotfirstName = '';
        this.messageForgotlastName = 'Please put last name!*';
      }else if(this.email === '') {
        this.messageForgotlastName = '';
        this.messageForgotEmail = 'Please put email!*';
      }
      else{
        this.messageForgotfirstName = '';
        this.messageForgotlastName = '';
        this.messageForgotEmail = '';
        let messageBack = '';
        let userData = {
          first_name: this.firstName,
          last_name: this.lastName,
          email: this.email,
          gender: this.gender,
          phone: this.phone,
          roles:this.roles
        };
          this.isCreate = true;
        axiosHttp.post("/users", userData).then(() => {
          this.isCreate = false;
          this.$emit("create-teacher");
          this.message = messageBack;
        }).catch((error) =>{
          if (error.response.status === 422) {
          this.isCreate = false;
          this.message = error.response.data.message;
        }
      });
      }
    },
  },
};
</script>
<style scoped>
p{
  color: red;
  font-size: 14px;
}
span{
  color: #fff;
}
</style>