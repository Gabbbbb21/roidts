<template>
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

<style></style>