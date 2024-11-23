<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
    quantities: Object,
    prices: Object,
    categories: Object,
    onAddToCart: Function,
});

console.log(props.product)
const quantity = ref(props.quantities[props.product.id]);

const submitForm = () => {
    const form = useForm({
        quantity: quantity.value,
        price: props.prices[props.product.id],
        category_id: props.categories[props.product.id],
    });

    form.post(route('cart.store', { product: props.product.id }), {
        onSuccess: () => props.onAddToCart(),
    });
};
</script>

<template>
    <li class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
        <form @submit.prevent="submitForm" class="flex flex-col space-y-4">
            <div class="text-lg font-semibold text-gray-800">
                <img :src="'../storage/' + product.image_path" alt="">
                <span class="block text-xl font-bold">{{ product.name }}</span>
                <span class="text-gray-500">{{ product.price }} PLN</span>
                <span v-if="product.category" class="text-sm block text-gray-400">{{ product.category.name }}</span>
                <span class="text-sm block text-gray-400">Available: {{ product.quantity }}</span>
            </div>

            <input type="number" v-model="quantity" min="1" :max="product.quantity"
                class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />

            <button type="submit"
                class="bg-indigo-600 text-white rounded-lg px-4 py-2 font-semibold hover:bg-indigo-700 transition-colors duration-200">
                Add to Cart
            </button>
        </form>
    </li>
</template>
