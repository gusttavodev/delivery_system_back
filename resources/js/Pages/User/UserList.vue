<template>
    <div>
        <div>
            <table-layout>
                <tr slot="table-title">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>
                <tr v-for="user in $page.users.data" :key="user.id" slot="table-content">
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                </tr>
            </table-layout>
        </div>

        <div class="p-3">
            <pagination :links="$page.users.links" />
        </div>

        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal
            :show="confirmToDelete"
            @close="confirmToDelete = false"
        >
            <template #title>
                Deletar Produto
            </template>

            <template #content>
                Deseja realmente deletar essa produto
            </template>

            <template #footer>
                <jet-secondary-button
                    @click.native="confirmToDelete = false"
                >
                    Cancelar
                </jet-secondary-button>

                <jet-danger-button
                    class="ml-2"
                    @click.native="deleteData"
                >
                    Deletar Produto
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
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
        Pagination
    },
    props: ["users"],
    data() {
        return {
            confirmToDelete: false,
            toDelete: null,

            form: this.$inertia.form({
                '_method': 'DELETE',
                password: '',
            }, {
                bag: 'deleteProduct'
            })
        };
    },
    methods: {
        getPhoto(photoPath) {
            const host = window.location.host;
            const photo = `http://${host}/storage/${photoPath}`;

            return photo;
        },
        confirmDelete(id) {
            this.confirmToDelete = true;
            this.toDelete = id;
        },
        async deleteData() {
            this.form.post(route("deleteUser", this.toDelete), {
                    preserveScroll: true
                }).then(response => {
                    if (! this.form.hasErrors()) {
                        this.confirmToDelete = false;
                        this.toDelete = null;
                        this.$inertia.replace(route("indexUser"))
                    }
                })

        },
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
