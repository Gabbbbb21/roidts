<template>
    <div class="flex">
        <SideBar />
        <!-- <main class="flex-1 p-6">
            <form @submit.prevent="update()">
                <div class="card">
                    <div class="card-body">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" v-model="form.fname">
                    </div>
                    <button type="submit">Update</button>
                </div>
            </form>
        </main> -->
        <main class="flex-1 p-6">
            <div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-lg mt-10">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Document Submission Form</h2>
                <form @submit.prevent="update()" class="space-y-4">

                    <div>
                        <label for="fname" class="block text-sm font-medium text-gray-700 mb-1">First Name:</label>
                        <input type="text" id="fname" name="fname" v-model="form.fname"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                            placeholder="e.g., John">
                    </div>

                    <div>
                        <label for="mname" class="block text-sm font-medium text-gray-700 mb-1">Middle Name:</label>
                        <input type="text" id="mname" name="mname" v-model="form.mname"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                            placeholder="e.g., D.">
                    </div>

                    <div>
                        <label for="lname" class="block text-sm font-medium text-gray-700 mb-1">Last Name:</label>
                        <input type="text" id="lname" name="lname" v-model="form.lname"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                            placeholder="e.g., Doe">
                    </div>

                    <div>
                        <label for="doc_type" class="block text-sm font-medium text-gray-700 mb-1">Document
                            Type:</label>
                        <input type="text" id="doc_type" name="doc_type" v-model="form.doc_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                            placeholder="e.g., Passport, ID">
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes:</label>
                        <input type="text" id="notes" name="notes" v-model="form.notes"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                            placeholder="Any important details...">
                    </div>

                    <div>
                        <label for="action" class="block text-sm font-medium text-gray-700 mb-1">Action:</label>
                        <input type="text" id="action" name="action" v-model="form.action"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                            placeholder="e.g., Review, Approve">
                    </div>

                    <button type="submit"
                        class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out mt-6">
                        Update
                    </button>

                </form>
            </div>
        </main>
    </div>
</template>

<script>
import SideBar from '@/components/SideBar.vue'
import { useForm } from "@inertiajs/vue3"

export default {

    components: {
        SideBar
    },

    data() {
        return {
            form: useForm({
                request_id: this.requests.request_id,
                fname: this.requests.fname,
                mname: this.requests.mname,
                lname: this.requests.lname,
                doc_type: this.requests.doc_type,
                notes: this.requests.notes,
                action: this.requests.action,
            })
        }    
    },

    props: {
        requests: Object
    },

    methods: {
        update() {

            this.form.put(route('pending.update', this.form.request_id), {
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