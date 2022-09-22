<template>
  <div>
    <div class="w-[90%]  bg-gray-200 m-auto mt-20 mb-5  p-4  drop-shadow-md ">
      <p class="text-[20px]">Notifycation *</p>
      <div class="flex mt-5 cursor-pointer ">
        <div class="p-1.5 bg-blue-600 rounded-full drop-shadow-lg" :class="{'bg-gray-400': !isSeen}"></div>
        <div class="ml-3 bg-white rounded-md w-full flex justify-between drop-shadow-lg hover:bg-gray-200">
          <div class="flex">
            <img src="../../assets/avatar.png" class="w-12 h-12 rounded-full border-2 border-primary m-2" />
            <p class="text-gray-500 ml-5 mt-5" v-if="!isReplayBack"><b >Huymey kum</b> has replied on <b>you</b> in follow up list</p>
            <p class="text-gray-500 ml-5 mt-5" v-if="!isTeacherCommentToStudent"><b >Sokhom</b> has commented on <b>Huymey kum</b> in follow up list</p>
            <p class="text-gray-500 ml-5 mt-5" v-if="!isStudentReplyToTeacher"><b >Huymey kum</b> has replied on <b>Sokhom</b> in follow up list</p>
            <p class="text-gray-500 ml-5 mt-5" v-if="isCommentFromTeacher"><b >Sokhom</b> has commented on <b>you</b> in follow up list</p>
          </div>
          <p class="text-gray-400 m-5">30m</p>
        
        </div>
      </div>
      <p class="flex justify-end text-gray-400 m-1">Mon.19.08.2022</p>
    </div>
  </div>
</template>

<script>
export default {
data(){
  return{
    isSeen:'seen',
    isReplayBack:'replayback',
    isTeacherCommentToStudent:'teacherToStudent',
    isStudentReplyToTeacher :'studentToTeacher',
    isCommentFromTeacher :'commentFromTeacher'
  }
}
}
</script>

<style>

</style>