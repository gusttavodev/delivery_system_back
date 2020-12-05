<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sessão do Whatsapp
            </h2>

            <jet-button @click.native="startSession()" >
                Iniciar Sessão
            </jet-button>

        </template>

        <div class="py-12">
            <div class="col-span-6 sm:col-span-4">
                <p class="text-sm">{{ $page.flash.message }}</p>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <session-list />
                </div>
            </div>
        </div>


    </app-layout>


</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import SessionList from "./SessionList";
import JetButton from "@/Jetstream/Button";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        AppLayout,
        SessionList,
        JetButton,
        JetResponsiveNavLink,
        JetDialogModal,
        JetSecondaryButton
    },
    data() {
        return {
            showQrCode: false
        };
    },
    methods: {
        async startSession(){
            console.log("START SESSION");
        },
    },
};
</script>
