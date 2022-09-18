<template>
  <div
    class="w-full h-full bg-black z-50 bg-opacity-60 flex items-center justify-center fixed top-0"
  >
    <div class="w-[40%]">
      <div
        class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t"
      >
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
        <div class="flex w-full justify-between mr-2 mb-2">
          <div class="w-full mr-2 mb-2">
            <b><label for="roleInput">Position</label></b>
            <br />
            <input
              type="text"
              class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
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
              class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
              id="phoneInput"
              placeholder="Phone number ..."
              v-model="phone"
            />
            <span class="text-primary text-sm">Optional*</span>
          </div>
          <div class="text-red-500 text-sm mb-2">
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
        <div class="gender mr-2 mb-2">
          <b>Gender</b>
          <div class="mt-2 flex">
            <div class="male">
              <input
                type="radio"
                class="ml-2 cursor-pointer"
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
                class="ml-2 cursor-pointer"
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
          <button
            type="button"
            @click="$emit('closeForm')"
            class="bg-red-500 hover:bg-red-600 text-white p-1.5 px-3 rounded focus:outline-none focus:shadow-outline"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 mx-2 text-white p-1.5 px-3 rounded focus:outline-none focus:shadow-outline"
          >
            Add Teacher
          </button>
        </div>
      </form>
    </div>
    <div class="fixed w-full h-screen bg-black bg-opacity-60 flex items-center justify-center top-0" v-if="isCreate">
        <span class="text-md">
          <svg class="ml-8 w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
          </svg>
          In processing....
        </span>
  </div>
  </div>
</template>

<script>
export default {
  emits: ["create-teacher"],
  props: ['message'],
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
      isCreate: false
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
        this.$emit("create-teacher", userData,messageBack);
        setTimeout(() => {
          this.isCreate = false;
        },10000);
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
