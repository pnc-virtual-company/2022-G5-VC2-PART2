<template>
    <div class="w-full h-screen flex items-center justify-center">
        <div class="w-[60%] m-auto bg-white p-4 rounded shadow">
            <div class="m-auto w-10/12 ">
                <div class=" p-2 rounded-full text-center text-2xl capitalize relative">
                    Please create your password
                </div>
                <form class="mt-6 w-8/12 m-auto">
                    <div class="block">
                        <label for="">New password</label>
                            <input
                            type="password"
                            name="password"
                            class="shadow appearance-none border  rounded w-full px-2 py-2.5 border-gray-400 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                            placeholder="Enter new password ..."
                            v-model="new_password"
                            />
                    </div>
                    <div class="block mt-2">
                        <label for="">Confirm password</label>
                            <input
                            type="password"
                            name="contirm_password"
                            class="shadow appearance-none border  rounded w-full px-2 py-2.5 border-gray-400 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                            placeholder="Enter confirm password ..."
                            v-model="confirm_new_password"
                            />
                    </div>
                    <div class="block mt-2">
                        <input type="checkbox" class="cursor-pointer" name="" id="show">
                        <label for="show" class="ml-2 cursor-pointer">Show password</label>
                    </div>
                    <div class="flex items-center justify-end">
                        <button class="bg-primary p-2 rounded w-24 text-white  hover:bg-blue-400">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>