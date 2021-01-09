<template>
    <div>
        <link
            href="https://unpkg.com/tailwindcss/dist/tailwind.min.css"
            rel="stylesheet"
        />

        <div
            class="bg-white text-white work-sans leading-normal text-base tracking-normal "
        >
            <!--Nav-->
            <nav id="header" class="w-full z-30 top-0 py-1 bg-gradient-to-r from-purple-400 via-pink-500 to-red-500">
                <div
                    class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3"
                >
                    <label
                        for="menu-toggle"
                        class="cursor-pointer md:hidden block"
                    >
                        <svg
                            class="fill-current text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                        >
                            <title>menu</title>
                            <path
                                d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                            ></path>
                        </svg>
                    </label>
                    <input class="hidden" type="checkbox" id="menu-toggle" />

                    <div
                        class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1"
                        id="menu"
                    >
                        <nav>
                            <ul
                                class="md:flex items-center justify-between text-base text-white pt-4 md:pt-0"
                            >
                                <li>
                                    <a
                                        class="inline-block no-underline hover:text-black hover:underline py-2 px-4"
                                        href="#"
                                        >Shop</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="inline-block no-underline hover:text-black hover:underline py-2 px-4"
                                        href="#"
                                        >About</a
                                    >
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="order-1 md:order-2">
                        <a
                            class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-white text-xl "
                            href="#"
                        >
                            <img :src="getPhoto($page.establishment.data.picture)" id="product-card" class="block rounded-full max-h-15 max-w-15"  />

                             {{$page.establishment.data.name}}
                        </a>
                    </div>

                    <div
                        class="order-2 md:order-3 flex items-center"
                        id="nav-content"
                    >
                        <a
                            class="inline-block no-underline hover:text-black"
                            href="#"
                        >
                            <svg
                                class="fill-current hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                            >
                                <circle fill="none" cx="12" cy="7" r="3" />
                                <path
                                    d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z"
                                />
                            </svg>
                        </a>

                        <a
                            class="pl-3 inline-block no-underline hover:text-black"
                            href="#"
                        >
                            <svg
                                class="fill-current hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z"
                                />
                                <circle cx="10.5" cy="18.5" r="1.5" />
                                <circle cx="17.5" cy="18.5" r="1.5" />
                            </svg>
                        </a>
                    </div>
                </div>
            </nav>

            <section
                class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right rounded m-3"
                :style="{'background-image':`url(${getPhoto($page.establishment.data.background_picture)})`}"
                style="max-width:1600px; height: 32rem;"
            >

                   <!-- component -->
            <!-- Collapsible card by Julian Rachele -->
            <div class="shadow-md bg-gray-50 text-black m-2 rounded">
                <div class="flex items-center">
                <img :src="getPhoto($page.establishment.data.picture)" id="product-card" class="w-auto h-20 mr-4"  />

                <div class="description">
                    <p>{{$page.establishment.data.description}}</p>
                </div>

                </div>
                <!-- Collapsed content -->
                <div class="flex flex-col m-4" >
                <hr class="mb-4 border-gray-700">
                <p><span class="text-black">Endereço:</span> {{
                    `${$page.establishment.data.address.street}, Número ${$page.establishment.data.address.number} ${$page.establishment.data.address.complement},
                     ${$page.establishment.data.address.district} - ${$page.establishment.data.address.city} ${$page.establishment.data.address.state}`
                }}</p>
                <p><span class="text-black">Telefone:</span> {{$page.establishment.data.phone}}</p>
                <p><span class="text-black">Tempo Médio:</span> {{$page.establishment.data.delivery_time}}</p>
                <p><span class="text-black">Preço Mínimo:</span> R$ {{$page.establishment.data.min_value}}</p>
                <p><span class="text-black">Horarios de Funcionamento:</span></p>
                <ul class="list-disc ml-4 mt-1">
                    <li v-for="openingHour in $page.establishment.data.opening_hours" :key="openingHour.id" >
                        <div v-if="!openingHour.not_open">
                            <span class="text-black">{{openingHour.label}}</span>
                            {{openingHour.start_time}}
                                <span class="text-black">Até</span>
                            {{openingHour.end_time}}
                        </div>
                         <div v-else>
                             <span class="text-black">{{openingHour.label}}</span> Não Funciona
                        </div>

                    </li>
                </ul>
                </div>
            </div>

            </section>

            <section class="bg-white" v-for="category in $page.categories.data" :key="category.id">
                <div
                    class="container mx-auto flex items-center flex-wrap pt-4 pb-12 border-b border-gray-400"
                >
                    <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                        <div
                            class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3"
                        >
                            <a
                                class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                                href="#"
                            >
                                {{category.name}}
                            </a>

                        </div>
                    </nav>

                    <ProductCard
                        class="shadow-xl rounded bg-gray-50"
                        v-for="product in category.products"
                        :key="product.id"
                        :name="product.name"
                        :photo="getPhoto(product.photo)"
                        :id="product.id"
                        :price="product.price"
                    />
                </div>
            </section>

            <footer
                class="container mx-auto bg-white py-8 bg-gradient-to-r from-purple-400 via-pink-500 to-red-500"
            >
                <div class="container flex px-3 py-8 ">
                    <div class="w-full mx-auto flex flex-wrap">
                        <div class="flex w-full lg:w-1/2 ">
                            <div class="px-3 md:px-0">
                                <h3 class="font-bold text-gray-900">About</h3>
                                <p class="py-4">
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Maecenas vel mi ut felis
                                    tempus commodo nec id erat. Suspendisse
                                    consectetur dapibus velit ut lacinia.
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex w-full lg:w-1/2 lg:justify-end lg:text-right"
                        >
                            <div class="px-3 md:px-0">
                                <h3 class="font-bold text-gray-900">Social</h3>
                                <ul class="list-reset items-center pt-3">
                                    <li>
                                        <a
                                            class="inline-block no-underline hover:text-black hover:underline py-1"
                                            href="#"
                                            >Add social links</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<script>
import ProductCard from "./ProductCard";
export default {
    props: ["errors"],
    components: {
        ProductCard
    },
    data() {
        return {
            establishment: null
        };
    },
    methods: {
        getPhoto(photoPath) {
            const host = window.location.host;
            const photo = `http://${host}/storage/${photoPath}`;

            return photo;
        },
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
