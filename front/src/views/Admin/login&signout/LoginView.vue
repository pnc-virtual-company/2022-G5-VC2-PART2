<template>
  <div class="w-full m-auto h-[100vh] flex items-center justify-center">
    <div class="flex items-center justify-center w-[60%]">
      <div class="p-5 uppercase w-[50%]">
        <div>
          <h1 class="text-2xl font-semibold">Student follow up</h1>
          <span class="text-lg font-semibold"> Management System </span>
        </div>
        <img src="../../../assets/pic.png" alt="logo" class="w-[100%] m-auto" />
      </div>
      <form class="w-[50%]">
        <h1 class="text-2xl font-semibold text-center p-1 uppercase mt-4">
          Sign in now
        </h1>
        <div class="mb-5 relative">
          <label class="block text-gray-700 text-md" for="email">
            Email *
          </label>
          <input
            class="appearance border w-full py-2 px-3 text-gray-700 mb-1 focus:outline-none"
            type="email"
            id="email"
            placeholder="Email ..."
          />
        </div>
        <div class="flex items-center justify-end">
          <button
            class="flex bg-blue-500 ground  hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-primary focus:shadow-outline uppercase"
            type="submit"
          >
            sign in
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6 ml-2 duration-200 ease-out"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
              />
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
