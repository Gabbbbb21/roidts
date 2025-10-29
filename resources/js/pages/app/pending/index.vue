<template>
  <div class="flex">
    <SideBar />
    <main class="flex-1 p-6">
      <!-- <div v-for="request in requests" :key="request.id" class="card">
        <div class="card-body">
          <h5 class="card-title">{{ request.fname }}</h5>
          <p class="card-text">{{ request.lname }}</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div> -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Last Name
                </th>
                <th scope="col" class="px-6 py-3">
                    First Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Document Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Notes
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="request in requests" :key="request.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ request.lname }}
                </th>
                <td class="px-6 py-4">
                    {{ request.fname }}
                </td>
                <td class="px-6 py-4">
                    {{ request.doc_type }}
                </td>
                <td class="px-6 py-4">
                    {{ request.notes }}
                </td>
                <td class="px-6 py-4">
                    <Link :href="route('pending.edit', {requests: request.request_id})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</Link>
                </td>
            </tr>
        </tbody>
    </table>
</div>

    </main>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import SideBar from '@/components/SideBar.vue';

export default {
  
  components: {
    Link,
    SideBar,
  },

  props: {
    requests: Object,
  }
}
</script>

<style>

</style>