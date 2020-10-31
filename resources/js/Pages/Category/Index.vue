<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Categorias
            </h2>
            <inertia-link :href="route('createCategory')" >
                <jet-button >
                    Criar Categoria
                </jet-button>
            </inertia-link>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <category-list />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CategoryList from "./CategoryList";
import JetButton from "@/Jetstream/Button";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
    components: {
        AppLayout,
        CategoryList,
        JetButton,
        JetResponsiveNavLink
    }
};
</script>
