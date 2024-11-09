<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    products: Object
});

const quantities = ref({});
const prices = ref({});
const categories = ref({});

props.products.data.forEach(product => {
    quantities.value[product.id] = 1;
    prices.value[product.id] = product.price;
    categories.value[product.id] = product.category?.id || null;
});

const submitForm = (productId, quantity, price, category) => {
    const form = useForm({ quantity, price, category_id: category });

    form.post(route('carts.store', { product: productId }));
};
</script>

<template>
    <div>
        <h1>Products</h1>
        <ul>
            <li v-for="product in products.data" :key="product.id" class="mb-4">
                <form
                    @submit.prevent="submitForm(product.id, quantities[product.id], prices[product.id], categories[product.id])">
                    <div>
                        <span class="font-bold">{{ product.name }}</span> - ${{ product.price }}
                        <span v-if="product.category">{{ product.category.name }}</span>
                    </div>

                    <input type="number" v-model="quantities[product.id]" min="1" :max="product.quantity" />

                    <button type="submit">
                        Add to Cart
                    </button>
                </form>
            </li>
        </ul>
    </div>
</template>
