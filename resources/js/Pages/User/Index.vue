<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Usuarios
            </h2>
            <inertia-link :href="route('createUser')" >
                <jet-button >
                    Criar Usuario
                </jet-button>
            </inertia-link>
            <inertia-link :href="route('createRole')" >
            <jet-button >
                    Criar Função
                </jet-button>
            </inertia-link>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <user-list />
                </div>
            </div>
        </div>
    </app-layout>


</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UserList from "./UserList";
import JetButton from "@/Jetstream/Button";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
    components: {
        AppLayout,
        UserList,
        JetButton,
        JetResponsiveNavLink
    }
};
</script>
