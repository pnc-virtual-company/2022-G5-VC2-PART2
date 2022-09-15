<template>
  <div>
    <template>
      <div class="add-people w-14 h-10  rounded shadow hover:bg-slate-200 bg-white cursor-pointer p-2">
        <button-add>
          <template #header></template>
        </button-add>
      </div>
      <div class="shadow appearance-none w-36 focus:w-64 duration-200 ease-in-out border ml-2 rounded px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline">
        <search-bar>
          <template #card-body> </template>
        </search-bar>
      </div>
    </template>
  </div>
</template>

<script>
import searchBar from "../search/SearchBar.vue";
import buttonAdd from "../../teacher/TeacherList.vue";
export default {
  components: {
    "search-bar": searchBar,
    "button-add": buttonAdd,
  },
};
</script>

<style></style>
