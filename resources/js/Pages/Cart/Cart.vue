<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    cartItems: {
        type: Object,
    }
})

props.cartItems.forEach(item => {
    console.log(item.product.name);
});

</script>

<template>
    <div class="container mx-auto p-6">
        <ul class="space-y-4">
            <li v-for="item in cartItems" :key="item.id"
                class="flex items-center justify-between p-4 border rounded-lg shadow-sm hover:shadow-md">

                <!-- Produkt -->
                <div class="flex items-center space-x-4">
                    <div class="flex flex-col">
                        <span class="font-semibold text-lg">
                            {{ item.product.name }}
                        </span>
                    </div>

                    <!-- Cena -->
                    <div class="text-lg font-semibold text-green-600">
                        {{ item.product.price }} PLN
                    </div>

                    <!-- Liczba -->
                    <div class="flex items-center space-x-2">
                        <button class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full" disabled>-</button>

                        <input type="number" min="1" class="w-16 text-center border rounded-lg" :value="item.quantity"
                            readonly />

                        <button class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full" disabled>+</button>
                    </div>

                    <!-- Łączna wartość -->
                    <div class="text-lg font-semibold text-blue-600">
                        {{ item.value }} PLN
                    </div>
                </div>

                <!-- Przycisk usunięcia -->
                <div>
                    <Link :href="'#'" class="text-red-600 hover:text-red-800 text-sm font-semibold">
                    Usuń
                    </Link>
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.container {
    max-width: 1200px;
}

button {
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #e2e8f0;
}

input[type="number"] {
    width: 50px;
    padding: 0.5rem;
    text-align: center;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 0.375rem;
}

input[type="number"]:focus {
    outline: none;
    border-color: #3182ce;
}
</style>
