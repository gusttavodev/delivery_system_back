<template>
    <Modal v-if="hasProduct" @close="closeModal">
        <h3 slot="header">{{ selectedProduct.name }}</h3>
        <div slot="body">
            <div
                class="flex flex-col items-center justify-center text-gray-800 work-sans leading-normal text-base"
            >
                <img
                    class="hover:grow hover:shadow-lg rounded h-auto md:max-w-2xl"
                    :src="getPhoto(selectedProduct.photo)"
                />
                <h3 class="text-center pt-2">
                    {{ selectedProduct.description }}
                </h3>

                <div
                    v-for="additional in selectedProduct.additionals"
                    :key="additional.id"
                    class="pt-2 flex flex-row justify-between w-full"
                >
                    <h2 class="p-2 flex-1 text-left">{{ additional.name }}</h2>

                    <vue-number-input
                        v-model="additional.quantity"
                        class="flex-2"
                        @change="event => changeCounter(event, additional)"
                        rounded
                        controls
                        :min="1"
                        :max="additional.quantity_limit"
                        :inputtable="false"
                    />

                    <h2 v-if="additional.quantity" class="p-2 flex-1 text-right">{{ $currency_format(additional.price*additional.quantity) }}</h2>
                    <h2 v-else class="p-2 flex-1 text-right">{{ $currency_format(additional.price) }}</h2>

                </div>
            </div>
        </div>
        <div slot="footer">
            <PrimaryButton
                class="w-full h-full flex justify-center items-center p-3"
            >
                Adicionar ao carrinho
            </PrimaryButton>
        </div>
    </Modal>
</template>

<script>
import Modal from "@/Shared/Modal";
import JetButton from "../../../Jetstream/Button";
import JetSecondaryButton from "../../../Jetstream/SecondaryButton";

import PrimaryButton from "@/Shared/Establishment/PrimaryButton";

import {
    GET_PRODUCT,
    DELETE_PRODUCT,
    HAS_PRODUCT
} from "@/store/mutationsTypes/Product";

export default {
    props: {},
    components: {
        PrimaryButton,
        Modal
    },
    computed: {
        selectedProduct() {
            console.log("MOUNTED", this.$store.getters[GET_PRODUCT]);
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
        getPhoto(photoPath) {
            const host = window.location.host;
            const photo = `http://${host}/img/cache/thumb/${photoPath}`;

            return photo;
        },
        addToCart() {
            console.log(this.product);
            // this.$emit("onSelectProduct", this.product);
        }
    }
};
</script>

<style></style>
