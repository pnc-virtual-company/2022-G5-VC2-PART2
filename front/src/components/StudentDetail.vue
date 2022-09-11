<template>
<div class="w-4/5 mt-20 m-auto">
    <div class="">
        <p class="text-3xl text-center capitalize">student informaion detail</p>
        <div class="shadow bg-white flex items-center mt-5 p-8 relative">
            <div class="relative" >
                <img class="w-40 h-40 rounded-full" src="../assets/ducati.jpeg" alt="">
                <label for="image">
                    <svg fill="none" class="w-10 rounded-full shadow p-2 h-10 bg-white absolute right-0 top-28 cursor-pointer text-black" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </label>
                <input type="file" id="image" hidden>
            </div>
            <div class="ml-5 leading-9 text-xl">
                <p>Bro Chhaiya</p>
                <p>brochhaiya@gmail.com</p>
                <p>0965555342</p>
            </div>
        </div>
    </div>
    <div class="">  
        <div class="shadow rounded flex items-center mt-5 p-8 relative bg-white">
            <svg @click="onUpdate" class="w-12 h-12 absolute right-6 top-6 cursor-pointer shadow hover:bg-blue-500 hover:text-white rounded-full p-2 duration-300 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
            <div class="ml-5 leading-9 text-xl font-bold">
                <p>First name</p>
                <p>Last name</p>
                <p>Gender</p>
                <p>Batch</p>
                <p>Class</p>
                <p>Personal ID</p>
            </div> 
            <div class=" leading-9 text-xl ml-20">
                <p>Bro</p>
                <p>Chhaiya</p>
                <p>Male</p>
                <p>2022</p>
                <p>WEB B</p>
                <p>35</p>
            </div> 
        </div>
    </div>

    <!-- popup to update student -->
    <div v-if="isOpen">
        <div class="main-form flex h-screen absolute inset-0 items-center justify-center bg-gray-700 bg-opacity-50"> 
            <div>
                <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
                    <p></p>
                    <h2>Update Student</h2>
                    <svg @click="isOpen = false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <form class="shadow p-4 bg-white">
                    <div class="flex w-full justify-between  mr-2 mb-2">
                        <div class="w-full mr-2 mb-2">
                        <b><label for="firstNameInput">First name</label></b>
                        <br />
                        <input
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
                            type="text"
                            name="studentIdInput"
                            class="shadow appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                            id="studentIdInput"
                            placeholder="Id ..."
                        />
                        </div>
                    </div>
                    <div class="gender mr-2 mb-2">
                        <b>Gender</b>
                        <div class="formGender flex">
                        <div class="male">
                            <input type="radio" name="gender" id="maleClick" />
                            <label for="maleClick">Male</label>
                        </div>
                        <div class="female ml-8">
                            <input type="radio" name="gender" id="femaleClick" />
                            <label for="femaleClick">Female </label>
                        </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button @click="isOpen = false" type="button" class="bg-red-500 hover:bg-red-600  text-white p-1.5 px-3  rounded focus:outline-none focus:shadow-outline">Cancel</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 mx-2 text-white p-1.5 px-3 rounded focus:outline-none focus:shadow-outline">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</template>

<script>
export default {
    data(){
        return{
            isOpen: false,
        }
    },

    methods:{
        onUpdate(){
            this.isOpen = true;
        }
    }
}
</script>

<style>

</style>