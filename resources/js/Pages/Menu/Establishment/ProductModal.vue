<template>
    <Modal v-if="hasProduct" @close="closeModal">
        <h3 slot="header" class="text-xl font-bold text-title-color">{{ selectedProduct.name }}</h3>
        <div slot="body">
            <div
                class="flex flex-col items-center justify-center text-gray-800 work-sans leading-normal"
            >

                    <img
                        class="flex-1 md:max-w-2xl xl:max-w-2xl m-0 hover:grow rounded"
                        :src="selectedProduct.photo"
                    />


                <h3 class="text-center pt-2 text-xl lt:text-base">
                    {{ selectedProduct.description }}
                </h3>

                 <div class="pt-2 flex flex-row justify-center w-full p-2">
                   <h2 class="p-2 flex-1 text-left text-base lt:text-sm">Quantidade:</h2>

                    <vue-number-input
                        v-model="selectedProduct.quantity"
                        class="flex-2 mb-2"
                        rounded
                        controls
                        :min="1"
                        :max="5"
                        :inputtable="false"
                    />

                    <h2 v-if="selectedProduct.quantity" class="p-2 flex-1 text-right text-base lt:text-sm">{{ $currency_format(selectedProduct.price*selectedProduct.quantity) }}</h2>
                    <h2 v-else class="p-2 flex-1 text-right text-base lt:text-sm">{{ $currency_format(selectedProduct.price) }}</h2>
                </div>

                <h1 class="text-xl text-center pt-2">
                    Acréssimos
                </h1>

                <div
                    v-for="additional in selectedProduct.additionals"
                    :key="additional.id"
                    class="pt-2 flex flex-row justify-between w-full"
                >
                    <h2 class="p-2 flex-1 text-left text-base lt:text-sm">{{ additional.name }}</h2>

                    <vue-number-input
                        v-model="additional.quantity"
                        class="flex-2 mb-2"
                        @change="event => changeCounter(event, additional)"
                        rounded
                        controls
                        :min="0"
                        :max="additional.quantity_limit"
                        :inputtable="false"
                    />

                    <h2 v-if="additional.quantity" class="p-2 flex-1 text-right  lt:text-sm">{{ $currency_format(additional.price*additional.quantity) }}</h2>
                    <h2 v-else class="p-2 flex-1 text-right text-base lt:text-sm">{{ $currency_format(additional.price) }}</h2>

                </div>
            </div>
        </div>
        <div slot="footer">
            <PrimaryButton
                @click.native="addToCart"
                class="w-full h-full flex justify-center items-center p-3"
            >
                Adicionar ao carrinho
            </PrimaryButton>
        </div>
    </Modal>
</template>

<script>
import Modal from "@/Shared/Modal";

import PrimaryButton from "@/Shared/Establishment/PrimaryButton";

import {
    GET_PRODUCT,
    DELETE_PRODUCT,
    HAS_PRODUCT
} from "@/store/mutationsTypes/Product";

import { GET_CART, ADD_ITEM, REMOVE_ITEM } from "@/store/mutationsTypes/StoreCart";

export default {
    props: {},
    components: {
        PrimaryButton,
        Modal
    },
    computed: {
        selectedProduct() {
            return this.$store.getters[GET_PRODUCT];
        },
        hasProduct() {
            return this.$store.getters[HAS_PRODUCT];
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
            this.selectedAdditionals = [];
            this.$store.dispatch(DELETE_PRODUCT);
        },
        addToCart() {
            this.$store.dispatch(ADD_ITEM, this.selectedProduct)
            this.closeModal()
        }
    }
};
</script>

<style></style>
