<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listar Contatos
            </h2>

             <jet-button @click.native="showQrCode = true" >
                Verificar Whatsapp
            </jet-button>

            <jet-button @click.native="importContacts()" >
                Importar Contatos
            </jet-button>

            <inertia-link :href="route('createRole')" >
            <jet-button >
                    Criar Contato
                </jet-button>
            </inertia-link>

        </template>

        <div class="py-12">
            <div class="col-span-6 sm:col-span-4">
                <p class="text-sm">{{ $page.flash.message }}</p>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <contact-list />
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="showQrCode" @close="showQrCode = false">
            <template #title>
                Escaneie esse QR Code com seu Whatsapp para habilitar este número
            </template>

            <template #content>
                <img src="http://localhost:3000/api/getQrCode?sessionName=session1&amp;image=true">
            </template>

            <template #footer>
                <jet-secondary-button @click.native="showQrCode = false">
                    Fechar
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="getQrCode">
                    Atualizar
                </jet-button>
            </template>
        </jet-dialog-modal>

    </app-layout>


</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ContactList from "./ContactList";
import JetButton from "@/Jetstream/Button";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        AppLayout,
        ContactList,
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
         async importContacts(){
            const { data } = await axios.get('http://localhost:3000/api/contacts/all', {
                params: {
                    sessionName: 'session1',
                    isSave: true
                }
            })
            console.log("DATA", data);
            if(data.result == "success")  await this.$inertia.post( route("storeWppContacs"), { contacts: data.data })
        },
        async getQrCode(){
            const result = await axios.get('http://localhost:3000/api/getQrCode', {
                params: {
                    sessionName: 'session1',
                    image: true
                }
            })
            console.log("result", result);
        }
    },
};
</script>
