<template>
    <div class="w-full h-screen flex items-center justify-center">
        <div class="w-[60%] m-auto bg-white p-4 rounded shadow">
            <div class="m-auto w-10/12 ">
                <div class=" p-2 rounded-full text-center text-2xl capitalize relative">
                    Please create your password
                </div>
                <form class="mt-6 w-8/12 m-auto" @submit.prevent="createPassword">
                    <div class="block">
                        <label for="">New password</label>
                            <input
                            type="password"
                            name="password"
                            class="shadow appearance-none border  rounded w-full px-2 py-2.5  text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                            :class="{'border border-red-500 bg-red-100': isFilledNew}"
                            placeholder="Enter new password ..."
                            v-model="newPassword"
                            @input="isFilledNew=false"
                            />
                    </div>
                    <div class="block mt-2 relative">
                        <label for="">Confirm password</label>
                            <input
                            :type="type"
                            name="contirm_password"
                            class="shadow appearance-none border  rounded w-full px-2 py-2.5  text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                            :class="{'border border-red-500 bg-red-100':isFilledConfirm}"
                            placeholder="Enter confirm password ..."
                            v-model="confirmPassword"
                            @input="isFilledConfirm=false"
                            />
                            <svg v-if="isValid" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute right-2 top-8 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>

                    </div>
                    <div v-if="isValid" class="text-red-500 text-sm">Invalid confirm password</div>
                    <div class="block mt-2">
                        <input type="checkbox" class="cursor-pointer" name="" id="show" @click="checkVisibility">
                        <label for="show" class="ml-2 cursor-pointer text-sm">Show password</label>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-primary p-2 rounded w-24 text-white  hover:bg-blue-400">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "../../axios-http"
export default({
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
            if (this.checkValidation()){
                this.isValid = false
                if (this.newPassword == this.confirmPassword){
                    this.isValid = false;
                    const newPassword = {newPassword: this.newPassword, confirmPassword: this.confirmPassword}
                    axios.post("/login/createPassword/" +  this.$store.state.userId,newPassword);
                    this.$router.push('/setPassword');
                }else{
                    this.isValid = true
                }
            }
        },
        // to check validation of both password
        checkValidation(){
            this.isFilledNew = false;
            if (this.newPassword.trim() == ""){
                this.isFilledNew = true;
            }
            this.isFilledConfirm = false;
            if (this.confirmPassword.trim() == ""){
                this.isFilledConfirm = true;
            }
            let sms = true;
            if  (this.isFilledNew || this.isFilledConfirm){
                sms = false;
            }
            return sms;
        },
        checkVisibility(){
            if (this.type == "password"){
                this.type = "text";
            }else{
                this.type = "password";

            }
        }
    }
})
</script>
