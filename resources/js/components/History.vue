<!-- <template>
    <div class="flex h-auto max-w-sm mx-auto bg-gray-100 shadow-xl rounded-xl">

        <main class="flex-grow p-8 overflow-y-auto">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Request History</h1>
            <div class="bg-white p-6 shadow-md rounded-lg mt-4">
                <p class="text-gray-600">
                    This is the primary area for the application content. It will stretch to fill
                    all horizontal space next to the History Panel.
                </p>
            </div>
            <div class="bg-white p-6 shadow-md rounded-lg mt-4">
                <slot />
            </div>
        </main>
    </div>
</template>

<script>
export default {
}
</script>

<style></style> -->
<!-- 
<template>
    <div v-if="isOpen" class="flex h-auto max-w-sm mx-auto bg-gray-100 shadow-xl rounded-xl relative">
        <button @click="closeHistory" class="absolute top-2 right-2 p-2 rounded-full text-gray-500 hover:text-gray-800 hover:bg-gray-200 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <main class="flex-grow p-8 overflow-y-auto">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Request History</h1>
            <div class="bg-white p-6 shadow-md rounded-lg mt-4">
                <p class="text-gray-600">
                    This is the primary area for the application content. It will stretch to fill
                    all horizontal space next to the History Panel.
                </p>
            </div>
            <div class="bg-white p-6 shadow-md rounded-lg mt-4">
                <slot />
            </div>
        </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // Controls the visibility of the entire component
            isOpen: true, 
        };
    },
    methods: {
        // Sets isOpen to false to hide the component
        closeHistory() {
            this.isOpen = false;
            // Optionally emit an event to notify the parent component that the history is closed
            // this.$emit('closed');
        },
    },
};
</script>

<style></style> -->

<template>
    <div v-if="isOpen" class="flex h-auto max-w-sm mx-auto bg-gray-100 shadow-xl rounded-xl relative">
        
        <button @click="closeHistory" class="absolute top-2 right-2 p-2 rounded-full text-gray-500 hover:text-gray-800 hover:bg-gray-200 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <main class="flex-grow p-8 overflow-y-auto">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Request History</h1>
            <div class="bg-white p-6 shadow-md rounded-lg mt-4">
                <p class="text-gray-600">
                    This is the primary area for the application content. It will stretch to fill
                    all horizontal space next to the History Panel.
                </p>
            </div>
            <div class="bg-white p-6 shadow-md rounded-lg mt-4">
                <slot />
            </div>
        </main>
    </div>
</template>

<script>
export default {
    // Allows the component to be controlled externally via template reference
    // and exposes the openHistory method
    expose: ['openHistory'],
    data() {
        return {
            // Set to false so the history starts closed
            isOpen: false, 
        };
    },
    methods: {
        // Method to open the history panel
        openHistory() {
            this.isOpen = true;
        },
        // Method to close the history panel
        closeHistory() {
            this.isOpen = false;
        },
    },
};
</script>

<style></style>