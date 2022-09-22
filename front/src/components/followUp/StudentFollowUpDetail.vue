<template>
  <div>
    <div class="bg-gray-200 mt-[4rem] border-b-2 border-gray-400 cursor-pointer" @click="showImfo">
      <!-- icon back to followup page -->
      <div class="p-2  text-center text-lg uppercase">
        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </div>
      <div class=" flex items-center ml-10 relative rounded" >
        <div class="relative ">
          <img class="w-40 h-40 rounded-full " src="../../assets/avatar.png" alt="">
        </div>
        <div class="ml-5 leading-9 text-[25px]">
          <p>Huymey kum</p>
        </div>
      </div>
    </div>
    <!-- information of student -->
    <div class="p-5  flex justify-around border-b-2 border-gray-400" v-if="isShow">
      <div>
        <h1 class="text-[19px]"><b>Gender:</b>Female</h1>
        <h1 class="text-[19px]"><b>Class:</b> WEB B</h1>
      </div>
      <div>
        <h1 class="text-[19px]"><b>Batch:</b> 2022</h1>
        <h1 class="text-[19px]"><b>Email:</b> huymey.kum@student.passerellesnumeriques.org</h1>
      </div>
    </div>
    <div class="p-8 ml-8">
      <div>
        <p>
          Discription :
        </p>
        
      </div>
      <p>
        Lorem ipsum dolor sit amet,
        consectetur adipisicing elit. Ab incidunt dolor
        corrupti assumenda laudantium natus.
      </p>
    </div>
    
  </div>
</template>

<script>
export default {
data(){
  return{
    isShow:false,
  }
},
methods:{
  showImfo(){
    this.isShow = !this.isShow
  }
}
}
</script>

<style>

</style>