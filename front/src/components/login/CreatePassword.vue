<template>
    <div class="flex items-center justify-center w-[40%] duration-400 ease-in-out">
                <form class="w-full m-auto p-4 rounded bg-gray-100 px-12" @submit.prevent="createPassword">
                    <div class="text-center text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 p-4 border-4 border-primary h-28 bg-gray-100  shadow rounded-full m-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        <h1 class=" text-xl mt-2 font-bold">Create New Password</h1>
                    </div>
                    <div class="mb-3 relative mt-5">
                        <div class="flex items-center relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9   p-2 h-9   absolute text-primary border-r-2 top-0.5 font-bold">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input
                                type="password"
                                class="appearance-none rounded w-full bg-gray-100 px-2 py-3 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline pl-10 border-b-2 border-primary"
                                :class="{'border border-red-500 bg-red-100': isFilledNew}"
                                placeholder="Enter new password ..."
                                v-model="newPassword"
                                @input="isFilledNew=false"
                            />
                        </div>
                    </div>
                    <div class="mb-1   relative">
                        <div class="flex items-center relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9   p-2 h-9   absolute text-primary border-r-2 top-0.5 font-bold">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input
                                class=" appearance-none bg-gray-100  rounded w-full px-2 py-3 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline pl-10 border-b-2 border-primary"
                                :class="{' border-red-500 bg-red-100':isFilledConfirm}"
                                :type="type"
                                id="password"
                                placeholder="Enter confirm password ..."
                                v-model="confirmPassword"
                                @input="isFilledConfirm=false"
                            />
                            <svg v-if="isValid" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute right-2 top-3 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        </div>
                    <div v-if="isValid" class="text-red-500 text-sm">Invalid confirm password</div>
                    <div class="block mt-2">
                        <input type="checkbox" class="cursor-pointer" name="" id="show" @click="checkVisibility">
                        <label for="show" class="ml-2 cursor-pointer text-sm">Show password</label>
                    </div>
                    <div class="flex items-center justify-end">
                        <router-link
                            class="inline-block cursor-pointer align-baseline text-sm text-blue-500 hover:text-blue-600"
                            
                        >
                            Forgot Password?
                        </router-link>
                        <button             
                            :disabled="checkValidation"
                            class=" bg-blue-500 ground  hover:bg-blue-600 text-white py-1.5 px-4 rounded focus:outline-primary focus:shadow-outline  shadow"
                            :class="{'bg-gray-300 hover:bg-gray-300 hover:cursor-not-allowed': checkValidation}"
                            type="submit">Next
                        </button>
                    </div>
                </form>
    </div>

</template>

<script>
import axios from "../../axios-http"
export default({
    emits: ['create-password'],
    data(){
        return {
            newPassword: "",
            confirmPassword: "",
            isFilledNew: false,
            isFilledConfirm: false,
            isValid: false,
            type: 'password'
        }
    },
    methods: {
        async createPassword(){
            this.isValid = false
            if (this.newPassword == this.confirmPassword){
                this.isValid = false;
                console.log(this.$store.state.userId);
                const newPassword = {newPassword: this.newPassword, confirmPassword: this.confirmPassword}
                axios.post("/login/createPassword/" +  this.$store.state.userId,newPassword);
                this.$emit('create-password');
            }else{
                this.isValid = true
                this.isFilledConfirm = true
            }
        },
        checkVisibility(){
            if (this.type == "password"){
                this.type = "text";
            }else{
                this.type = "password";

            }
        }
    },
    computed: {
        // to check validation of both password
        checkValidation(){
            let sms = false;
            if (this.newPassword.trim() == "" || this.confirmPassword.trim()== ''){
                sms = true;
            }
            return sms;
        },
    }
})
</script>
