<template>
  <div class="flex min-h-screen w-full bg-slate-50 dark:bg-gray-900 transition-colors duration-300 overflow-x-hidden">
    <SideBar />
    
    <main class="flex-1 p-8 lg:p-12 min-w-0 w-full">
      <div class="mb-8 w-full border-b border-gray-200 dark:border-gray-700 pb-5">
        <h1 class="text-3xl font-black text-[#0B2545] dark:text-white flex items-center gap-3">
          <span>📊</span> Dashboard Overview
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 max-w-4xl">
          This system dashboard provides a **real-time administrative summary** of all active Civil Service document processing matrices, including incoming routings, pending compliance reviews, and successfully cleared requests.
        </p>
      </div>

      <div class="space-y-8 w-full">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
          
          <a href="/incoming"
            class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.01] transition-all duration-200 border-l-4 border-blue-600 dark:border-blue-500 group">
            <p class="text-xs uppercase tracking-widest font-bold text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Incoming Requests</p>
            <div class="flex items-baseline justify-between mt-2">
              <p class="text-4xl font-black text-[#0B2545] dark:text-white">{{ requests }}</p>
              <span class="text-xl opacity-40 group-hover:opacity-100 transition-opacity">📥</span>
            </div>
          </a>
          
          <a href="/pending"
            class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.01] transition-all duration-200 border-l-4 border-amber-500 group">
            <p class="text-xs uppercase tracking-widest font-bold text-gray-400 group-hover:text-amber-500 transition-colors">Pending Reviews</p>
            <div class="flex items-baseline justify-between mt-2">
              <p class="text-4xl font-black text-amber-500">{{ pendings }}</p>
              <span class="text-xl opacity-40 group-hover:opacity-100 transition-opacity">⏳</span>
            </div>
          </a>
          
          <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md border-l-4 border-emerald-500 flex flex-col justify-between">
            <p class="text-xs uppercase tracking-widest font-bold text-gray-400">Successfully Processed</p>
            <div class="flex items-baseline justify-between mt-2">
              <p class="text-4xl font-black text-emerald-600 dark:text-emerald-400">{{ finishes }}</p>
              <span class="text-xl opacity-40">✅</span>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 lg:p-8 border border-gray-100 dark:border-gray-700/50 w-full">
          <h2 class="text-lg font-bold mb-4 text-[#0B2545] dark:text-white flex items-center gap-2">
            <span>📈</span> Institutional Document Distribution Metrics
          </h2>
          <div class="h-80 w-full">
            <BarChart :data="chartData" />
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700/50 w-full">
          <h2 class="text-lg font-bold mb-4 text-[#0B2545] dark:text-white flex items-center gap-2">
            <span>📑</span> Real-time Routing Ledger
          </h2>
          
          <div class="relative overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 w-full">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-white uppercase bg-[#0B2545] sticky top-0 tracking-wider">
                <tr>
                  <th scope="col" class="px-6 py-4">Tracking ID</th>
                  <th scope="col" class="px-6 py-4">Last Name</th>
                  <th scope="col" class="px-6 py-4">First Name</th>
                  <th scope="col" class="px-6 py-4 hidden sm:table-cell">Middle Name</th>
                  <th scope="col" class="px-6 py-4">Document Type</th>
                  <th scope="col" class="px-6 py-4 hidden lg:table-cell">Notes Descriptor</th>
                  <th scope="col" class="px-6 py-4 text-center">Lifecycle Status</th>
                </tr>
              </thead>
              
              <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                <tr v-for="display_request in display_requests" :key="display_request.id"
                  @click="loadAndOpenHistory(display_request.id)" 
                  :class="[
                    'cursor-pointer transition-all duration-150 ease-in-out',
                    display_request.id == selectedRequestId
                      ? 'bg-amber-50/60 dark:bg-blue-950/40 border-l-4 border-amber-500 hover:bg-amber-50 dark:hover:bg-blue-950'
                      : 'bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700/40'
                  ]"
                >
                  <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                    #{{ display_request.id }}
                  </th>
                  <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-200">{{ display_request.lname }}</td>
                  <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-200">{{ display_request.fname }}</td>
                  <td class="px-6 py-4 hidden sm:table-cell text-gray-600 dark:text-gray-400">{{ display_request.mname || '-' }}</td>
                  <td class="px-6 py-4 font-semibold text-blue-700 dark:text-blue-400">
                    {{ display_request.doc_type }}
                  </td>
                  <td class="px-6 py-4 truncate max-w-xs hidden lg:table-cell italic text-gray-400 dark:text-gray-500">
                    {{ display_request.notes || 'No system remarks appended.' }}
                  </td>
                  <td class="px-6 py-4 text-center whitespace-nowrap">
                    <span :class="[
                      'px-3 py-1 text-xs font-bold rounded-full border',
                      display_request.status === 'Incoming Request' ? 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-900' :
                      display_request.status === 'Pending' ? 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-950/40 dark:text-amber-400 dark:border-amber-900' :
                      'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-400 dark:border-emerald-900'
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

    <History ref="historyPanel" class="border-l border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-2xl transition-all duration-300">
      <div v-if="selectedRequestId" class="p-6 space-y-6">
        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
          <h4 class="text-lg font-black text-[#0B2545] dark:text-white flex items-center gap-2">
            <span class="text-amber-500">⏱️</span> Audit History Trail
          </h4>
          <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Audit footprints for Request Token #{{ selectedRequestId }}</p>
        </div>

        <div v-if="requestHistories.length > 0" class="space-y-4 max-h-[75vh] overflow-y-auto pr-1">
          <div v-for="(history, i) in requestHistories" :key="i"
            class="p-4 bg-slate-50 dark:bg-gray-950 rounded-xl border border-gray-200 dark:border-gray-800 border-l-4 border-l-[#0B2545] dark:border-l-amber-500 shadow-sm">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wide">System Remarks</p>
            <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mt-1 leading-relaxed">
              {{ history.notes || 'No notes specified.' }}
            </p>
            
            <div class="flex items-center justify-between text-[11px] text-gray-400 dark:text-gray-500 mt-4 pt-2 border-t border-gray-100 dark:border-gray-900">
              <div>
                <span class="font-bold text-gray-500 dark:text-gray-400">Status:</span>
                <span class="font-semibold ml-1 text-gray-700 dark:text-gray-300">{{ history.status }}</span>
              </div>
              <div>
                <span class="font-bold text-gray-500 dark:text-gray-400">Stamped:</span>
                <span class="ml-1">{{ new Date(history.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) }}</span>
              </div>
            </div>
          </div>
        </div>
        
        <div v-else class="p-8 text-center text-gray-400 dark:text-gray-500 bg-slate-50 dark:bg-gray-900 rounded-xl border border-dashed border-gray-200 dark:border-gray-800">
          No routing milestones tracked on this specific file context.
        </div>
      </div>
      
      <div v-else class="p-8 text-center text-sm text-gray-400 dark:text-gray-500 font-medium h-full flex flex-col items-center justify-center">
        <span class="text-3xl block mb-2">👈</span>
        Select any record row in the tracking ledger grid to examine live institutional routing loops.
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
      router.get(route('dashboard.index'), {
        requestId: requestId
      }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.$refs.historyPanel.openHistory();
        }
      });
    },

    loadAndOpenHistory(requestId) {
      this.loadHistory(requestId);
    },

    setCurrrentRequest(requestId) {
      this.form.request_id = requestId;
    },
  }
}
</script>