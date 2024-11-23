<script setup>
import { useForm } from '@inertiajs/vue3';


const props = defineProps({
    product: Object,
    categories: Object
});

console.log(props.product);

const form = useForm({
    // 
})


</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Edytuj produkt</h1>

        <!-- Formularz edycji produktu -->
        <form @submit.prevent="submitForm">
            <!-- Nazwa produktu -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Nazwa produktu</label>
                <input type="text" id="name" v-model="form.name"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200"
                    :placeholder="product.name" required>
            </div>

            <!-- Opis produktu -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Opis produktu</label>
                <textarea id="description" v-model="form.description"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200"
                    :placeholder="product.description" rows="4" required></textarea>
            </div>

            <!-- Grafika produktu -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium">Grafika produktu</label>
                <input type="file" id="image" @change="handleFileUpload"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200">
                <p class="text-sm text-gray-500 mt-1">Pozostaw puste, jeśli nie chcesz zmieniać grafiki.</p>
            </div>

            <!-- Kategoria -->
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-medium">Kategoria</label>
                <select id="category" v-model="form.category"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200" required>
                    <option value="" disabled>Wybierz kategorię</option>
                    <option v-if="product.category">{{ product.category.name }}</option>
                    <option v-for="option in categories" :key="option.id" :value="option.id">
                        {{ option.name }}
                    </option>
                    <option value="">none</option>
                </select>
            </div>

            <!-- Cena -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium">Cena (PLN)</label>
                <input type="number" id="price" v-model.number="form.price"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200"
                    :placeholder="product.price" min="0" step="0.01" required>
            </div>

            <!-- Ilość -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-medium">Ilość</label>
                <input type="number" id="quantity" v-model.number="form.quantity"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200"
                    :placeholder="product.quantity" min="1" required>
            </div>

            <!-- Przycisk zapisu -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                    Zapisz zmiany
                </button>
            </div>
        </form>
    </div>
</template>