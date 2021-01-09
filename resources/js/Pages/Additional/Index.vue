<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Adicionais
            </h2>
            <inertia-link :href="route('createAddition')" >
                <jet-button >
                    Criar Adicional
                </jet-button>
            </inertia-link>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <addition-list />
                </div>
            </div>
        </div>
    </app-layout>


</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import AdditionList from "./List";
import JetButton from "@/Jetstream/Button";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
    components: {
        AppLayout,
        AdditionList,
        JetButton,
        JetResponsiveNavLink
    }
};
</script>
