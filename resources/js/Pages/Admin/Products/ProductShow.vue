<script setup>

const props = defineProps({
    product: Object
})

console.log(props.product);

</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Szczegóły produktu</h1>

        <!-- Szczegóły produktu -->
        <div class="space-y-4">
            <!-- Nazwa produktu -->
            <div>
                <h2 class="text-lg font-medium text-gray-700">Nazwa:</h2>
                <p class="text-gray-900">{{ product.name }}</p>
            </div>

            <!-- Opis produktu -->
            <div>
                <h2 class="text-lg font-medium text-gray-700">Opis:</h2>
                <p class="text-gray-900">{{ product.description }}</p>
            </div>

            <!-- Grafika produktu -->
            <div>
                <h2 class="text-lg font-medium text-gray-700">Grafika:</h2>
                <img :src="'../storage/' + product.image_path" alt="Product image"
                    class="w-64 h-64 object-cover rounded-lg">
            </div>

            <!-- Kategoria -->
            <div>
                <h2 class="text-lg font-medium text-gray-700">Kategoria:</h2>
                <p class="text-gray-900">{{ product.category }}</p>
            </div>

            <!-- Cena -->
            <div>
                <h2 class="text-lg font-medium text-gray-700">Cena:</h2>
                <p class="text-green-600 font-semibold">{{ product.price }} PLN</p>
            </div>

            <!-- Ilość -->
            <div>
                <h2 class="text-lg font-medium text-gray-700">Ilość:</h2>
                <p class="text-gray-900">{{ product.quantity }}</p>
            </div>
        </div>

        <!-- Przycisk powrotu -->
        <div class="mt-6">
            <button @click="$inertia.get(route('products.index'))"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                Wróć do listy produktów
            </button>
        </div>
    </div>
</template>