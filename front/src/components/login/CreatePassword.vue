<template>
    <div class="flex items-center justify-center w-[30%] duration-400 ease-in-out">
                <form class="w-full m-auto" @submit.prevent="createPassword">
                    <div class="mb-3 relative mt-5">
                        <div class="flex items-center relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9   p-2 h-9   absolute text-primary border-r-2 top-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input
                                type="password"
                                class="appearance-none rounded w-full px-2 py-3 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline pl-10 border-b-2 border-primary"
                                :class="{'border border-red-500 bg-red-100': isFilledNew}"
                                placeholder="Enter new password ..."
                                v-model="newPassword"
                                @input="isFilledNew=false"
                            />
                        </div>
                    </div>
                    <div class="mb-1   relative">
                        <div class="flex items-center relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9   p-2 h-9   absolute text-primary border-r-2 top-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input
                                class=" appearance-none  rounded w-full px-2 py-3 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline pl-10 border-b-2 border-primary"
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
                        <button type="submit" class="bg-primary p-2 rounded w-24 text-white  hover:bg-blue-400">Next</button>
                    </div>
                </form>
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
                    console.log(this.$store.state.userId);
                    const newPassword = {newPassword: this.newPassword, confirmPassword: this.confirmPassword}
                    axios.post("/login/createPassword/" +  this.$store.state.userId,newPassword);
                    this.$router.push('/login');
                }else{
                    this.isValid = true
                    this.isFilledConfirm = true
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
