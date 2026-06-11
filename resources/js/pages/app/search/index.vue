<template>
  <div class="flex min-h-screen w-full bg-slate-50 dark:bg-gray-900 transition-colors duration-300 overflow-x-hidden">
    <SideBar />
    
    <main class="flex-1 p-8 lg:p-12 min-w-0 w-full">
      
      <div class="mb-8 w-full">
        <h1 class="text-2xl font-bold text-[#0B2545] dark:text-white flex items-center gap-2">
          <span>🔍</span> Document History Search
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
          Query and track real-time routing histories across institutional divisions.
        </p>
      </div>

      <form @submit.prevent="submitSearch" class="mb-8 flex gap-2 w-full">
        <div class="relative flex-1">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
            👤
          </div>
          <input
            v-model="search"
            type="text"
            placeholder="Search documents by first name, last name, or ID..."
            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-[#0B2545] focus:border-[#0B2545] block w-full ps-10 p-3.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
          />
        </div>
        
        <button
          type="submit"
          class="text-white bg-[#0B2545] hover:bg-[#134074] focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-xl text-sm px-6 py-3.5 text-center shadow-md shadow-blue-950/20 transition flex items-center gap-2"
        >
          <span>Search</span>
        </button>

        <button
          v-if="search"
          @click="clearSearch"
          type="button"
          class="text-[#0B2545] bg-amber-400 hover:bg-amber-500 focus:ring-4 focus:outline-none focus:ring-amber-300 font-semibold rounded-xl text-sm px-6 py-3.5 text-center transition"
        >
          Clear
        </button>
      </form>

      <div v-if="posts.length" class="w-full space-y-3">
        <div 
          v-for="post in posts" 
          :key="post.id" 
          @click="viewHistory(post)"
          class="group bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700/60 shadow-sm hover:shadow-md hover:border-blue-300 dark:hover:border-blue-900 cursor-pointer transition-all duration-200 flex items-center justify-between w-full"
        >
          <div class="flex items-center gap-4 min-w-0">
            <div class="h-11 w-11 flex-shrink-0 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-[#0B2545] dark:text-blue-400 flex items-center justify-center text-xl font-bold group-hover:bg-[#0B2545] group-hover:text-amber-400 transition-colors duration-200">
              📄
            </div>
            <div class="min-w-0">
              <h2 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-[#0B2545] dark:group-hover:text-blue-400 transition-colors truncate">
                {{ post.fname }} {{ post.lname }}
              </h2>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 flex items-center gap-2 overflow-hidden">
                <span class="font-semibold text-gray-400 flex-shrink-0">ID: #{{ post.id }}</span>
                <span class="text-gray-300 dark:text-gray-600 flex-shrink-0">|</span>
                <span class="italic truncate">{{ post.notes || 'No accompanying notes description available.' }}</span>
              </p>
            </div>
          </div>
          
          <div class="text-gray-300 group-hover:text-amber-500 group-hover:translate-x-1 transition-all text-xl flex-shrink-0 ml-4">
            ➔
          </div>
        </div>
      </div>

      <div v-else class="w-full text-center py-12 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
        <span class="text-4xl block mb-3">📁</span>
        <p class="text-gray-500 dark:text-gray-400 font-medium">No document tracking entries found matching your query.</p>
      </div>

      <div id="history-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
          <div class="relative bg-white rounded-xl shadow-2xl dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
            
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-700 border-gray-200 bg-[#0B2545] text-white">
              <div>
                <h3 class="text-base font-bold text-amber-400 uppercase tracking-wider">
                  Document Audit Trail
                </h3>
                <p class="text-[11px] text-blue-200" v-if="activeDocument">
                  Tracking for: {{ activeDocument.fname }} {{ activeDocument.lname }}
                </p>
              </div>
              <button type="button" @click="closeHistoryModal()"
                class="text-blue-200 bg-transparent hover:bg-white/10 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>

            <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto" v-if="activeDocument">
              <div class="grid grid-cols-2 gap-4 bg-slate-50 dark:bg-gray-900/50 p-4 rounded-xl text-xs border border-gray-100 dark:border-gray-800">
                <div>
                  <span class="text-gray-400 block uppercase tracking-wider font-semibold">Document ID</span>
                  <span class="font-bold text-gray-900 dark:text-white">#{{ activeDocument.id }}</span>
                </div>
                <div>
                  <span class="text-gray-400 block uppercase tracking-wider font-semibold">Current Status</span>
                  <span class="inline-block mt-0.5 px-2 py-0.5 rounded font-bold bg-amber-50 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400">
                    {{ activeDocument.status || 'ACTIVE' }}
                  </span>
                </div>
              </div>

              <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Routing Footprints</h4>
                <ol class="relative border-s border-gray-200 dark:border-gray-700 ms-2 space-y-4">                  
                  <li class="ms-6">
                    <span class="absolute flex items-center justify-center w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full -start-3 ring-8 ring-white dark:ring-gray-800 text-xs">
                      ✓
                    </span>
                    <h3 class="font-semibold text-sm text-gray-900 dark:text-white">Document Created</h3>
                    <time class="block mb-1 text-[11px] font-normal leading-none text-gray-400 dark:text-gray-500">Originating Unit</time>
                    <p class="text-xs text-gray-500 dark:text-gray-400">File safely encoded and tracked via dashboard repository.</p>
                  </li>
                  <li class="ms-6">
                    <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-full -start-3 ring-8 ring-white dark:ring-gray-800 text-xs text-blue-600 dark:text-blue-300">
                      📥
                    </span>
                    <h3 class="font-semibold text-sm text-gray-900 dark:text-white">In Processing</h3>
                    <time class="block mb-1 text-[11px] font-normal leading-none text-gray-400 dark:text-gray-500">Notes Attachment</time>
                    <p class="text-xs text-gray-500 dark:text-gray-400 italic">"{{ activeDocument.notes || 'No specialized system remarks appended.' }}"</p>
                  </li>
                </ol>
              </div>
            </div>

            <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
              <button type="button" @click="closeHistoryModal()"
                class="py-2 px-4 text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">
                Close Audit Record
              </button>
            </div>

          </div>
        </div>
      </div>

    </main>
  </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
import SideBar from '@/components/SideBar.vue';
import { Modal } from 'flowbite';
import { nextTick } from 'vue';

export default {
  components: {
    SideBar,
  },

  props: {
    posts: Array,
    filters: Object,
  },

  data() {
    return {
      search: this.filters.search || '',
      activeDocument: null,
      flowbiteHistoryModal: null
    };
  },

  mounted() {
    nextTick(() => {
      const modalElement = document.getElementById('history-modal');
      if (modalElement) {
        this.flowbiteHistoryModal = new Modal(modalElement, {
          backdrop: 'dynamic',
          closable: true,
        });
      }
    });
  },

  methods: {
    submitSearch() {
      router.get(route('search.index'), { search: this.search }, {
        replace: true,
        preserveScroll: true,
      });
    },

    clearSearch() {
      this.search = '';
      this.submitSearch();
    },

    viewHistory(documentPayload) {
      this.activeDocument = documentPayload;
      if (this.flowbiteHistoryModal) {
        this.flowbiteHistoryModal.show();
      }
    },

    closeHistoryModal() {
      if (this.flowbiteHistoryModal) {
        this.flowbiteHistoryModal.hide();
      }
      setTimeout(() => {
        this.activeDocument = null;
      }, 200);
    }
  },
};
</script>