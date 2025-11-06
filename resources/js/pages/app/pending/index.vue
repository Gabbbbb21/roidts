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
                        <tr v-for="request in requests" :key="request.id"
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                                <Link :href="route('pending.edit', {requests: request.request_id})"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</Link>
                                <!-- <Link :href="route('pending.forward', {requests: request.request_id})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Forward</Link> -->
                                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                    @click="setCurrrentRequest(request.request_id)"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    Toggle modal
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="crud-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Route to new Division/Unit: 
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form @submit.prevent="forward()" class="p-4 md:p-5">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="new_division"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division / Unit</label>
                                    <select id="new_division" name="new_division" v-model="form.new_division"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected="">Select divisions</option>
                                        <option v-for="(division, i) in divisions" :key="i" :value="division.division_name">
                                            {{division.division_name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Forward
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import SideBar from '@/components/SideBar.vue';
import { useForm } from '@inertiajs/vue3';
import { initFlowbite } from "flowbite";

export default {

    mounted() {
        initFlowbite(); // Initialize Flowbite on mount of the Vue component
    },
  
  components: {
    Link,
    SideBar,
  },

  props: {
    requests: Object,
    request: Object,
    divisions: Object,
  },

  data() {
      return {
        form: useForm ({
            request_id: null,
            new_division: '',
            // 'notes': '',
            // 'status': '',
        }),

        currentRequestId: null
      }
  },

  methods: {
    setCurrrentRequest(requestId) {
        this.form.request_id = requestId;
    },

    forward() {
        if (!this.form.request_id) {
            console.error("No request ID set for forwarding.");
            return;
        }

        this.form.put(route('pending.forward', {request: this.form.request_id}), {
            onError: (errors) => {
                    console.log("Error during update:", errors);
                },
                onSuccess: () => {
                    console.log('Update successful! Inertia handles navigation.');
                }
        });
    }
  }
}
</script>

<style>

</style>