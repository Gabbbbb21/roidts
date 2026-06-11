<template>
  <div class="flex min-h-screen w-full bg-slate-50 dark:bg-gray-900 transition-colors duration-300 overflow-x-hidden">
    <SideBar />

    <main class="flex-1 p-8 lg:p-12 min-w-0 w-full">
      <div class="mb-8 w-full border-b border-gray-200 dark:border-gray-700 pb-5">
        <h1 class="text-3xl font-black text-[#0B2545] dark:text-white flex items-center gap-3">
          <span>⏳</span> Pending Requests
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 max-w-4xl">
          This page displays all document requests currently **in progress or awaiting action** within your unit. Click on any card to view its history, update its status, or forward it to the next designated division or unit for processing.
        </p>
      </div>
      
      <div v-if="requests.length" class="w-full">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700/50">
          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 w-full">

            <div v-for="request in requests" :key="request.id" @click="loadAndOpenHistory(request.id)"
              :class="[
                'bg-white dark:bg-gray-800 rounded-xl shadow-md cursor-pointer',
                'transition-all duration-200 ease-in-out border-2 hover:shadow-xl hover:scale-[1.01]',
                request.id == selectedRequestId
                  ? 'border-amber-500 ring-4 ring-amber-500/10 dark:bg-gray-700/40'
                  : 'border-slate-100 dark:border-gray-700 hover:border-blue-400 dark:hover:bg-gray-700/40'
              ]">

              <div class="p-5 w-full space-y-4">
                <div class="text-xs uppercase tracking-widest font-black text-blue-700 dark:text-blue-400 border-b border-gray-100 dark:border-gray-700 pb-3 flex justify-between items-center">
                  <span>Tracking: #{{ request.request_id }}</span>
                  <span class="text-base opacity-40">📄</span>
                </div>

                <div class="grid grid-cols-1 gap-4 text-gray-700 dark:text-gray-300">
                  <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider dark:text-gray-500">Full Name</p>
                    <p class="mt-0.5 text-base font-bold text-gray-900 dark:text-white truncate">
                      {{ request.fname }} {{ request.mname }} {{ request.lname }}
                    </p>
                  </div>

                  <div class="grid grid-cols-2 gap-2">
                    <div>
                      <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider dark:text-gray-500">Status</p>
                      <span :class="[
                        'mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold border',
                        request.status === 'Done' ? 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-400 dark:border-emerald-900' :
                        request.status === 'Processing' ? 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-950/40 dark:text-amber-400 dark:border-amber-900' :
                        'bg-rose-50 text-rose-700 border-rose-200 dark:bg-rose-950/40 dark:text-rose-400 dark:border-rose-900'
                      ]">
                        {{ request.status }}
                      </span>
                    </div>

                    <div>
                      <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider dark:text-gray-500">Document Type</p>
                      <p class="mt-1 text-xs font-semibold text-gray-800 dark:text-gray-200 truncate">
                        {{ request.doc_type }}
                      </p>
                    </div>
                  </div>

                  <div class="col-span-full">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider dark:text-gray-500">Notes / Remarks</p>
                    <p class="mt-1 text-xs text-gray-600 bg-slate-50 dark:bg-gray-900 p-3 rounded-lg border border-gray-100 dark:border-gray-700 italic dark:text-gray-400 h-16 overflow-y-auto line-clamp-2 whitespace-pre-wrap">
                      {{ request.notes || 'No system remarks appended.' }}
                    </p>
                  </div>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-700 pt-3 flex space-x-2 mt-2">
                  <Link :href="route('pending.edit', { requests: request.id })"
                    class="flex-1 text-white bg-amber-600 hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-200 font-bold rounded-lg text-xs px-3 py-2 text-center transition duration-150"
                    @click.stop>
                    ✏️ Update
                  </Link>

                  <button @click.stop="openForwardModalForRequest(request.id)" type="button"
                    class="flex-1 text-[#0B2545] bg-[#0B2545]/5 hover:bg-[#0B2545]/10 font-bold rounded-lg text-xs px-3 py-2 text-center dark:text-amber-400 dark:bg-amber-400/10 dark:hover:bg-amber-400/20 transition duration-150">
                    ➡️ Forward
                  </button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div v-else class="text-center p-12 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700/50">
        <span class="text-4xl block mb-2">📁</span>
        <p class="text-gray-400 dark:text-gray-500 font-medium">No pending requests found inside this structural unit.</p>
      </div>
    </main>

    <Teleport to="body">
      <div v-if="printData" class="print-container-wrapper">
        <PrintableTracking :request="printData" />
      </div>
    </Teleport>

    <div id="crud-modal" tabindex="-1" aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-700 rounded-t">
            <h3 class="text-base font-black text-[#0B2545] dark:text-white">Route to New Division/Unit</h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-slate-100 hover:text-gray-900 rounded-lg text-sm w-7 h-7 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white" @click="closeForwardModal()">
              <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
          </div>

          <form @submit.prevent="handlePrintConfirmation()" class="p-6">
            <div class="mb-5">
              <label for="new_division" class="block mb-2 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-400">Select Target Division / Unit</label>
              <select id="new_division" name="new_division" v-model="form.new_division" class="bg-slate-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                <option value="" disabled>Select target organizational area</option>
                <option v-for="(division, i) in filteredDivisions" :key="i" :value="division.division_name">{{ division.division_name }}</option>
              </select>
            </div>
            <button type="submit" class="w-full text-white inline-flex justify-center items-center bg-[#0B2545] hover:bg-[#163a63] focus:ring-4 focus:outline-none focus:ring-blue-100 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-amber-500 dark:hover:bg-amber-600 dark:text-gray-950 transition duration-150">
              ➡️ Validate & Print Verification
            </button>
          </form>
        </div>
      </div>
    </div>

    <div v-if="showPrintVerifyGate" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm">
      <div class="bg-white dark:bg-gray-800 rounded-xl max-w-sm w-full p-6 shadow-2xl border border-gray-100 dark:border-gray-700 text-center space-y-4">
        <div class="mx-auto flex items-center justify-center h-11 w-11 rounded-full bg-amber-50 dark:bg-amber-950/40 text-amber-600 text-xl border border-amber-200 dark:border-amber-900">🖨️</div>
        <h3 class="text-lg font-black text-[#0B2545] dark:text-white">Did the document print successfully?</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
          Confirming print success pushes this tracking segment forward into the next structural division. Clicking **Abort** terminates updates.
        </p>
        <div class="flex space-x-2 pt-2">
          <button type="button" @click="abortForwarding()" class="flex-1 py-2 px-3 text-xs font-bold text-gray-700 bg-slate-100 hover:bg-slate-200 rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">❌ Cancel / Abort</button>
          <button type="button" @click="executeBackendForward()" class="flex-1 py-2 px-3 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-md transition">✅ Yes, Proceed</button>
        </div>
      </div>
    </div>

    <div id="history-modal" tabindex="-1" aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700">
          
          <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-700 rounded-t">
            <h3 class="text-base font-black text-[#0B2545] dark:text-white flex items-center gap-2">
              <span>⏱️</span> Structural History Log: #{{ selectedRequestId || '...' }}
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-slate-100 hover:text-gray-900 rounded-lg text-sm w-7 h-7 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white" @click="closeHistoryModal()">
              <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
            </button>
          </div>

          <div class="p-6 space-y-4 max-h-[50vh] overflow-y-auto">
            <div v-if="requestHistories && requestHistories.length > 0" class="space-y-3">
              <div v-for="(history, i) in requestHistories" :key="i"
                class="p-4 bg-slate-50 dark:bg-gray-950 rounded-lg border-l-4 border-l-[#0B2545] dark:border-l-amber-500 border border-gray-200/60 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium leading-relaxed">
                  <span class="font-bold text-gray-400 uppercase tracking-wide block text-[10px] mb-1">System Action Notes</span> 
                  {{ history.notes || 'No system remarks appended.' }}
                </p>
                <div class="text-[11px] text-gray-400 dark:text-gray-500 mt-3 pt-2 border-t border-gray-100 dark:border-gray-900 flex justify-between items-center">
                  <div>
                    <span class="font-bold">Lifecycle Status:</span>
                    <span class="ml-1 font-semibold text-blue-600 dark:text-blue-400">{{ history.status }}</span>
                  </div>
                  <div>
                    <span class="font-bold">Stamped:</span>
                    <span class="ml-1">{{ new Date(history.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }) }}</span>
                  </div>
                </div>
              </div>
            </div>
            <div v-else class="p-8 text-center text-xs italic text-gray-400 dark:text-gray-500 bg-slate-50 dark:bg-gray-900 rounded-lg border border-dashed border-gray-200 dark:border-gray-700">
              No previous verification trails found associated with this record entry.
            </div>
          </div>

          <div class="flex justify-end p-4 border-t border-gray-100 dark:border-gray-700 rounded-b">
            <button type="button" @click="closeHistoryModal()" class="py-1.5 px-4 text-xs font-bold text-gray-600 bg-slate-50 hover:bg-slate-100 border border-gray-200 rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
              Dismiss Panel
            </button>
          </div>

        </div>
      </div>
    </div>

  </div>
</template>

<script>
import { Modal } from 'flowbite';
import SideBar from '@/components/SideBar.vue';
import PrintableTracking from '@/components/PrintableTracking.vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import { nextTick } from 'vue';

export default {
  components: {
    Link,
    SideBar,
    PrintableTracking
  },

  props: {
    requests: Object, 
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
      }),
      flowbiteModal: null,      // Routing overlay reference
      historyModal: null,       // Audit modal reference
      printData: null,
      showPrintVerifyGate: false, 
    }
  },

  mounted() {
    nextTick(() => {
      // Initialize Forwarding Dropdown Modal
      const modalEl = document.getElementById('crud-modal');
      if (modalEl) {
        this.flowbiteModal = new Modal(modalEl, {
          backdrop: 'dynamic',
          closable: true,
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
          if (!this.showPrintVerifyGate) {
            this.form.request_id = null;
            this.form.new_division = '';
          }
        });
      }

      // Initialize History Modal
      const historyEl = document.getElementById('history-modal');
      if (historyEl) {
        this.historyModal = new Modal(historyEl, {
          backdrop: 'dynamic',
          closable: true
        });
      }
    });
  },

  computed: {
    filteredDivisions() {
      return this.divisions ? this.divisions.filter(division => division.division_name !== this.userDivisionName) : [];
    }
  },

  methods: {
    loadHistory(requestId) {
      router.get(route('pending.index'), {
        requestId: requestId
      }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          if (this.historyModal) {
            this.historyModal.show();
          }
        }
      });
    },

    loadAndOpenHistory(requestId) {
      this.loadHistory(requestId);
    },

    openForwardModalForRequest(requestId) {
      this.form.request_id = requestId;
      this.form.new_division = '';
      if (this.flowbiteModal) {
        this.flowbiteModal.show();
      }
    },

    handlePrintConfirmation() {
      if (!this.form.new_division) {
        alert("Please select a new Division/Unit before forwarding.");
        return;
      }

      const requestToPrint = this.requests.find(r => r.id === this.form.request_id);
      if (!requestToPrint) return;

      this.printData = {
        ...requestToPrint,
        new_division: this.form.new_division
      };

      if (this.flowbiteModal) {
        this.flowbiteModal.hide();
      }

      nextTick(() => {
        setTimeout(() => {
          if (this.printData) {
            window.print();
            this.showPrintVerifyGate = true;
          }
        }, 400);
      });
    },

    executeBackendForward() {
      this.showPrintVerifyGate = false;

      this.form.put(route('pending.forward', { request: this.form.request_id }), {
        preserveScroll: true,
        onSuccess: () => {
          this.printData = null;
          this.form.reset();
        },
        onError: (errors) => {
          console.error("Routing Exception:", errors);
          this.printData = null;
        }
      });
    },

    abortForwarding() {
      this.showPrintVerifyGate = false;
      this.printData = null;
      this.form.reset();
    },

    closeForwardModal() {
      if (this.flowbiteModal) {
        this.flowbiteModal.hide();
      }
    },

    closeHistoryModal() {
      if (this.historyModal) {
        this.historyModal.hide();
      }
    }
  }
}
</script>

<style>
@media print {
  body > * {
    display: none !important;
  }

  body > .print-container-wrapper {
    display: block !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    visibility: visible !important;
  }

  .print-container-wrapper * {
    visibility: visible !important;
    overflow: visible !important;
  }
}
</style>