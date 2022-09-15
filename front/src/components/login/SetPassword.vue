<template>
  <div class="w-full m-auto h-[100vh] flex items-center justify-center bg-white">
    <div class="flex items-center justify-center py-10 px-5 w-[50%] bg-gray-100 shadow rounded">
        <form class="w-[80%]">
          <h1 class="text-2xl font-semibold text-center p-1 mb-6 text-primary">
            Hi Username
          </h1>
          <div class="mb-2 relative">
            <label class="block text-gray-700 text-md" for="password"></label>
            <input
              class="appearance border w-full py-2 px-4 text-gray-700 mb-1 focus:outline-none rounded shadow"
              type="password"
              id="password"
              placeholder="Enter your password ..."
            />
          </div>
          <div class="mb-6 relative text-sm">
            <input type="checkbox" id="show">
            <label for="show"> Show password </label>
          </div>
          <router-link
            class="inline-block cursor-pointer align-baseline text-sm text-blue-500 hover:text-blue-600"
            to="forgot"
          >
            Forgot Password?
          </router-link>
          <div class="flex items-center justify-end">
            <button
              class="flex bg-blue-500 ground hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-primary focus:shadow-outline uppercase shadow"
              type="submit"
            >
              Next
            </button>
          </div>
        </form>
    </div>
  </div>
</template>
