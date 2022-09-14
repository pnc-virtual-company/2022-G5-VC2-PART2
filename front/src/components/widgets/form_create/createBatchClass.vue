<template>
    <div class="w-full h-full bg-black z-50 bg-opacity-60 flex items-center justify-center fixed top-0">
        <div class="main-form w-[30%]">
            <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
                <p></p>
                <!-- use v-slot to put your title of card -->
                <slot name="card-title"></slot> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" @click="$emit('closeForm')">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <form class="shadow p-4 bg-white py-9">
                <div class="flex w-full">
                    <br />
                    <input
                        type="text"
                        class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        id="lastNameInput"
                        placeholder= "please text ..."
                    />
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 mx-2 text-white p-1.5 px-4 rounded focus:outline-none focus:shadow-outline h-10">Add</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>