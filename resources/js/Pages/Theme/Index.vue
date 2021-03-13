<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Temas
            </h2>
            <inertia-link :href="route('createTheme')" >
                <jet-button >
                    Criar Tema
                </jet-button>
            </inertia-link>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <theme-list />
                </div>
            </div>
        </div>
    </app-layout>


</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ThemeList from "./ThemeList";
import JetButton from "@/Jetstream/Button";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
    components: {
        AppLayout,
        ThemeList,
        JetButton,
        JetResponsiveNavLink
    }
};
</script>
