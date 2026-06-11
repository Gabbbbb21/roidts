<template>
    <div class="flex min-h-screen bg-slate-50 dark:bg-gray-900 transition-colors duration-300 w-full">
        <SideBar />
        
        <main class="flex-1 p-8 lg:p-12 overflow-y-auto w-full">
            <h1 class="text-3xl font-black mb-2 text-[#0B2545] dark:text-amber-400 tracking-tight flex items-center gap-3">
                <span>📝</span> Create New Request
            </h1>
            
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-8 border-b border-gray-200 dark:border-gray-700 pb-4 leading-relaxed w-full">
                Use this administrative profile routing module to register a new incoming trackable dossier file record. Ensure all mandatory fields (such as document category markers and base operational processing status states) are structurally verified before triggering pipeline sync operations.
            </p>

            <div class="w-full">
                <div class="w-full p-8 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700">
                    <h2 class="text-xs font-black mb-6 text-gray-400 dark:text-gray-300 uppercase tracking-wider border-b border-gray-100 dark:border-gray-700/60 pb-3">
                        Document Metadata Profile Entry Sheet
                    </h2>
                    
                    <form @submit.prevent="submit()" class="space-y-6 w-full">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
                            <div>
                                <label for="fname" class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">First Name *</label>
                                <input type="text" id="fname" name="fname" v-model="form.fname" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-slate-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0B2545] dark:focus:ring-amber-500 focus:border-transparent transition duration-150 ease-in-out text-sm"
                                    placeholder="John">
                            </div>
                            
                            <div>
                                <label for="mname" class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Middle Name</label>
                                <input type="text" id="mname" name="mname" v-model="form.mname"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-slate-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0B2545] dark:focus:ring-amber-500 focus:border-transparent transition duration-150 ease-in-out text-sm"
                                    placeholder="D. (Optional)">
                            </div>
                            
                            <div>
                                <label for="lname" class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Last Name *</label>
                                <input type="text" id="lname" name="lname" v-model="form.lname" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-slate-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0B2545] dark:focus:ring-amber-500 focus:border-transparent transition duration-150 ease-in-out text-sm"
                                    placeholder="Doe">
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="doc_type" class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Document Classification Type *</label>
                            <input type="text" id="doc_type" name="doc_type" v-model="form.doc_type" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-slate-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0B2545] dark:focus:ring-amber-500 focus:border-transparent transition duration-150 ease-in-out text-sm"
                                placeholder="e.g., Office Memo, Certification Request, Service Contract Record">
                        </div>

                        <div class="w-full">
                            <label for="notes" class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Detailed System Remarks / Description</label>
                            <textarea id="notes" name="notes" v-model="form.notes" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-slate-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0B2545] dark:focus:ring-amber-500 focus:border-transparent transition duration-150 ease-in-out text-sm resize-none"
                                placeholder="Enter structural routing instructions, physical log requirements, or critical target reference annotations here..."></textarea>
                        </div>

                        <div class="w-full">
                            <label for="status" class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Initial Lifecycle Baseline Status *</label>
                            <select name="status" id="status" v-model="form.status" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-slate-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0B2545] dark:focus:ring-amber-500 focus:border-transparent transition duration-150 ease-in-out text-sm">
                                <option value="" disabled class="text-gray-400 dark:text-gray-500">Select dynamic tracking pipeline operational stage state</option>
                                <option value="Incoming Request">Incoming Request</option>
                                <option value="Processing">Processing</option>
                                <option value="For Released">For Released</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-4 px-6 rounded-lg shadow-md text-sm font-bold text-white bg-[#0B2545] hover:bg-[#153e6d] dark:bg-amber-500 dark:hover:bg-amber-600 dark:text-gray-950 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0B2545] dark:focus:ring-amber-500 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out uppercase tracking-wider">
                                🚀 Commit &amp; Initialize Request Pipeline
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import SideBar from '@/components/SideBar.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        SideBar,
    },

    data() {
        return {
            form: useForm({
                'request_id': '',
                'fname': '',
                'mname': '',
                'lname': '',
                'doc_type': '',
                'notes': '',
                'status': '',
                'origin_user': '',
                'origin_division': '',
                'new_division': '',
                'new_user': '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(route('create.store'), {
                onFinish: () => this.form.reset(),
                onError: (errors) => {
                    if (typeof console !== 'undefined') {
                        console.error("Dossier record logging failure pipeline response payload:", errors);
                    }
                },
            });
        }
    }
}
</script>