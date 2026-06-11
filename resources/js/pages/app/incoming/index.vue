<template>
    <div class="flex min-h-screen bg-slate-50 dark:bg-gray-900 transition-colors duration-300">
        <SideBar />
        
        <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
            <div class="relative overflow-x-auto shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <table class="w-full text-sm text-left rtl:text-right text-gray-600 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-[#0B2545] dark:bg-gray-700/80 dark:text-gray-300 border-b border-[#0B2545] dark:border-gray-600">
                        <tr>
                            <th scope="col" class="px-6 py-4 tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-4 tracking-wider">Last Name</th>
                            <th scope="col" class="px-6 py-4 tracking-wider">First Name</th>
                            <th scope="col" class="px-6 py-4 tracking-wider">Middle Name</th>
                            <th scope="col" class="px-6 py-4 tracking-wider">Document Type</th>
                            <th scope="col" class="px-6 py-4 tracking-wider">Notes</th>
                            <th scope="col" class="px-6 py-4 tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-center tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="request in requests" :key="request.id" @click="loadHistory(request.id)" :class="[
                            'border-b dark:border-gray-700/60 cursor-pointer transition duration-150 ease-in-out',
                            request.id == selectedRequestId
                                ? 'bg-amber-500/10 dark:bg-amber-500/20 border-l-4 border-l-amber-500 dark:border-l-amber-400 hover:bg-amber-500/15 dark:hover:bg-amber-500/25'
                                : 'odd:bg-white odd:dark:bg-gray-900 even:bg-slate-50 even:dark:bg-gray-800/40 border-gray-200 dark:border-gray-800 hover:bg-slate-100 dark:hover:bg-gray-700/40'
                        ]">
                            <th scope="row" class="px-6 py-4 font-bold text-[#0B2545] whitespace-nowrap dark:text-amber-400">
                                #{{ request.id }}
                            </th>
                            <td class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                                {{ request.lname }}
                            </td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ request.fname }}</td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ request.mname || '-' }}</td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-medium">{{ request.doc_type }}</td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400 italic max-w-xs truncate">
                                {{ request.notes || 'No system remarks' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-800 border border-amber-200 dark:bg-amber-950/40 dark:text-amber-400 dark:border-amber-900">
                                    {{ request.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex gap-1.5 justify-center items-center" @click.stop>
                                <button type="button" @click="openAcceptModal(request.request_id)"
                                    class="text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:outline-none focus:ring-emerald-200 font-bold rounded-lg text-xs px-3 py-2 dark:bg-emerald-600 dark:hover:bg-emerald-500 transition">
                                    Accept
                                </button>
                                
                                <button type="button" @click="setCurrrentRequest(request.request_id)"
                                    class="text-white bg-amber-600 hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-200 font-bold rounded-lg text-xs px-3 py-2 dark:bg-amber-500 dark:hover:bg-amber-600 dark:text-gray-950 transition">
                                    Forward
                                </button>

                                <form @submit.prevent="closeRequest(request.request_id)">
                                    <button type="submit"
                                        class="text-white bg-rose-600 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-200 font-bold rounded-lg text-xs px-3 py-2 dark:bg-rose-600 dark:hover:bg-rose-500 transition">
                                        Close
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="crud-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-xl shadow-2xl dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-700 border-gray-200">
                            <h3 class="text-base font-black text-[#0B2545] dark:text-white">
                                Route to new Division/Unit
                            </h3>
                            <button type="button" @click="closeForwardModal()"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-7 h-7 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                        <form @submit.prevent="forward()" class="p-5">
                            <div class="mb-5">
                                <label for="new_division" class="block mb-2 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-400">
                                    Select Target Division / Unit
                                </label>
                                <select id="new_division" name="new_division" v-model="form.new_division"
                                    class="bg-slate-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                                    <option value="">Select target structural unit</option>
                                    <option v-for="(division, i) in filteredDivisions" :key="i" :value="division.division_name">
                                        {{ division.division_name }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                class="w-full text-white inline-flex justify-center items-center bg-[#0B2545] hover:bg-[#163a63] focus:ring-4 focus:outline-none focus:ring-blue-100 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-amber-500 dark:hover:bg-amber-600 dark:text-gray-950 transition duration-150">
                                Forward Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="accept-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-xl shadow-2xl dark:bg-gray-800 border border-gray-100 dark:border-gray-700 text-center p-6 space-y-4">
                        <div class="mx-auto flex items-center justify-center h-11 w-11 rounded-full bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 text-xl border border-emerald-200 dark:border-emerald-900">
                            📂
                        </div>
                        <h3 class="text-lg font-black text-[#0B2545] dark:text-white">Confirm Document Receipt</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                            Are you sure you have physically received the hard copy of this document tracking profile within your unit?
                        </p>
                        <div class="flex space-x-2 pt-2">
                            <button type="button" @click="closeAcceptModal()" 
                                class="flex-1 py-2 px-3 text-xs font-bold text-gray-700 bg-slate-100 hover:bg-slate-200 rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">
                                Cancel
                            </button>
                            <button type="button" @click="executeAcceptance()" 
                                class="flex-1 py-2 px-3 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-md transition">
                                Yes, Confirm Receipt
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</template>

<script>
import SideBar from '@/components/SideBar.vue';
import { router, useForm } from '@inertiajs/vue3';
import { Modal } from 'flowbite';
import { nextTick } from 'vue';

export default {
    components: {
        SideBar
    },

    props: {
        requests: Object,
        request: Object,
        divisions: Object,
        userDivisionName: {
            type: String,
            required: true
        },
        selectedRequestId: [String, Number, null]
    },

    data() {
        return {
            form: useForm({
                request_id: null,
                new_division: '',
            }),
            flowbiteForwardModal: null, 
            flowbiteAcceptModal: null,  
        }
    },

    mounted() {
        nextTick(() => {
            const forwardEl = document.getElementById('crud-modal');
            if (forwardEl) {
                this.flowbiteForwardModal = new Modal(forwardEl, { backdrop: 'dynamic', closable: true });
            }

            const acceptEl = document.getElementById('accept-modal');
            if (acceptEl) {
                this.flowbiteAcceptModal = new Modal(acceptEl, { backdrop: 'dynamic', closable: true });
            }
        });
    },

    computed: {
        filteredDivisions() {
            return this.divisions ? this.divisions.filter(division => division.division_name !== this.userDivisionName) : [];
        }
    },

    methods: {
        // --- Forward Routing Logic ---
        setCurrrentRequest(requestId) {
            this.form.request_id = requestId;
            if (this.flowbiteForwardModal) {
                this.flowbiteForwardModal.show();
            }
        },
        forward() {
            if (!this.form.request_id) return;

            this.form.put(route('incoming.forward', { request: this.form.request_id }), {
                onSuccess: () => {
                    this.closeForwardModal();
                    this.form.reset();
                },
                onError: (errors) => console.error("Forwarding mismatch pipeline issue:", errors)
            });
        },
        closeForwardModal() {
            if (this.flowbiteForwardModal) this.flowbiteForwardModal.hide();
        },

        // --- Receipt Acceptance Logic ---
        openAcceptModal(requestId) {
            this.form.request_id = requestId;
            if (this.flowbiteAcceptModal) {
                this.flowbiteAcceptModal.show();
            }
        },
        closeAcceptModal() {
            if (this.flowbiteAcceptModal) this.flowbiteAcceptModal.hide();
            this.form.request_id = null;
        },
        executeAcceptance() {
            if (!this.form.request_id) return;

            this.form.put(route('incoming.accept', { request: this.form.request_id }), {
                onSuccess: () => {
                    this.closeAcceptModal();
                    this.form.reset();
                },
                onError: (errors) => console.error("Acceptance processing issue:", errors)
            });
        },

        // --- Complete Lifecycle Closure Logic ---
        closeRequest(requestId) {
            this.form.request_id = requestId;
            if (!this.form.request_id) return;

            this.form.put(route('incoming.close', { request: this.form.request_id }), {
                onError: (errors) => console.error("Lifecycle termination issue:", errors),
                onSuccess: () => this.form.reset()
            });
        },

        loadHistory(requestId) {
            router.get(route('incoming.index'), {
                requestId: requestId
            }, {
                preserveState: true,
                preserveScroll: true
            });
        }
    }
}
</script>