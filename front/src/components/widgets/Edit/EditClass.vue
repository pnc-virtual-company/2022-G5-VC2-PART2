<template>
    <div class="w-full h-full bg-black z-50 bg-opacity-60 flex items-center justify-center fixed top-0">
        <div class="main-form w-[30%] rounded">
            <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
                <p class="ml-3">UPDATE CLASS</p>
                <!-- use v-slot to put your title of card -->
                <slot name="card-title"></slot> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <form class="shadow p-4 bg-white py-9" @submit.prevent="addClass">
                <div class="flex w-full h-12">
                    <br />
                    <input
                        type="number"
                        class="shadow appearance-none border rounded w-[60%] px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                        id="lastNameInput"
                        placeholder= "Class ..."
                    />
                    <button-create>
                        <template v-slot:button_create>Save Change</template>      
                    </button-create>
                </div>
            </form>
        </div>
    </div>
</template>
