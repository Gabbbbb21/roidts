<template>
  <div class="flex">
    <SideBar />
    <main class="flex-1 p-6">
      <h1 class="text-2xl font-bold mb-4">Search Document</h1>

      <form @submit.prevent="submitSearch" class="mb-6 flex">
        <input
          v-model="search"
          type="text"
          placeholder="Search document by First Name or Last Name..."
          class="border p-2 rounded-l-md w-full"
        />
        <button
          type="submit"
          class="bg-blue-500 text-white p-2 rounded-r-md hover:bg-blue-600"
        >
          Search
        </button>
        <button
          v-if="search"
          @click="clearSearch"
          type="button"
          class="bg-gray-300 text-gray-800 p-2 rounded-r-md ml-2 hover:bg-gray-400"
        >
          Clear
        </button>
      </form>

      <div v-if="posts.length">
        <div v-for="post in posts" :key="post.id" class="border p-4 mb-3 rounded-lg shadow-sm">
          <h2 class="text-xl font-semibold">{{ post.fname }}</h2>
          <p class="text-gray-600">
            {{ (post.lname?.substring(0, 100) ?? '[N/A]') }}...
          </p>
        </div>
      </div>
      <div v-else>
        <p class="text-gray-500">No posts found.</p>
      </div>
    </main>
  </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
import SideBar from '@/components/SideBar.vue';

export default {
  // --- Options API Structure ---

  components: {
    SideBar,
  },

  props: {
    posts: Array,
    filters: Object,
  },

  // Data properties are defined here
  data() {
    return {
      // The reactive property is named 'search'
      search: this.filters.search || '',
    };
  },

  methods: {
    submitSearch() {
      // Access the data property via 'this.search'
      router.get(route('search.index'), { search: this.search }, {
        replace: true,
        preserveScroll: true,
      });
    },

    clearSearch() {
      this.search = '';
      this.submitSearch();
    },
  },
};
</script>

<style>
/* Your styles here */
</style>