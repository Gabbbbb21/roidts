<template>
  <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <div class="text-2xl font-bold mb-6">Application Name</div>
    <nav>
      <ul>
        <li v-for="item in menuItems" :key="item.name" class="mb-2">
          <Link :href="item.route" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
            <span class="mr-3">{{ item.icon }}</span>
            <span>{{ item.label }}</span>
          </Link>
        </li>
        <li class="mb-2">
          <Link href="/logout" method="post" as="button" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
            <span class="mr-3">🔒</span>
            <span>Logout</span>
          </Link>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'; // Assuming you are using Inertia.js

const menuItems = [
  { label: 'Dashboard', route: '/dashboard', icon: '📊' },
  { label: 'Pending', route: '/pending', icon: '⏳' },
  { label: 'Create', route: '/create', icon: '📝' },
  { label: 'Incoming', route: '/incoming', icon: '⬇️' },
  { label: 'Search', route: '/search', icon: '🔍' },
];
</script>

<style scoped>
</style>