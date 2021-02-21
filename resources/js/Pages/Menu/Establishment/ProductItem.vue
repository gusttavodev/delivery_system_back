<template>
    <div
        class="bg-gray-100 hover:bg-gray-200 p-2 w-1/1 container flex items-center justify-center cursor-pointer border-b border-gray-300 text-black rounded"
        style=""
    >
        <div class="p-2 w-12">
            <img
                :src="getPhoto(product.photo)"
                alt="img product"
            />
        </div>
        <div class="flex-auto text-sm w-32">
            <div class="font-bold">{{product.name}}</div>

            <div class="truncate" >
                <span v-for="aditional in product.additionals" :key="aditional.id">
                    {{aditional.quantity ? `${aditional.quantity}x ${aditional.name}, ` : ''}}
                </span>
            </div>

            <div>Quantidade: {{product.quantity}}</div>
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
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </div>
            {{`R$ ${product.price}`}}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        product: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {};
    },
    methods: {
        getPhoto(photoPath) {
            const host = window.location.host;
            const photo = `http://${host}/img/cache/thumb/${photoPath}`;

            return photo;
        },
        selectProduct() {}
    }
};
</script>
