<template>
    <Modal v-if="showOrder" @close="closeModal">
        <h3 slot="header" class="text-2xl">Confirme sua compra</h3>
        <div slot="body">
            <ProductItem
                v-for="product in storeCart"
                :key="product.id"
                :product="product"
            />
        </div>

        <div slot="footer">
            <PrimaryButton
                @click.native="addToCart"
                class="w-full h-full flex justify-center items-center p-3"
            >
                Comprar $36.66
            </PrimaryButton>
        </div>
    </Modal>
</template>

<script>
import Modal from "@/Shared/Modal";

import PrimaryButton from "@/Shared/Establishment/PrimaryButton";

import ProductItem from "@/Pages/Menu/Establishment/ProductItem";

import {
    GET_PRODUCT,
    DELETE_PRODUCT,
    HAS_PRODUCT
} from "@/store/mutationsTypes/Product";

import {
    GET_CART,
    ADD_ITEM,
    REMOVE_ITEM
} from "@/store/mutationsTypes/StoreCart";
import { GET_SHOW_ORDER, SET_SHOW_ORDER } from "@/store/mutationsTypes/Order";

export default {
    props: {},
    components: {
        PrimaryButton,
        Modal,
        ProductItem
    },
    computed: {
        storeCart() {
            return this.$store.getters[GET_CART];
        },
        selectedProduct() {
            return this.$store.getters[GET_PRODUCT];
        },
        showOrder() {
            return this.$store.getters[GET_SHOW_ORDER];
        }
    },
    data() {
        return {
            selectedAdditionals: []
        };
    },
    methods: {
        changeCounter(event, additional) {
            const indexFound = this.selectedAdditionals.findIndex(
                object => object.id === object.id
            );

            if (indexFound === -1) {
                this.selectedAdditionals.push(additional);
                return;
            }

            this.selectedAdditionals[indexFound] = additional;
        },
        closeModal() {
            this.$store.dispatch(SET_SHOW_ORDER, false);
        },
        addToCart() {
            this.$store.dispatch(ADD_ITEM, this.selectedProduct);
            this.closeModal();
        }
    }
};
</script>
<style>
#journal-scroll::-webkit-scrollbar {
    width: 4px;
    cursor: pointer;
    /*background-color: rgba(229, 231, 235, var(--bg-opacity));*/
}
#journal-scroll::-webkit-scrollbar-track {
    background-color: rgba(229, 231, 235, var(--bg-opacity));
    cursor: pointer;
    /*background: red;*/
}
#journal-scroll::-webkit-scrollbar-thumb {
    cursor: pointer;
    background-color: #a0aec0;
    /*outline: 1px solid slategrey;*/
}
</style>
