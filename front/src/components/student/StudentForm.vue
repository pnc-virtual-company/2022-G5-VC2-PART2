<template>
<div class="w-full h-full bg-black z-50 bg-opacity-60 flex items-center justify-center fixed top-0">
  <div class="main-form w-[40%] ">
    <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
      <p></p>
      <h2>Create Student</h2>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" @click="$emit('closeForm')">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>

    </div>
    <form class="shadow p-4 bg-white">
      <div class="flex w-full justify-between  mb-2">
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
      <div class="email mb-2">
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
      <div class="phone mb-2">
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
      <div class="flex mb-2 box-border relative">
        <div>
          <b><label for="batchInput">Batch</label></b>
          <br />
          <input
            type="text"
            name="batchInput"
            class="shadow appearance-none border mr-1 rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="batchInput"
            placeholder="Batch ..."
          />
        </div>
        <div>
          <b><label for="classInput">Class</label></b>
          <br />
          <input
            type="text"
            name="classInput"
            class="shadow appearance-none ml-1 border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="classInput"
            placeholder="Class ..."
          />
        </div>
        <div>
          <b><label for="studentIdInput">Student ID</label></b>
          <br />
          <input
            type="text"
            name="studentIdInput"
            class="shadow appearance-none border ml-1 rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="studentIdInput"
            placeholder="Id ..."
          />
        </div>
      </div>
      <div class="gender mr-2 mb-2">
        <b>Gender</b>
        <div class="mt-2 flex">
          <div class="male">
            <input type="radio" class="ml-2 cursor-pointer" name="gender" id="maleClick" />
            <label for="maleClick" class="ml-2 cursor-pointer">Male</label>
          </div>
          <div class="female ml-8">
            <input type="radio" class="ml-2 cursor-pointer" name="gender" id="femaleClick" />
            <label for="femaleClick" class="ml-2 cursor-pointer">Female </label>
          </div>
        </div>
      </div>
      <div class="flex justify-end">
        <button type="button" @click="$emit('closeForm')" class="bg-red-500 hover:bg-red-600  text-white p-1.5 px-3  rounded focus:outline-none focus:shadow-outline">Cancel</button>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 mx-2 text-white p-1.5 px-3 rounded focus:outline-none focus:shadow-outline">Add Student</button>
      </div>
    </form>
  </div>
</div>
</template>
