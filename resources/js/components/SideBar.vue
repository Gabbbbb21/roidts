<template>
  <aside class="w-68 bg-[#0B2545] border-r border-blue-950/40 text-slate-200 min-h-screen flex flex-col p-5 font-sans tracking-wide shadow-xl">
    <!-- CSC Identity Header Section -->
    <div class="flex items-center gap-3 px-2 py-4 mb-6 border-b border-blue-900/50 pb-6">
      <div class="h-10 w-10 rounded-full bg-amber-500 flex items-center justify-center text-[#0B2545] font-black text-xl shadow-md shadow-amber-500/20">
        🇵🇭
      </div>
      <div>
        <h2 class="text-xs font-black text-amber-400 tracking-widest uppercase">CSC Document Tracking</h2>
        <p class="text-[11px] text-blue-200 font-medium tracking-wide">Civil Service Commission Regional Office I</p>
      </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="flex-1 flex flex-col justify-between">
      <ul class="space-y-1.5">
        <!-- Main Navigation Items -->
        <li v-for="item in menuItems" :key="item.name">
          <Link 
            :href="item.route" 
            :class="[
              'flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group font-medium text-sm border',
              isActive(item.route)
                ? 'bg-gradient-to-r from-blue-700 to-[#134074] text-white shadow-lg shadow-blue-950/50 border-blue-500/30 font-semibold'
                : 'text-blue-200/80 border-transparent hover:text-white hover:bg-white/5'
            ]"
          >
            <!-- Left active indicator dot -->
            <span 
              :class="[
                'w-1.5 h-1.5 rounded-full transition-all duration-300 -ml-1',
                isActive(item.route) ? 'bg-amber-400 scale-100' : 'bg-transparent scale-0 group-hover:scale-100 group-hover:bg-blue-400/50'
              ]"
            ></span>

            <!-- Icon Wrapper -->
            <span :class="[
              'text-lg transition-transform duration-200 group-hover:scale-110',
              isActive(item.route) ? 'text-amber-400' : 'text-blue-300 group-hover:text-amber-300'
            ]">
              {{ item.icon }}
            </span>
            <span>{{ item.label }}</span>
          </Link>
        </li>
      </ul>

      <!-- Bottom Utilities / Logout -->
      <ul class="pt-4 border-t border-blue-900/50">
        <li>
          <Link 
            href="/logout" 
            method="post" 
            as="button" 
            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-blue-200/70 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200 group font-medium text-sm text-left"
          >
            <span class="text-lg opacity-70 group-hover:opacity-100 transition-transform duration-200 group-hover:-translate-x-0.5">
              🚪
            </span>
            <span>Sign Out</span>
          </Link>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const menuItems = [
  { label: 'Dashboard', route: '/dashboard', icon: '📊' },
  { label: 'Pending Docs', route: '/pending', icon: '⏳' },
  { label: 'Create Request', route: '/create', icon: '📝' },
  { label: 'Incoming Routing', route: '/incoming', icon: '📥' },
  { label: 'Global Search', route: '/search', icon: '🔍' },
];

// Active State Strategy
const page = usePage();
const isActive = (route) => {
  return computed(() => page.url.startsWith(route)).value;
};
</script>