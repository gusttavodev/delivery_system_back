<template>
    <!-- <div
        class="
        mx-auto lg:w-3/4 sm:w-3/4 md:w-2/4 fixed inset-x-0 bottom-0
        bg-pink-800 rounded-t-lg text-center text-gray-50 hover:bg-pink-600"
    > -->
    <div
         :class="`bg-gradient-to-r from-${$page.secondary_color}-500 via-${$page.secondary_color}-600 to-${$page.secondary_color}-700`"
        class="
            cursor-pointer  w-3/4 lg:w-3/4 sm:w-2/4 md:w-2/4 fixed inset-x-0 bottom-0
            rounded-t-lg text-center text-gray-50 container flex flex-wrap items-center justify-center pt-2
        "
        style="z-index: 9999999999999999999999999"
        @click="showOrder"
    >
        <h1 class="text-2xl p-2">Seu pedido</h1>

        <div slot="icon" class="relative">
            <div
                class="absolute text-xs rounded-full -mt-1 -mr-2 px-1 font-bold top-0 right-0 bg-green-500 text-white"
            >
                {{ cartCount }}
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="100%"
                height="100%"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-shopping-cart w-6 h-6 mt-2"
            >
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path
                    d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"
                ></path>
            </svg>
        </div>
    </div>
    <!-- </div> -->
</template>

<script>
import Modal from "@/Shared/Modal";

import PrimaryButton from "@/Shared/Establishment/PrimaryButton";

import { GET_CART, CART_COUNT } from "@/store/mutationsTypes/StoreCart";
import { SET_SHOW_ORDER } from "@/store/mutationsTypes/Order";

export default {
    props: {},
    components: {
        PrimaryButton,
        Modal
    },
    computed: {
        storeCart() {
            return this.$store.getters[GET_CART];
        },
        cartCount() {
            return this.$store.getters[CART_COUNT];
        }
    },
    data() {
        return {};
    },
    mounted() {
        console.log("storeCart ", this.storeCart);
    },
    methods: {
        showOrder() {
            console.log("SHOW ORDER");
            this.$store.dispatch(SET_SHOW_ORDER, true)
        }
    }
};
</script>

<style>
.cart-count {
    padding: 0 5px;
}
</style>
