<template>
<!-- popup to update student -->
    <div class="fixed flex w-full z-50 h-full inset-0 items-center justify-center bg-gray-700 bg-opacity-50"> 
        <div>
            <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
                <p></p>
                <h2>Update Student</h2>
                <svg @click="$emit('closeForm')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <form @submit.prevent="onUpdate" class="shadow p-4 bg-white">
                <div class="flex w-full justify-between  mr-2 mb-2">
                    <div class="w-full mr-2 mb-2">
                    <b><label for="firstNameInput">First name</label></b>
                    <br />
                    <input
                        v-model="first_name"
                        type="text"
                        class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        name="firstNameInput"
                        id="firstNameInput"
                        placeholder="First name ..."
                    />
                    </div>
                    <div class="w-full">
                    <b><label for="lastNameInput">Last name</label></b>
                    <br />
                    <input
                        v-model="last_name"
                        type="text"
                        name="lastNameInput"
                        class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        id="lastNameInput"
                        placeholder="Last name ..."
                    />
                    </div>
                </div>
                <div class="email mr-2 mb-2">
                    <b><label for="emailInput">Email</label></b>
                    <br />
                    <input
                        v-model="email"
                        type="email"
                        name="emailInput"
                        class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        id="emailInput"
                        placeholder="Email ..."
                    />
                </div>
                <div class="phone mr-2 mb-2">
                    <b><label for="phoneInput">Phone</label></b>
                    <br />
                    <input
                        v-model="phone"
                        type="phone"
                        name="phoneInput"
                        class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        id="phoneInput"
                        placeholder="Phone ..."
                    />
                </div>
                <div class="flex justify-between mr-2 mb-2">
                    <div class="batch mr-2">
                    <b><label for="batchInput">Batch</label></b>
                    <br />
                    <input
                        v-model="batch"
                        type="text"
                        name="batchInput"
                        class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        id="batchInput"
                        placeholder="Batch ..."
                    />
                    </div>
                    <div class="class mr-2">
                    <b><label for="classInput">Class</label></b>
                    <br />
                    <input
                        v-model="student_class"
                        type="text"
                        name="classInput"
                        class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        id="classInput"
                        placeholder="Class ..."
                    />
                    </div>
                    <div class="studentId mr-2">
                    <b><label for="studentIdInput">Student ID</label></b>
                    <br />
                    <input
                        v-model="id_student"
                        type="text"
                        name="studentIdInput"
                        class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        id="studentIdInput"
                        placeholder="Id ..."
                    />
                    </div>
                </div>
                <div class="{}">
                    <b><label for="classInput">Date of Birth</label></b>
                    <input
                        type="text"
                        name="studentDateBirth"
                        class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        v-model="date_birth"
                        placeholder="Set date of birth"
                    />
                </div>
                <div class="gender mr-2 mb-2">
                    <b>Gender</b>
                    <div class="formGender flex">
                        <div class="male">
                            <input v-model="gender" value="Male" type="radio" name="gender" id="maleClick" />
                            <label for="maleClick">Male</label>
                        </div>
                        <div class="female ml-8">
                            <input v-model="gender" value="Female" type="radio" name="gender" id="femaleClick" />
                            <label for="femaleClick">Female </label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button-cancel @click="$emit('closeForm')">
                        <template v-slot:button_cancel>Cancel</template>     
                    </button-cancel>
                    <button-create>
                        <template v-slot:button_create>Save Change</template>      
                    </button-create>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
import axios from '../../axios-http';
export default {
    props:{
        userDataDetail: Object,
        studentDataDetail: Object,
    }, 
    emits: ['save-edit'],
    data(){
        return{
            isOpen: false,
            id:this.userDataDetail.id,
            roles: this.userDataDetail.roles,
            first_name: this.userDataDetail.first_name,
            last_name: this.userDataDetail.last_name,
            email: this.userDataDetail.email,
            phone: this.userDataDetail.phone,
            batch: this.studentDataDetail.batch,
            student_class: this.studentDataDetail.class,
            id_student: this.studentDataDetail.id_student,
            gender: this.userDataDetail.gender,
            date_birth: this.studentDataDetail.date_birth,
        }
    },

    methods:{
        onUpdate(){
            this.isOpen = true;
            if(this.gender != null){
                let newDataUser = {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    phone: this.phone,
                    batch: this.batch,
                    class: this.student_class,
                    id_student: this.id_student,
                    roles: this.roles,
                    gender: this.gender,
                    date_birth: this.date_birth
                };
                axios.put('/users/' + this.id, newDataUser).then((res => {
                    console.log(res.data);
                    // this.isOpen = false;
                    this.$emit('save-edit');

                }))
            }
        }
    },
    watch: {
        first_name: function (newValue) {
            this.email = newValue.toLowerCase().trim() + '.' + this.last_name.toLowerCase().trim() + '@student.passerellesnumeriques.org';
        },
        last_name: function (newValue) {
            this.email = this.first_name.toLowerCase().trim() + '.' + newValue.toLowerCase().trim() + '@student.passerellesnumeriques.org';
        }
    }
}
</script>

<style>

</style>