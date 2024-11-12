<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';



const props = defineProps({
    products: {
        type: Object
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const quantities = ref({});
const prices = ref({});
const categories = ref({});
const showModal = ref(false);

props.products.data.forEach(product => {
    quantities.value[product.id] = 1;
    prices.value[product.id] = product.price;
    categories.value[product.id] = product.category?.id || null;
});

const submitForm = (productId, quantity, price, category) => {
    const form = useForm({ quantity, price, category_id: category });

    form.post(route('cart.store', { product: productId }), {
        onSuccess: () => {
            showModal.value = true;
        }
    });
};

const closeModal = () => {
    showModal.value = false;
};

</script>

<template>
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                    </Link>
                    <Link v-if="$page.props.auth.user" :href="route('cart.index')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Cart
                    </Link>

                    <template v-else>
                        <Link :href="route('login')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                        </Link>

                        <Link v-if="canRegister" :href="route('register')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                        </Link>
                    </template>
                </nav>
            </header>
        </div>
        <div class="max-w-4xl mx-auto p-6 bg-gray-50">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-700">Products</h1>
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <li v-for="product in products.data" :key="product.id"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                    <form
                        @submit.prevent="submitForm(product.id, quantities[product.id], prices[product.id], categories[product.id])"
                        class="flex flex-col space-y-4">
                        <div class="text-lg font-semibold text-gray-800">
                            <span class="block text-xl font-bold">{{ product.name }}</span>
                            <span class="text-gray-500">${{ product.price }}</span>
                            <span v-if="product.category" class="text-sm block text-gray-400">{{ product.category.name
                                }}</span>
                            <span class="text-sm block text-gray-400">Available: {{ product.quantity
                                }}</span>
                        </div>

                        <input type="number" v-model="quantities[product.id]" min="1" :max="product.quantity"
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />

                        <button type="submit"
                            class="bg-indigo-600 text-white rounded-lg px-4 py-2 font-semibold hover:bg-indigo-700 transition-colors duration-200">
                            Add to Cart
                        </button>
                    </form>
                </li>
            </ul>

            <!-- Modal -->
            <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white w-11/12 max-w-md p-6 rounded-lg shadow-lg text-center">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">Product added to cart!</h2>
                    <p class="text-gray-600 mb-6">You have successfully added this product to your cart.</p>
                    <div class="flex space-x-4 justify-center">
                        <!-- Button to go to the cart -->
                        <Link :href="route('cart.index')"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors duration-200">
                        Go to Cart
                        </Link>
                        <!-- Button to close modal and return to shop -->
                        <button @click="closeModal"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-400 transition-colors duration-200">
                            Continue Shopping
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
