<template>
        <div
            class="w-full md:w-1/3 xl:w-1/4 m-3 flex flex-col M-10"
            @click="selectProduct"
        >
            <img
                class="hover:grow hover:shadow-lg rounded block h-auto w-full"
                :src="getPhoto(product.photo)"
            />
            <div class="pt-3 flex items-center justify-between">
                <p class="text-black">{{ product.name }}</p>
            </div>
            <p class="pt-1 text-gray-900">R$ {{ product.price }}</p>
        </div>
</template>

<script>
import ProductModal from './ProductModal'
import { SET_PRODUCT, GET_PRODUCT } from "@/store/mutationsTypes/Product";

export default {
    components: {
        ProductModal
    },
    props: {
        product: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {
            showModal: true,
        }
    },
    methods: {
        getPhoto(photoPath) {
            const host = window.location.host;
            const photo = `http://${host}/img/cache/thumb/${photoPath}`;

            return photo;
        },
        selectProduct() {
            this.showModal = true
            this.$store.dispatch(SET_PRODUCT, this.product)
        }
    }
};
</script>

<style>
.worksans {
    font-family: "Work Sans", sans-serif;
}

#menu-toggle:checked + #menu {
    display: block;
}

.hover\:grow {
    transition: all 0.3s;
    transform: scale(1);
}

.hover\:grow:hover {
    transform: scale(1.02);
}

.carousel-open:checked + .carousel-item {
    position: static;
    opacity: 100;
}

.carousel-item {
    -webkit-transition: opacity 0.6s ease-out;
    transition: opacity 0.6s ease-out;
}

#carousel-1:checked ~ .control-1,
#carousel-2:checked ~ .control-2,
#carousel-3:checked ~ .control-3 {
    display: block;
}

.carousel-indicators {
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    bottom: 2%;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 10;
}

#carousel-1:checked
    ~ .control-1
    ~ .carousel-indicators
    li:nth-child(1)
    .carousel-bullet,
#carousel-2:checked
    ~ .control-2
    ~ .carousel-indicators
    li:nth-child(2)
    .carousel-bullet,
#carousel-3:checked
    ~ .control-3
    ~ .carousel-indicators
    li:nth-child(3)
    .carousel-bullet {
    color: #000;
    /*Set to match the Tailwind colour you want the active one to be */
}
</style>
