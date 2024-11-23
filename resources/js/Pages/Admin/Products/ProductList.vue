<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    products: {
        type: Object
    }
})

const createProduct = () => {
    router.get(route('products.create'));
}

const showProduct = (product) => {
    router.get(route('products.show', { product }));
}

const editProduct = (product) => {
    router.get(route('products.edit', { product }));
}

const deleteProduct = (product) => {
    router.delete(route('products.destroy', { product }));
}

</script>

<template>

    <Head title="Products list" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products list
            </h2>




        </template>
        <div class="lg:col-span-3 mx-5 my-3">
            <div class="mb-6 flex justify-between items-center">
                <button @click="createProduct"
                    class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-200 shadow-md">
                    + Create Product
                </button>
            </div>
            <ul class="space-y-4">
                <!-- Iteracja przez produkty -->
                <li v-for="product in products" :key="product.id"
                    class="flex items-center justify-between p-4 border rounded-lg shadow-sm hover:shadow-md">
                    <!-- Informacje o produkcie -->
                    <div class="flex items-center space-x-4 flex-1">
                        <!-- Grafika produktu -->
                        <img :src="'../storage/' + product.image_path" alt="Product image"
                            class="w-16 h-16 object-cover rounded-lg">

                        <div class="flex flex-col">
                            <span class="font-semibold text-lg">
                                {{ product.name }}
                            </span>
                            <span class="text-gray-500 text-sm">
                                {{ product.category }}
                            </span>
                            <span class="text-gray-500 text-sm">
                                {{ product.quantity }}
                            </span>
                        </div>

                        <div class="text-lg font-semibold text-green-600">
                            {{ product.price }} PLN
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button @click="showProduct(product)"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                            Show
                        </button>
                        <button @click="editProduct(product)"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                            Edit
                        </button>
                        <button @click="deleteProduct(product)"
                            class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition duration-200">
                            Delete
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>