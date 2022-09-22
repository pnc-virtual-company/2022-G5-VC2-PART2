<template>
  <div>
    <div class="mt-28 h-auto justify-center w-[70%] m-auto p-2">
      <h3 class="flex justify-center text-2xl font-bold text-primary">
        Admin Profile
      </h3>
      <div class="bg-gray-100 w-full relative shadow rounded h-auto p-4 px-8">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-8 h-8 shadow rounded p-1 top-0 cursor-pointer text-primary absolute right-0"
          @click="editInfo"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
          />
        </svg>
        <div class="flex justify-center items-center mt-6 mb-6">
          <div class="w-4/12 h-[30vh] shadow rounded relative mr-2">
            <div
              class="bg-white w-full h-full shadow rounded relative p-2 group"
            >
              <label for="imageSelect">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-8 h-8 shadow rounded p-1 cursor-pointer text-primary absolute right-0 top-0 hidden group-hover:block ease-out duration-200"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                  />
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                  />
                </svg>
              </label>
              <img
                class="w-28 rounded-full h-28 flex justify-center m-auto mt-6 border-2 border-primary"
                :src="getAdminIntoProfile(user.profile)"
                alt=""
              />
              <input
                type="file"
                class="hidden"
                id="imageSelect"
                @change="changeProfile"
              />
            </div>
          </div>

          <div class="w-10/12 h-[30vh] rounded relative bg-white shadow">
            <div
              class="w-full h-full mb-6 flex p-6 text-md text-primary items-center"
            >
              <div class="p-1 ml-2 font-bold w-[20%]">
                <h1 class="mt-4">First name</h1>
                <h1 class="mt-4">Last name</h1>
                <h1 class="mt-4">Email</h1>
                <h1 class="mt-4">Gender</h1>
              </div>
              <div class="p-2 ml-4" v-if="!isEdit">
                <p class="mt-4 break">{{ user.first_name }}</p>
                <p class="mt-4 break">{{ user.last_name }}</p>
                <p class="mt-4 break">{{ user.email }}</p>
                <p class="mt-4">{{ user.gender }}</p>
              </div>
              <div class="p-2 ml-4 w-[80%]" v-else>
                <input
                  type="text"
                  class="shadow appearance-none rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                  v-model="firstName"
                />
                <input
                  type="text"
                  class="shadow appearance-none rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                  v-model="lastName"
                />
                <input
                  type="text"
                  class="shadow appearance-none rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                  v-model="email"
                />
                <input
                  type="text"
                  class="shadow appearance-none rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                  v-model="gender"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-end">
          <div class="flex" v-if="isEdit">
            <button-cancel @click="isEdit=false">
              <template v-slot:button_cancel>Cancel</template>
            </button-cancel>
            <button-create @click="saveEdit">
              <template v-slot:button_create>Save Change</template>
            </button-create>
          </div>
          <div v-else>
            <button
              class="bg-orange-400 shadow hover:bg-warning rounded p-2 text-white uppercase"
              @click="showResetPassword(user.id)"
            >
              Reset password
            </button>
          </div>
        </div>
      </div>
    </div>
    <alert-sucess :content="messageSuccess" v-if="isConfirm"/>
    <reset-password v-if="isResetPassword" @closeForm="isResetPassword=false" :userId="user.id" @success="successUpdated"/>
  </div>
</template>

<script>
import axios from "../../../axios-http.js";
import ResetPassword from "../login&signout/ResetNewPassword.vue";
import alert from '../../../components/widgets/AlertSuccess.vue';
export default {
  components: {
    "reset-password": ResetPassword,
    'alert-sucess' : alert,
  },
  mounted() {
    this.getInfoAdmin();
  },
  data() {
    return {
      isResetPassword: false,
      user:{},
      profile: null,
      isEdit: false,
      adminID: null,
      firstName: null,
      lastName: null,
      email: null,
      gender: null,
      userId: null,
      isConfirm: false,
      messageSuccess: ''
    };
  },
  methods: {
    uploadProfile(profile) {
      axios
        .post("/users/updateProfile/" + this.user.id, profile)
        .then((res) => {
          console.log(res.data);
          this.getInfoAdmin();
        });
    },

    cancelEdit() {
      this.lastName = this.user.last_name;
      (this.firstName = this.user.first_name), (this.email = this.user.email);
      this.gender = this.user.gender;
      this.isEdit = false;
      this.getInfoAdmin();
    },

    saveEdit() {
      let newUpdate = {
        last_name: this.lastName,
        first_name: this.firstName,
        email: this.email,
        roles: "Coordinator",
        gender: this.gender,
      };
      axios.post("/users/" + this.user.id, newUpdate);
      this.isEdit = false;
      this.getInfoAdmin();
    },
    changeProfile(event) {
      const profile = new FormData();
      profile.append("profile", event.target.files[0]);
      this.uploadProfile(profile);
    },
    getAdminIntoProfile(profileImage) {
      return axios.defaults.baseURL + "storage/image/" + profileImage;
    },
    getInfoAdmin() {
      axios
        .get("/users/teacher/" + localStorage.getItem("userId"))
        .then((res) => {
          this.user = res.data.userData;
        });
    },
    editInfo() {
      this.isEdit = true;
      this.firstName = this.user.first_name;
      this.lastName = this.user.last_name;
      this.email = this.user.email;
      this.gender = this.user.gender;
    },
    showResetPassword(){
        this.isResetPassword = true;
    },
    successUpdated(message) {
        this.isResetPassword = false
        this.messageSuccess = message;
        this.isConfirm = true;
        setTimeout(() =>{
            this.isConfirm = false
        },2000);
    }
  },
};
</script>

<style></style>
