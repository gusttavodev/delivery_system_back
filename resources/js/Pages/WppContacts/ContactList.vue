<template>
    <div>
        <div>
            <table-layout>
                <tr slot="table-title">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>TELEFONE</th>
                </tr>
                <tr v-for="wppContact in $page.wppContacts.data" :key="wppContact.id" slot="table-content">
                    <td>{{wppContact.id}}</td>
                    <td>{{wppContact.name}}</td>
                    <td>{{wppContact.user_phone}}</td>
                </tr>
            </table-layout>
        </div>

        <div class="p-3">
            <pagination :links="$page.wppContacts.links" />
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
    props: ["wppContacts"],
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
