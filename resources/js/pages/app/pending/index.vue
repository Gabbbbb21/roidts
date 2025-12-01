<template>
    <div class="flex">
        <SideBar />
        <main class="flex-1 p-6">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm" v-for="request in requests" :key="request.id" @click="loadAndOpenHistory(request.id)" :class="[
                            'border-b dark:border-gray-700 cursor-pointer transition duration-150 ease-in-out',
                            // Highlight the currently selected request row
                            request.id == selectedRequestId
                                ? 'bg-blue-100 dark:bg-blue-900 border-blue-400 hover:bg-blue-200 dark:hover:bg-blue-800'
                                : 'odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700'
                        ]">
                        <p class="text-lg font-semibold text-gray-700">Request #{{ request.request_id }}</p>
                        <p class="text-4xl font-bold text-gray-900"></p>
                    </div>
                    <!-- <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-700">Pending</p>
                        <p class="text-4xl font-bold text-gray-900">{{ pendings }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-700">Processed</p>
                        <p class="text-4xl font-bold text-gray-900">{{ finishes }}</p>
                    </div> -->
                </div>
                </div>
        </main>
        <History ref="historyPanel">
            <!-- <div v-for="(requestHistory, i) in requestHistories" :key="i" >
                {{  requestHistory.notes }}
            </div> -->
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
</template>

<script>
import SideBar from '@/components/SideBar.vue';
import History from '@/components/History.vue';

import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { initFlowbite } from "flowbite";

export default {

    mounted() {
        initFlowbite();
    },

    computed: {
        filteredDivisions() {
            return this.divisions.filter(division => division.division_name !== this.userDivisionName);
        }
    },

    components: {
        Link,
        SideBar,
        History
    },

    props: {
        requests: Object,
        request: Object,
        divisions: Object,
        requestHistories: Object,
        selectedRequestId: [String, Number, null],
        userDivisionName: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            form: useForm({
                request_id: null,
                new_division: '',
                // 'notes': '',
                // 'status': '',
            }),

            currentRequestId: null
        }
    },

    methods: {
        loadHistory(requestId) {
            // Using router.get to reload the current page URL with the 'requestId' query parameter
            router.get(route('pending.index'), {
                requestId: requestId
            }, {
                // Keep existing form state and scroll position during the reload
                preserveState: true,
                preserveScroll: true,

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

        forward() {
            if (!this.form.request_id) {
                console.error("No request ID set for forwarding.");
                return;
            }

            this.form.put(route('pending.forward', { request: this.form.request_id }), {
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

<style></style>