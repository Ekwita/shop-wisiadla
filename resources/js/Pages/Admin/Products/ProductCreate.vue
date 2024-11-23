<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    categories: Object
});

console.log(props.categories);

const previewImage = ref(null);
// Inicjalizacja formularza
const form = useForm({
    name: '',
    description: '',
    category_id: '',
    price: 0,
    quantity: 1,
    image: null,
});



// Obsługa wysyłania formularza
const submitForm = () => {
    form.post(route('products.store'));
    console.log(form);
};

// Obsługa wgrywania pliku
const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        previewImage.value = URL.createObjectURL(file); // Generowanie URL dla podglądu
    }
};
</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Dodaj nowy produkt</h1>

        <!-- Formularz dodawania produktu -->
        <form @submit.prevent="submitForm">
            <!-- Nazwa produktu -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Nazwa produktu</label>
                <input type="text" id="name" v-model="form.name"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200"
                    placeholder="Wprowadź nazwę produktu" required>
            </div>

            <!-- Opis produktu -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Opis produktu</label>
                <textarea id="description" v-model="form.description"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200"
                    placeholder="Wprowadź opis produktu" rows="4" required></textarea>
            </div>

            <!-- Grafika produktu -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium">Grafika produktu</label>
                <input type="file" id="image" @change="handleFileUpload"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200" accept="image/*"
                    required>
                <!-- Podgląd obrazu -->
                <div v-if="previewImage" class="mt-4">
                    <img :src="previewImage" alt="Podgląd grafiki" class="w-64 h-64 object-cover rounded-lg">
                </div>
            </div>

            <!-- Kategoria -->
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-medium">Kategoria</label>
                <select id="category" v-model="form.category_id"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200">
                    <option value="" disabled>Wybierz kategorię</option>
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
                    placeholder="Wprowadź cenę" min="0" step="0.01" required>
            </div>

            <!-- Ilość -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-medium">Ilość</label>
                <input type="number" id="quantity" v-model.number="form.quantity"
                    class="w-full border rounded-lg p-2 mt-2 focus:ring focus:ring-indigo-200"
                    placeholder="Wprowadź ilość" min="1" required>
            </div>

            <!-- Przycisk dodawania -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                    Dodaj produkt
                </button>
            </div>
        </form>
    </div>
</template>
