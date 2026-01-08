<!-- <template>
    <div class="flex">
        <SideBar />
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Pending</h1>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="p-6 bg-gray-50 rounded-lg shadow-inner">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                        <div v-for="request in requests" :key="request.id"
                            @click="loadAndOpenHistory(request.id) || setCurrrentRequest(request.id)" :class="[
                                'bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer transition duration-150 ease-in-out border-2',
                                request.id == selectedRequestId
                                    ? 'border-blue-500 ring-4 ring-blue-100 dark:bg-gray-800'
                                    : 'border-transparent hover:shadow-xl dark:bg-gray-900 dark:hover:bg-gray-800'
                            ]">
                            <div class="p-6 w-full">
                                <div
                                    class="uppercase tracking-wide text-sm text-indigo-600 font-bold border-b pb-4 mb-4 dark:text-indigo-400">
                                    Request #{{ request.request_id }}
                                </div>

                                <div class="flex grid grid-cols-1 gap-4 text-gray-700 dark:text-gray-300 pb-3">

                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Full
                                            Name</p>
                                        <p class="mt-1 text-base font-semibold text-gray-900 dark:text-white">
                                            {{ request.fname }} {{ request.mname }} {{ request.lname }}
                                        </p>
                                    </div>

                                    <div class="grid md:grid md:grid-cols-2 md:gap-4">
                                        <div class="shrink">
                                            <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                                Status
                                            </p>
                                            <span :class="[
                                                'mt-1 inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium',
                                                request.status === 'Done' ? 'bg-green-100 text-green-800' :
                                                    request.status === 'Processing' ? 'bg-yellow-100 text-yellow-800' :
                                                        'bg-red-100 text-red-800'
                                            ]">
                                                {{ request.status }}
                                            </span>
                                        </div>

                                        <div class="shrink">
                                            <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                                Document Type</p>
                                            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ request.doc_type }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-span-full">
                                        <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Notes
                                        </p>
                                        <p
                                            class="mt-1 text-sm text-gray-700 bg-gray-50 p-3 rounded-md border border-gray-100 italic dark:bg-gray-700 dark:text-gray-200">
                                            {{ request.notes }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="uppercase tracking-wide text-sm text-indigo-600 font-bold border-t pt-3 mb-4 dark:text-indigo-400 flex flex-row sm:flex-col sm:space-y-2">
                                    <div class="shrink">
                                        <Link :href="route('pending.edit', { requests: request.request_id })"
                                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            @click.stop>
                                        Update</Link>
                                    </div>
                                    <div class="">
                                        <Link data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                            @click="setCurrrentRequest(request.request_id)"
                                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            type="button">
                                        Forward
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division /
                                    Unit</label>
                                <select id="new_division" name="new_division" v-model="form.new_division"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected="">Select divisions</option>
                                    <option v-for="(division, i) in filteredDivisions" :key="i"
                                        :value="division.division_name">
                                        {{ division.division_name }}
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
        <History ref="historyPanel">
            <div v-if="selectedRequestId" class="p-4 space-y-3">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white border-b pb-2">History for Request #{{
                    selectedRequestId }}</h4>
                <div v-if="requestHistories.length > 0">
                    <div v-for="(history, i) in requestHistories" :key="i"
                        class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">Notes: {{ history.notes }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Status: <span class="font-semibold">{{ history.status }}</span>
                            <br>
                            Date: {{ new Date(history.created_at).toLocaleDateString() }}
                        </p>
                    </div>
                </div>
                <div v-else class="p-4 text-center text-gray-500 dark:text-gray-400">
                    No history found for this request.
                </div>
            </div>
            <div v-else class="p-4 text-center text-gray-500 dark:text-gray-400">
                Click on a Request ID in the table to view its history.
            </div>
        </History>
    </div>
</template> -->

<template>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <SideBar />

        <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
            <h1 class="text-4xl font-extrabold mb-4 text-gray-900 dark:text-white">
                ⏳ Pending Requests
            </h1>

            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 border-b border-gray-200 dark:border-gray-700 pb-4"
                style="text-indent: 2rem;">
                This page displays all document requests currently **in progress or awaiting action** within your unit.
                Click on any card to view its history, update its status, or forward it to the next designated division
                or unit for processing.
            </p>
            <div v-if="requests.length">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-xl">

                <div class="p-4 sm:p-6 bg-gray-50 dark:bg-gray-700/30 rounded-lg shadow-inner">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                        <div v-for="request in requests" :key="request.id" @click="loadAndOpenHistory(request.id)"
                            :class="[
                                'bg-white dark:bg-gray-800 rounded-xl shadow-lg cursor-pointer',
                                'transition duration-200 ease-in-out border-2 hover:shadow-2xl hover:scale-[1.01]',

                                request.id == selectedRequestId
                                    ? 'border-blue-500 ring-4 ring-blue-200/50 dark:ring-blue-800/50 dark:bg-gray-700'
                                    : 'border-transparent dark:hover:bg-gray-700/80'
                            ]">

                            <div class="p-6 w-full space-y-4">

                                <div
                                    class="uppercase tracking-widest text-sm text-blue-600 dark:text-blue-400 font-extrabold border-b border-gray-100 dark:border-gray-700 pb-3 mb-2">
                                    Request ID: #{{ request.request_id }}
                                </div>

                                <div class="grid grid-cols-1 gap-4 text-gray-700 dark:text-gray-300">

                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                            Full Name
                                        </p>
                                        <p class="mt-1 text-lg font-bold text-gray-900 dark:text-white">
                                            {{ request.fname }} {{ request.mname }} {{ request.lname }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">

                                        <div>
                                            <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                                Status
                                            </p>
                                            <span :class="[
                                                'mt-1 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold',
                                                request.status === 'Done' ? 'bg-green-50 text-green-700 ring-1 ring-green-600 dark:bg-green-900/30 dark:text-green-400' :
                                                    request.status === 'Processing' ? 'bg-yellow-50 text-yellow-700 ring-1 ring-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400' :
                                                        'bg-red-50 text-red-700 ring-1 ring-red-600 dark:bg-red-900/30 dark:text-red-400'
                                            ]">
                                                {{ request.status }}
                                            </span>
                                        </div>

                                        <div>
                                            <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                                Document Type</p>
                                            <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ request.doc_type }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Notes
                                        </p>
                                        <p
                                            class="mt-1 text-sm text-gray-700 bg-gray-100 dark:bg-gray-700 p-3 rounded-lg border border-gray-200 dark:border-gray-600 italic dark:text-gray-200 whitespace-pre-wrap">
                                            {{ request.notes || 'N/A' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 dark:border-gray-700 pt-4 flex space-x-3 mt-4">
                                    <Link :href="route('pending.edit', { requests: request.id })"
                                        class="flex-1 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-lg text-sm px-4 py-2 text-center dark:bg-indigo-500 dark:hover:bg-indigo-600 dark:focus:ring-indigo-800 transition duration-150"
                                        @click.stop>
                                    ✏️ Update
                                    </Link>

                                    <!-- <Link data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                        @click.stop="setCurrrentRequest(request.request_id)"
                                        class="flex-1 text-indigo-600 bg-indigo-50 hover:bg-indigo-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-lg text-sm px-4 py-2 text-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400 transition duration-150"
                                        type="button">
                                        ➡️ Forward
                                    </Link> -->
                                    <button @click.stop="openForwardModalForRequest(request.id)" type="button"
                                        class="flex-1 text-indigo-600 bg-indigo-50 hover:bg-indigo-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-lg text-sm px-4 py-2 text-center dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400 transition duration-150">
                                        ➡️ Forward
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div v-else>
        <p class="text-gray-500">No Request found.</p>
      </div>
        </main>

        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl">

                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-700 rounded-t">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            Route to New Division/Unit
                        </h3>
                        <!-- <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button> -->

                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            @click="closeForwardModal()">
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <form @submit.prevent="forward()" class="p-6 md:p-8">
                        <div class="mb-6">
                            <label for="new_division"
                                class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                Select Division / Unit
                            </label>
                            <select id="new_division" name="new_division" v-model="form.new_division"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled>Select divisions</option>
                                <option v-for="(division, i) in filteredDivisions" :key="i"
                                    :value="division.division_name">
                                    {{ division.division_name }}
                                </option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full text-white inline-flex justify-center items-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-base px-5 py-3 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 transition duration-150">
                            <svg class="me-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l4.532-2.311a1 1 0 00.569-.997V11a1 1 0 112 0v5.529a1 1 0 00.569.997l4.532 2.311a1 1 0 001.169-1.409l-7-14z">
                                </path>
                            </svg>
                            Confirm Forward
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <History ref="historyPanel"
            class="border-l border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-2xl">
            <div v-if="selectedRequestId" class="p-6 space-y-4">
                <h4
                    class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">
                    ⏱️ History for Request #{{ selectedRequestId }}
                </h4>
                <div v-if="requestHistories.length > 0" class="space-y-4">
                    <div v-for="(history, i) in requestHistories" :key="i"
                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md border-l-4 border-blue-500 dark:border-blue-400">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-100 leading-relaxed">
                            <span class="font-semibold text-gray-900 dark:text-white">Notes:</span> {{ history.notes }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Status:</span>
                            <span class="font-semibold ml-1">{{ history.status }}</span>
                            <span class="mx-2 text-gray-400 dark:text-gray-600">|</span>
                            <span class="font-bold text-gray-700 dark:text-gray-300">Date:</span>
                            {{ new Date(history.created_at).toLocaleDateString('en-US', {
                                year: 'numeric', month:
                            'short', day: 'numeric' }) }}
                        </p>
                    </div>
                </div>
                <div v-else
                    class="p-6 text-center text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    No history found for this request.
                </div>
            </div>
            <div v-else class="p-6 text-center text-gray-500 dark:text-gray-400">
                Click on a Request Card to view its history.
            </div>
        </History>
    </div>
</template>

<script>
// Import the Modal class from flowbite
import { Modal } from 'flowbite'; // Make sure this path is correct
import SideBar from '@/components/SideBar.vue';
import History from '@/components/History.vue';

import { Link, router, useForm } from '@inertiajs/vue3';
import { nextTick } from 'vue'; // Import nextTick for Flowbite initialization

export default {

    // --- Components & Props (No Change Needed) ---
    components: {
        Link,
        SideBar,
        History
    },

    props: {
        requests: Object,
        // ... (rest of your props)
        divisions: Object,
        requestHistories: Object,
        selectedRequestId: [String, Number, null],
        userDivisionName: {
            type: String,
            required: true
        }
    },

    // --- Data Setup ---
    data() {
        return {
            form: useForm({
                request_id: null,
                new_division: '',
            }),

            // New local state to hold the Flowbite Modal instance
            flowbiteModal: null,
        }
    },

    // --- Lifecycle Hook ---
    mounted() {
        // Use nextTick to ensure the DOM element for the modal is rendered
        nextTick(() => {
            const modalEl = document.getElementById('crud-modal');

            if (modalEl) {
                // Initialize the Flowbite Modal instance programmatically
                this.flowbiteModal = new Modal(modalEl, {
                    // Optional: Flowbite configuration
                    backdrop: 'dynamic',
                    closable: true,
                });

                // Important: Attach a listener to reset the form state when modal closes
                // This prevents accidentally submitting the wrong request ID later.
                modalEl.addEventListener('hidden.bs.modal', () => {
                    this.form.request_id = null;
                    this.form.new_division = '';
                });
            }
        });
    },

    // --- Computed (No Change Needed) ---
    computed: {
        filteredDivisions() {
            return this.divisions.filter(division => division.division_name !== this.userDivisionName);
        }
    },

    // --- Methods (Updates below) ---
    methods: {

        loadHistory(requestId) {
            router.get(route('pending.index'), {
                requestId: requestId
            }, {
                preserveState: true,
                preserveScroll: true,

                onSuccess: () => {
                    // This relies on your History component having an openHistory() method
                    this.$refs.historyPanel.openHistory();
                }
            });
        },

        loadAndOpenHistory(requestId) {
            this.loadHistory(requestId);
        },

        setCurrrentRequest(requestId) {
            // 1. Set the form ID
            this.form.request_id = requestId;

            // 2. Programmatically open the modal if the instance exists
            // if (this.flowbiteModal) {
            //     this.flowbiteModal.show();
            // }
        },

        openForwardModalForRequest(requestId) {
            this.form.request_id = requestId;
            this.form.new_division = ''; // Clear selection on open for clean slate

            // Programmatically open the modal (The ONLY place where flowbiteModal.show() is called)
            if (this.flowbiteModal) {
                this.flowbiteModal.show();
            }
        },

        forward() {
            // 1. --- VALIDATION CHECK (NEW CODE) ---
            if (!this.form.new_division) {
                // You can add a more visible error notification here (e.g., using a toast or alert)
                console.error("Please select a new Division/Unit before forwarding.");
                alert("Please select a new Division/Unit before forwarding."); // Simple alert for immediate feedback
                return; // Stop the function execution if division is not selected
            }

            if (!this.form.request_id) {
                console.error("No request ID set for forwarding.");
                return;
            }
            // 2. --- END VALIDATION CHECK ---

            // Proceed with Inertia request if validation passes
            this.form.put(route('pending.forward', { request: this.form.request_id }), {
                onError: (errors) => {
                    console.error("Error during update:", errors);
                },
                onSuccess: () => {
                    // Programmatically hide the modal on successful form submission (Part of Flowbite fix)
                    if (this.flowbiteModal) {
                        this.flowbiteModal.hide();
                    }
                    console.log('Update successful! Inertia handles navigation.');
                }
            });
        },

        // New method to close the modal manually (for the close button in the header)
        closeForwardModal() {
            if (this.flowbiteModal) {
                this.flowbiteModal.hide();
            }
        }
    }
}
</script>

<style></style>