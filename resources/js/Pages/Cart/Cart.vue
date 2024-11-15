<script setup>
import { Link, useForm, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    cartItems: {
        type: Object,
    },
    canLogin: {
        type: Boolean,
    },
});

const formQuantity = useForm({
    quantity: 1,
});

const formSelectedProducts = useForm({
    cartItems: [],
})

const updateQuantity = (item) => {
    if (item.quantity >= 1 && item.quantity <= item.product.quantity) {
        formQuantity.quantity = item.quantity;
    } else {
        formQuantity.quantity = item.product.quantity;
    }
    formQuantity.put(route('cart.update', { cart: item.id }), {
        onSuccess: () => console.log("Quantity updated successfully"),
        onError: (errors) => console.error(errors)
    });
};

// Funkcje zarządzania ilością przez przyciski
const increaseQuantity = (item) => {
    if (item.quantity < item.product.quantity) item.quantity += 1;
    updateQuantity(item);
};

const decreaseQuantity = (item) => {
    if (item.quantity > 1) item.quantity -= 1;
    updateQuantity(item);
};

const deleteItem = (item) => {
    if (confirm('Are you sure you want to delete this product from your cart?')) {
        router.delete(route('cart.destroy', { cart: item.id }), {
            onSuccess: () => {
                console.log("Item deleted successfully");
            },
            onError: (errors) => {
                console.error(errors);
            }
        });
    }
};

const cartSubtotal = computed(() => {
    const total = props.cartItems
        .filter(item => item.selected)
        .reduce((sum, item) => sum + item.product.price * item.quantity, 0);

    return total.toFixed(2);
});
const submitSelectedItems = () => {

    const selectedItems = props.cartItems.filter(item => item.selected);

    formSelectedProducts.cartItems = selectedItems;

    if (formSelectedProducts.cartItems.length > 0) {
        formSelectedProducts.post(route('order.store'));
    } else {
        console.error('No item selected');
    }
}



</script>

<template>
    <div class="relative w-full max-w-7xl px-6 mx-auto">
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
                </Link>
                <Link v-if="$page.props.auth.user" :href="route('shop.index')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Shop
                </Link>
            </nav>
        </header>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Lista produktów -->
            <div class="lg:col-span-3">
                <ul class="space-y-4">
                    <li v-for="item in cartItems" :key="item.id"
                        class="flex items-center justify-between p-4 border rounded-lg shadow-sm hover:shadow-md">

                        <!-- Checkbox -->
                        <div>
                            <input type="checkbox" v-model="item.selected"
                                class="form-checkbox h-5 w-5 text-indigo-600" />
                        </div>

                        <!-- Product -->
                        <div class="flex items-center space-x-4 flex-1">
                            <div class="flex flex-col">
                                <span class="font-semibold text-lg">
                                    {{ item.product.name }}
                                </span>
                            </div>

                            <!-- Price -->
                            <div class="text-lg font-semibold text-green-600">
                                {{ item.product.price }} PLN
                            </div>

                            <!-- Quantity -->
                            <form @submit.prevent="updateQuantity(item)">
                                <div class="flex items-center space-x-2">
                                    <button type="button" @click="decreaseQuantity(item)"
                                        class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full">-</button>
                                    <input type="number" v-model.number="item.quantity" :min="1"
                                        :max="item.product.quantity" required class="w-16 text-center border rounded-lg"
                                        @change="updateQuantity(item)" />
                                    <button type="button" @click="increaseQuantity(item)"
                                        class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full">+</button>
                                </div>
                            </form>

                            <!-- Total value -->
                            <div class="text-lg font-semibold text-blue-600">
                                {{ item.value }} PLN
                            </div>
                        </div>

                        <!-- Show and Delete -->
                        <div class="flex space-x-4">
                            <Link :href="'#'"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors duration-200">
                            Show
                            </Link>
                            <button @click="deleteItem(item)"
                                class="text-red-600 hover:text-red-800 text-sm font-semibold">
                                Delete
                            </button>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Podsumowanie koszyka -->
            <div class="lg:col-span-1 p-4 border rounded-lg shadow-sm space-y-4">
                <div class="text-lg font-semibold">Cart Summary</div>
                <div class="flex justify-between">
                    <span>Subtotal:</span>
                    <span>{{ cartSubtotal }} PLN</span>
                </div>
                <button
                    class="block bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold text-center hover:bg-indigo-700 transition-colors duration-200"
                    @click="submitSelectedItems">
                    Proceed to checkout
                </button>
                <Link :href="route('shop.index')"
                    class="block text-center text-blue-600 font-semibold hover:text-blue-800">
                Continue shopping
                </Link>
            </div>
        </div>
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
