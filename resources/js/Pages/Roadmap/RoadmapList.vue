<template>
    <div>
        <div>
            <table-layout>
                <tr slot="table-title">
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Usuario</th>
                    <th>Ações</th>
                </tr>
                <tr v-for="roadmap in $page.roadmaps.data" :key="roadmap.id" slot="table-content">
                    <td>{{roadmap.id}}</td>
                    <td>{{roadmap.title}}</td>
                    <td>{{roadmap.user.email}}</td>
                    <td>
                    <jet-dropdown align="right" width="48">
                        <template #trigger>
                            <jet-button >
                                Ações
                            </jet-button>
                        </template>

                        <template #content>
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Escolha uma ação
                            </div>
                            <jet-dropdown-link :href="route('createRoadmapStep', roadmap.id)">
                                Gerenciar Etapas
                            </jet-dropdown-link>
                            <jet-dropdown-link :href="route('indexProduct')">
                                Agendar Roteiro
                            </jet-dropdown-link>
                        </template>
                    </jet-dropdown>
                    </td>
                </tr>
            </table-layout>
        </div>

        <div class="p-3">
            <pagination :links="$page.roadmaps.links" />
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

import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'

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
        JetDropdown,
        JetDropdownLink
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

        }
    }
};
</script>
