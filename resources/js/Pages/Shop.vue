<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import ProductCard from '@/Components/ProductCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    products: Object,
    canLogin: Boolean,
    canRegister: Boolean,
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

const openModal = () => {
    showModal.value = true;
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
                <ProductCard v-for="product in products.data" :key="product.id" :product="product"
                    :quantities="quantities" :prices="prices" :categories="categories" :onAddToCart="openModal" />
            </ul>

            <!-- Modal -->
            <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white w-11/12 max-w-md p-6 rounded-lg shadow-lg text-center">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">Product added to cart!</h2>
                    <p class="text-gray-600 mb-6">You have successfully added this product to your cart.</p>
                    <div class="flex space-x-4 justify-center">
                        <Link :href="route('cart.index')"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors duration-200">
                        Go to Cart
                        </Link>
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
