<!-- <template>
    <div class="flex">
        <SideBar />
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard Overview</h1>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <a href="/incoming"
                        class="block bg-gray-50 p-4 rounded-lg shadow-sm hover:bg-gray-100 transition duration-150 ease-in-out">
                        <p class="text-lg font-semibold text-gray-700">Incoming Request</p>
                        <p class="text-4xl font-bold text-gray-900">{{ requests }}</p>
                    </a>
                    <a href="/pending"
                        class="block bg-gray-50 p-4 rounded-lg shadow-sm hover:bg-gray-100 transition duration-150 ease-in-out">
                        <p class="text-lg font-semibold text-gray-700">Pending</p>
                        <p class="text-4xl font-bold text-gray-900">{{ pendings }}</p>
                    </a>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-700">Processed</p>
                        <p class="text-4xl font-bold text-gray-900">{{ finishes }}</p>
                    </div>
                </div>

                <div class="p-6 bg-gray-50">
                    <div class="bg-white shadow-xl rounded-lg p-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">Documents</h2>
                        <div class="h-96 w-full">
                            <BarChart :data="chartData" />
                        </div>
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
                Dashboard Overview
            </h1>

            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 border-b border-gray-200 dark:border-gray-700 pb-4" style="text-indent: 2rem;">
                This dashboard provides a **real-time summary** of all document processing activities, including incoming requests, currently pending items, and successfully processed documents. Use the table below to review detailed request data and history.
            </p>
            <div class="space-y-10">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <a href="/incoming"
                        class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl hover:scale-[1.02] transition duration-300 ease-in-out border border-transparent hover:border-blue-500">
                        <p class="text-sm uppercase tracking-wider font-medium text-gray-500 dark:text-gray-400">Incoming Requests</p>
                        <p class="text-5xl font-extrabold mt-2 text-blue-600 dark:text-blue-400">{{ requests }}</p>
                    </a>
                    
                    <a href="/pending"
                        class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl hover:scale-[1.02] transition duration-300 ease-in-out border border-transparent hover:border-yellow-500">
                        <p class="text-sm uppercase tracking-wider font-medium text-gray-500 dark:text-gray-400">Pending</p>
                        <p class="text-5xl font-extrabold mt-2 text-yellow-600 dark:text-yellow-400">{{ pendings }}</p>
                    </a>
                    
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg transition duration-300 ease-in-out border border-transparent">
                        <p class="text-sm uppercase tracking-wider font-medium text-gray-500 dark:text-gray-400">Processed</p>
                        <p class="text-5xl font-extrabold mt-2 text-green-600 dark:text-green-400">{{ finishes }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl p-6 lg:p-8">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3">
                        📊 Document Distribution
                    </h2>
                    <div class="h-96 w-full">
                        <BarChart :data="chartData" />
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                        📑 Latest Requests
                    </h2>
                    <div class="relative overflow-x-auto rounded-lg border border-gray-100 dark:border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300 sticky top-0">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ID</th>
                                    <th scope="col" class="px-6 py-3">Last Name</th>
                                    <th scope="col" class="px-6 py-3">First Name</th>
                                    <th scope="col" class="px-6 py-3 hidden sm:table-cell">Middle Name</th>
                                    <th scope="col" class="px-6 py-3">Document Type</th>
                                    <th scope="col" class="px-6 py-3 hidden lg:table-cell">Notes</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr v-for="display_request in display_requests" :key="display_request.id"
                                    @click="loadAndOpenHistory(display_request.id)" :class="[
                                        'border-b dark:border-gray-700 cursor-pointer',
                                        'transition duration-200 ease-in-out',
                                        
                                        // Highlight the currently selected display_request row
                                        display_request.id == selectedRequestId
                                            ? 'bg-blue-50 dark:bg-blue-950 border-blue-400 shadow-inner hover:bg-blue-100 dark:hover:bg-blue-900'
                                            : 'bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50'
                                    ]">
                                    
                                    <th scope="row" class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ display_request.id }}
                                    </th>
                                    <td class="px-6 py-4"> {{ display_request.lname }} </td>
                                    <td class="px-6 py-4"> {{ display_request.fname }} </td>
                                    <td class="px-6 py-4 hidden sm:table-cell"> {{ display_request.mname }} </td>
                                    <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-400">
                                        {{ display_request.doc_type }}
                                    </td>
                                    <td class="px-6 py-4 truncate max-w-xs hidden lg:table-cell">
                                        {{ display_request.notes || '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span :class="[
                                            'px-3 py-1 text-xs font-semibold rounded-full',
                                            // Conditional styling for Status
                                            display_request.status === 'Incoming Request' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' :
                                            display_request.status === 'Pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' :
                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                        ]">
                                            {{ display_request.status }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <History ref="historyPanel" class="border-l border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-2xl">
            <div v-if="selectedRequestId" class="p-6 space-y-4">
                <h4 class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">
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
                            {{ new Date(history.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) }}
                        </p>
                    </div>
                </div>
                <div v-else class="p-6 text-center text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    No history found for this request.
                </div>
            </div>
            <div v-else class="p-6 text-center text-gray-500 dark:text-gray-400">
                Click on a Request ID in the table to view its history.
            </div>
        </History>
    </div>
</template>

<script>
import SideBar from '@/components/SideBar.vue';
import History from '@/components/History.vue';
import BarChart from '@/components/BarChart.vue'

import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

export default {

    components: {
        SideBar,
        History,
        BarChart
    },

    props: {
        requests: Object,
        display_requests: Object,
        pendings: Object,
        finishes: Object,
        requestHistories: Object,
        selectedRequestId: [String, Number, null],
        chartData: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            form: useForm({
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