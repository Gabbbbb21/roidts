<!-- <template>
  <div class="flex">
    <SideBar />
    <main class="flex-1 p-6">
      <div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-lg mt-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Document Submission Form</h2>
        <form @submit.prevent="submit()" class="space-y-4">

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
            <label for="doc_type" class="block text-sm font-medium text-gray-700 mb-1">Document Type:</label>
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
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status:</label>
            <!-- <input type="text" id="status" name="status" v-model="form.status"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
              placeholder="e.g., Review, Approve"> -->
            <!-- <select name="status" id="status" v-model="form.status"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
              <option value="">Select status</option>
              <option value="Processing">Processing</option>
              <option value="Forwarded">Forwarded</option>
              <option value="For Realesed">For Realesed</option>
              <option value="Done">Done</option>
            </select>
          </div>

          <button type="submit"
            class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out mt-6">
            Submit
          </button>

        </form>
      </div>
    </main>
  </div>
</template> -->

<template>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <SideBar />
        
        <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
            <h1 class="text-4xl font-extrabold mb-4 text-gray-900 dark:text-white">
                📝 Create New Request
            </h1>
            
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 border-b border-gray-200 dark:border-gray-700 pb-4" style="text-indent: 2rem;">
                Use this form to submit a new document request. Please ensure all required fields, including the recipient's name, document type, and initial status, are accurately entered before submission.
            </p>
            <div class="flex justify-center">
                <div class="w-full max-w-xl p-8 bg-white dark:bg-gray-800 rounded-xl shadow-2xl">
                    <h2 class="text-2xl font-bold mb-8 text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3">
                        Document Submission Form
                    </h2>
                    
                    <form @submit.prevent="submit()" class="space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <div>
                                <label for="fname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First Name:</label>
                                <input type="text" id="fname" name="fname" v-model="form.fname"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    placeholder="John">
                            </div>
                            
                            <div>
                                <label for="mname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Middle Name:</label>
                                <input type="text" id="mname" name="mname" v-model="form.mname"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    placeholder="D. (Optional)">
                            </div>
                            
                            <div>
                                <label for="lname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Name:</label>
                                <input type="text" id="lname" name="lname" v-model="form.lname"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    placeholder="Doe">
                            </div>
                        </div>

                        <div>
                            <label for="doc_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Document Type:</label>
                            <input type="text" id="doc_type" name="doc_type" v-model="form.doc_type"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                placeholder="e.g., Passport, Birth Certificate, Contract">
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes:</label>
                            <input type="text" id="notes" name="notes" v-model="form.notes"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                placeholder="Any important details, specific requirements, or special instructions...">
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Initial Status:</label>
                            <select name="status" id="status" v-model="form.status"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                <option value="" disabled selected class="text-gray-400 dark:text-gray-500">Select initial status</option>
                                <option value="Incoming Request">Incoming Request</option>
                                <option value="Processing">Processing</option>
                                <option value="For Released">For Released</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-white dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out mt-8">
                            🚀 Submit New Request
                        </button>

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
        onFinish: () => this.form.reset,

        onError: (errors) => {
          console.log(errors)
        },
      })
    }
  }

}
</script>

<style></style>