<template>
  <div class="flex">
    <SideBar />
    <main class="flex-1 p-6">
        <div class="p-6 bg-white rounded-lg shadow-md">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
      <p class="text-lg font-semibold text-gray-700">Incoming Request</p>
      <p class="text-4xl font-bold text-gray-900">8</p>
      <p class="text-sm text-gray-500">August</p>
    </div>
    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
      <p class="text-lg font-semibold text-gray-700">Pending / Processing</p>
      <p class="text-4xl font-bold text-gray-900">16</p>
      <p class="text-sm text-gray-500">2025</p>
    </div>
    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
      <p class="text-lg font-semibold text-gray-700">Processed</p>
      <p class="text-4xl font-bold text-gray-900">11</p>
      <p class="text-sm text-gray-500">2025</p>
    </div>
    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
      <p class="text-lg font-semibold text-gray-700">Provide Status</p>
      <p class="text-4xl font-bold text-gray-900">0</p>
      <p class="text-sm text-gray-500">2025</p>
    </div>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Title</h3>
    <div class="relative h-80">
      <div class="flex items-end h-full justify-around pt-8">
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$50,000</span>
          <div class="bg-black w-8 rounded-t h-40"></div>
          <span class="text-xs text-gray-700 mt-2">Jan</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$55,000</span>
          <div class="bg-black w-8 rounded-t h-44"></div>
          <span class="text-xs text-gray-700 mt-2">Feb</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$49,000</span>
          <div class="bg-black w-8 rounded-t h-38"></div>
          <span class="text-xs text-gray-700 mt-2">Mar</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$47,000</span>
          <div class="bg-black w-8 rounded-t h-36"></div>
          <span class="text-xs text-gray-700 mt-2">Apr</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$59,000</span>
          <div class="bg-black w-8 rounded-t h-48"></div>
          <span class="text-xs text-gray-700 mt-2">May</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$78,000</span>
          <div class="bg-black w-8 rounded-t h-64"></div>
          <span class="text-xs text-gray-700 mt-2">Jun</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$60,000</span>
          <div class="bg-black w-8 rounded-t h-49"></div>
          <span class="text-xs text-gray-700 mt-2">Jul</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$68,000</span>
          <div class="bg-black w-8 rounded-t h-56"></div>
          <span class="text-xs text-gray-700 mt-2">Aug</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$55,000</span>
          <div class="bg-black w-8 rounded-t h-44"></div>
          <span class="text-xs text-gray-700 mt-2">Sep</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$50,000</span>
          <div class="bg-black w-8 rounded-t h-40"></div>
          <span class="text-xs text-gray-700 mt-2">Oct</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$47,000</span>
          <div class="bg-black w-8 rounded-t h-36"></div>
          <span class="text-xs text-gray-700 mt-2">Nov</span>
        </div>
        <div class="flex flex-col items-center">
          <span class="text-xs text-gray-500 mb-1">$25,000</span>
          <div class="bg-black w-8 rounded-t h-16"></div>
          <span class="text-xs text-gray-700 mt-2">Dec</span>
        </div>
      </div>
      <div class="absolute left-0 top-0 h-full flex flex-col justify-between py-2 pr-2 text-xs text-gray-500">
        <span>$80,000</span>
        <span>$70,000</span>
        <span>$60,000</span>
        <span>$50,000</span>
        <span>$40,000</span>
        <span>$30,000</span>
      </div>
    </div>
  </div>
</div>
    </main>
  </div>
</template>

<script>

import SideBar from '@/components/SideBar.vue';
export default {

    components: {
        SideBar
    }

}
</script>

<style>

</style>