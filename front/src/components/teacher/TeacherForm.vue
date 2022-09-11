<template>
  <div
    class="w-full h-full bg-black z-50 bg-opacity-60 flex items-center justify-center fixed top-0"
  >
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
            />
          </div>
        </div>
        <div class="flex w-full justify-between mr-2 mb-2">
          <div class="w-full mr-2 mb-2">
            <b><label for="roleInput">Role</label></b>
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
            <b><label for="phoneInput">Phone number ...</label></b>
            <br />
            <input
              type="text"
              name="phoneInput"
              class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
              id="phoneInput"
              placeholder="Phone number ..."
              v-model="phone"
            />
          </div>
          <div class="text-red-500 text-sm mb-2">
            {{ sms_error_phone_number }}
          </div>
        </div>
        <div class="email mb-2">
          <b><label for="emailInput">Email</label></b>
          <br />
          <input
            type="email"
            name="emailInput"
            class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="emailInput"
            placeholder="Email ..."
            v-model="email"
          />
        </div>
        <div class="text-red-500 text-sm mb-2">
          {{ sms_error_email }}
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
            Add Student
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  emits: ["create-teacher"],
  data() {
    return {
      firstName: "",
      lastName: "",
      roles: "TEACHER",
      phone: "",
      email: "",
      gender: "",
    };
  },
  watch: {
    lastName: function (newValue) {
      this.email =
        this.firstName + "." + newValue + "@passerellesnumeriques.org";
    },
  },
  methods: {
    createTeacher() {
      let userData = {
        first_name: this.firstName,
        last_name: this.lastName,
        email: this.email,
        password: this.generatePassword(),
        gender: this.gender,
        phone: this.phone,
        roles:this.roles
      };
      this.$emit("create-teacher", userData);
    },
    generatePassword() {
      let chars =
        "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
      let stringLength = 8;
      let randomString = "";
      for (let i = 0; i < stringLength; i++) {
        let rnum = Math.floor(Math.random() * chars.length);
        randomString += chars.substring(rnum, rnum + 1);
      }
      this.password = randomString;
      return this.password;
    },
  },
};
</script>
