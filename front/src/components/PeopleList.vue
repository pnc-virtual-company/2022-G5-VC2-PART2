<template>
        <table class="table-auto justify-between w-full rounded shadow p-4">
          <thead>
            <tr class=" p-4 bg-blue-400 shadow">
              <th class="text-center px-4 p-2 w-32 ">Profile</th>
              <th class="text-center p-2 w-40 ">First Name</th>
              <th class="text-center p-2 w-40">Last Name</th>
              <th class="text-center p-2 w-64 ">Email</th>
            </tr>
          </thead>
          <tbody class="bg-slate-100">
            <tr
              class="text-center relative p-2 h-16 hover:bg-slate-200 cursor-pointer"
              v-for="teacher of peopleList"
              :key="teacher.id"
            >
              <td class="text-center">
                <div class="flex items-cener justify-center">
                  <img
                    alt="Vue logo"
                    :src="teacher.profile"
                    class="w-10 h-10 rounded-full"
                  />
                </div>
              </td>
              <td class="text-center">{{ teacher.firstName }}</td>
              <td class="text-center">{{ teacher.lastName }}</td>
              <td class="text-left">{{ teacher.email }}</td>

            </tr>
          </tbody>
        </table>
</template>

<script>
export default {
  props: {
    peopleList: Array,
  },
};
</script>

<style></style>
