<template>
    <div class="flex">
        <SideBar />
        <main class="flex-1 p-6">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-700">Incoming Request</p>
                        <p class="text-4xl font-bold text-gray-900">{{ requests }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-700">Pending</p>
                        <p class="text-4xl font-bold text-gray-900">{{ pendings }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-700">Processed</p>
                        <p class="text-4xl font-bold text-gray-900">{{ finishes }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="relative h-80">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Last Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            First Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Middle Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Document Type
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Notes
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="display_request in display_requests" :key="display_request.id"
                                        @click="loadAndOpenHistory(display_request.id)" :class="[
                                            'border-b dark:border-gray-700 cursor-pointer transition duration-150 ease-in-out',
                                            // Highlight the currently selected display_request row
                                            display_request.id == selectedRequestId
                                                ? 'bg-blue-100 dark:bg-blue-900 border-blue-400 hover:bg-blue-200 dark:hover:bg-blue-800'
                                                : 'odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700'
                                        ]">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ display_request.id }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ display_request.lname }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ display_request.fname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ display_request.mname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ display_request.doc_type }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ display_request.notes }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ display_request.status }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <History ref="historyPanel">
            <div v-if="selectedRequestId" class="p-4 space-y-3">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white border-b pb-2">History for Request #{{ selectedRequestId }}</h4>
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
</template>

<script>
import SideBar from '@/components/SideBar.vue';
import History from '@/components/History.vue';

import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

export default {

    components: {
        SideBar,
        History
    },

    props: {
        requests: Object,
        display_requests: Object,
        pendings: Object,
        finishes: Object,
        requestHistories: Object,
        selectedRequestId: [String, Number, null],
    },

    data() {
        return {
            form: useForm ({
                request_id: null
            }),
            currentRequestId: null
        }
    },

    methods: {
        loadHistory(requestId) {
            // Existing logic to load data for the history panel via Inertia
            router.get(route('dashboard.index'), { 
                requestId: requestId 
            }, {
                preserveState: true,
                preserveScroll: true,
                // On success, open the panel
                onSuccess: () => {
                    this.$refs.historyPanel.openHistory();
                }
            });
        },
        
        // New combined method to handle the row click
        loadAndOpenHistory(requestId) {
            // First, trigger the Inertia request to load the history data
            this.loadHistory(requestId);
            
            // The history panel is now opened in the onSuccess callback of loadHistory
        },

        setCurrrentRequest(requestId) {
            this.form.request_id = requestId;
        },
    }
}
</script>

<style></style>