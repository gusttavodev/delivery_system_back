<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Adicional
            </h2>
            <inertia-link :href="route('indexAddition')" >
                <jet-button >
                    Voltar
                </jet-button>
            </inertia-link>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <addition-form />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import AdditionForm from './Form'
    import JetButton from "@/Jetstream/Button";
    import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

    export default {
        components: {
            AppLayout,
            AdditionForm,
            JetButton,
            JetResponsiveNavLink
        },
    }
</script>
