<template>
    <div>
        <div>
            <table-layout>
                <tr slot="table-title">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Telefone</th>
                </tr>
                <tr v-for="wppSession in $page.wppSessions.data" :key="wppSession.id" slot="table-content">
                    <td>{{wppSession.id}}</td>
                    <td>{{wppSession.name}}</td>
                    <td>{{wppSession.status}}</td>
                    <td>{{wppSession.phone}}</td>
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
        async changePage(page = 1,){
            this.$inertia.replace('/product?page='+page)
        }
    },
    mounted(){

    }

};
</script>

<style>
#cards-container-product {
}
</style>
