<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sessão do Whatsapp
            </h2>

            <jet-button @click.native="showStartSession = true">
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

        <jet-dialog-modal :show="showStartSession" @close="showStartSession = false">
            <template #title>
                Criar sua sessão de conexão com Whatsapp
            </template>

            <template #content>
                 <jet-label for="phone" value="Seu número de telefone" />
                <jet-input
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    autofocus
                />
                <jet-input-error
                    :message="$page.errors.phone"
                    class="mt-2"
                />
            </template>

            <template #footer>
                <jet-secondary-button @click.native="showStartSession = false">
                    Fechar
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="startSession()">
                     Iniciar Sessão
                </jet-button>
            </template>
        </jet-dialog-modal>


    </app-layout>


</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import SessionList from "./SessionList";
import JetButton from "@/Jetstream/Button";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
    props: ["errors"],
    components: {
        AppLayout,
        SessionList,
        JetButton,
        JetResponsiveNavLink,
        JetDialogModal,
        JetSecondaryButton,
        JetInput,
        JetLabel,
        JetInputError
    },
    data() {
        return {
            form: {
                phone: null
            },
            showStartSession: false
        };
    },
    methods: {
        async startSession(){
            const sessionName = `user_${this.$page.user.id}_${this.form.phone}`
            const { data } = await axios.get(`http://localhost:3000/api/start?sessionName=${sessionName}`);

            if(data.success){
                const { name, status, state } = data.data
                const response = await axios.post(route("storeWppSession"), {
                    name,
                    phone: this.form.phone,
                    status,
                    state,
                    user_id: this.$page.user.id
                });
                this.$inertia.reload()
            }
        },
    },
};
</script>
