<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    cartItems: {
        type: Object
    }
})

console.log(props.cartItems);

</script>

<template>
    <div>
        <ul>
            <li v-for="cartItem in cartItems" :key="cartItem.id" class="mb-4">
            Product:
            {{  cartItem.id }}
            </li>
        </ul>
    </div>
</template>