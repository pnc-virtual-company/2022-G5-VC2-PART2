<template>
  <div>
    <template>
      <button :class="mode">
        <div class="add-people w-14 h-10  rounded shadow hover:bg-slate-200 bg-white cursor-pointer p-2">
          <button-add>
            <template #header></template>
          </button-add>
        </div>
      </button>
    </template>
  </div>
</template>

<script>
import buttonAdd from "../../teacher/TeacherList.vue";
export default {
  components: {
    "button-add": buttonAdd,
  },
   props: ['mode'],
};
</script>

<style scoped>
button {
  padding: 0.75rem 1.5rem;
  font-family: inherit;
  background-color: var(--main-color);
  border: 1px solid var(--main-color);
  color: white;
  cursor: pointer;
}

button:hover,
button:active {
  background-color: var(--main-color-light);
  border-color: var(--main-color-light);
}

.flat {
  background-color: transparent;
  color: var(--main-color);
  border: none;
}

.flat:hover,
.flat:active {
  background-color: #edd2ff;
}
</style>
