<template>
        <div class="flex justify-end items-center relative">
        <input v-model="keyword" @input="$emit('newKeyword',keyword)"
          type="text"
          class="shadow appearance-none w-36 focus:w-64 duration-200 ease-in-out border ml-2 rounded px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
        />
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute top-2 text-gray-400 right-2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
      </div>
</template>

<script>
export default {
  props:{
    placeholder:String
  },
data(){
    return{
        keyword:''
    }
}
}
</script>

<style>

</style>