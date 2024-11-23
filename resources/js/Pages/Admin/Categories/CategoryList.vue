<script setup>


const props = defineProps({
    categories: {
        type: Object
    }
})


props.categories.forEach(product => {
    console.log(product)
});
</script>

<template>
    <h1 class="text-2xl font-bold mb-6">categories</h1>
    <div class="lg:col-span-3">
        <ul class="space-y-4">
            <!-- Iteracja przez produkty -->
            <li v-for="category in categories" :key="category.id"
                class="flex items-center justify-between p-4 border rounded-lg shadow-sm hover:shadow-md">
                <!-- Informacje o produkcie -->
                <div class="flex items-center space-x-4 flex-1">
                    <!-- Szczegóły produktu -->
                    <div class="flex flex-col">
                        <!-- Nazwa -->
                        <span class="font-semibold text-lg">
                            {{ category.name }}
                        </span>
                    </div>
                </div>
                <!-- Przyciski akcji -->
                <div class="flex space-x-4">
                    <button
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                        Show
                    </button>
                    <button
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Edit
                    </button>
                    <button
                        class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition duration-200">
                        Delete
                    </button>
                </div>
            </li>
        </ul>
    </div>
</template>


<style scoped>
/* Opcjonalne style */
</style>
