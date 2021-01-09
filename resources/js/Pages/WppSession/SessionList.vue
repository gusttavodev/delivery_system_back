<template>
    <div>
        <div>
            <table-layout>
                <tr slot="table-title">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Telefone</th>
                    <th style="text-align:center;">Autenticado</th>
                    <th style="text-align:center;">Sessão</th>
                </tr>
                <tr v-for="wppSession in $page.wppSessions.data" :key="wppSession.id" slot="table-content">
                    <td>{{wppSession.id}}</td>
                    <td>{{wppSession.name}}</td>
                    <td>{{wppSession.status}}</td>
                    <td>{{wppSession.phone}}</td>
                    <td style="text-align:center;">
                        <unicon v-if="wppSession.is_auth" name="check-circle" fill="#2CA94F"/>
                        <unicon v-else name="times-circle" fill="#ED422C"/>
                    </td>
                    <td  style="text-align:center;">
                        <unicon v-if="wppSession.is_auth" name="check-circle" fill="#2CA94F"/>
                        <jet-button v-else class="ml-2" @click.native="startSession(wppSession)">
                            Iniciar Sessão
                        </jet-button>
                    </td>
                </tr>
            </table-layout>
        </div>

        <div class="p-3">
            <pagination :links="$page.wppSessions.links" />
        </div>

    </div>
</template>

<script>
import TableLayout from "@/Layouts/TableLayout";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetDangerButton from "@/Jetstream/DangerButton";

import Pagination from '@/Shared/Pagination'

export default {
    components: {
        JetActionMessage,
        JetButton,
        TableLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetDialogModal,
        JetDangerButton,
        Pagination,
    },
    props: ["wppSessions"],
    data() {
        return {

        };
    },
    methods: {
        async startSession(wppSession){
            const { data } = await axios.get(`http://localhost:3000/api/start?sessionName=${wppSession.name}`);
            if(data.success){
                this.$notify({
                    group: 'app',
                    title: 'Sessão Iniciada',
                    text: 'Sua sessão foi iniciada com sucesso, scaneie o código QR para proseguir!',
                    type: 'success'
                })
            }
        },
    }
};
</script>
