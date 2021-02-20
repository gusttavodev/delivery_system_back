<template>
    <Modal v-if="showOrder" @close="closeModal">
        <h3 slot="header" class="text-2xl">Confirme sua compra</h3>
        <div slot="body">

                    <div
                        class="bg-gray-100 hover:bg-gray-200 p-2 w-1/1 container flex items-center justify-center cursor-pointer border-b border-gray-300 text-black rounded"
                        style=""
                    >
                    <div class="p-2 w-12"><img src="https://dummyimage.com/50x50/bababa/0011ff&amp;text=50x50" alt="img product"></div>
                        <div class="flex-auto text-sm w-32">
                            <div class="font-bold">Açai teste 1</div>
                            <div class="truncate">1 Nutella, 3 Granola, 2 Banana</div>
                            <div >Quantidade: 2</div>
                        </div>
                        <div class="flex flex-col w-18 font-medium items-end">
                            <div
                                class="w-4 h-4 mb-6 hover:bg-red-200 rounded-full cursor-pointer text-red-700"
                            >
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
                                    class="feather feather-trash-2 "
                                >
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                    ></path>
                                    <line
                                        x1="10"
                                        y1="11"
                                        x2="10"
                                        y2="17"
                                    ></line>
                                    <line
                                        x1="14"
                                        y1="11"
                                        x2="14"
                                        y2="17"
                                    ></line>
                                </svg>
                            </div>
                            $12.22
                        </div>
                    </div>


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
        Modal
    },
    computed: {
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
        getPhoto(photoPath) {
            const host = window.location.host;
            const photo = `http://${host}/img/cache/thumb/${photoPath}`;

            return photo;
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
