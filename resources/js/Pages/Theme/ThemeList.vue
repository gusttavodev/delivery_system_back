<template>
    <div>
        <div>
            <table-layout>
                <tr slot="table-title">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                <tr
                    v-for="theme in $page.themes.data"
                    :key="theme.id"
                    slot="table-content"
                >
                    <td>{{ theme.id }}</td>
                    <td>{{ theme.name }}</td>
                    <th>
                        <jet-dropdown align="center" width="48">
                            <template #trigger>
                                <jet-button>
                                    Ações
                                </jet-button>
                            </template>

                            <template #content>
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Escolha uma ação
                                </div>
                                <jet-dropdown-link
                                    :href="route('editTheme', theme.id)"
                                >
                                    Editar
                                </jet-dropdown-link>

                                <span @click="confirmDelete(theme.id)">
                                    <jet-dropdown-link as="button">
                                        Remover
                                    </jet-dropdown-link>
                                </span>
                            </template>
                        </jet-dropdown>
                    </th>
                </tr>
            </table-layout>
        </div>

        <div class="p-3">
            <pagination :links="$page.themes.links" />
        </div>

        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal
            :show="confirmToDelete"
            @close="confirmToDelete = false"
        >
            <template #title>
                Deletar Tema
            </template>

            <template #content>
                Deseja realmente deletar esse tema
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmToDelete = false">
                    Cancelar
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteData">
                    Deletar Tema
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
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";

import Pagination from "@/Shared/Pagination";

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
    data() {
        return {
            confirmToDelete: false,
            toDelete: null,

            form: this.$inertia.form(
                {
                    _method: "DELETE"
                },
                {
                    bag: "deleteTheme"
                }
            )
        };
    },
    methods: {
        confirmDelete(id) {
            this.confirmToDelete = true;
            this.toDelete = id;
        },
        async deleteData() {
            await this.form.delete(route("deleteTheme", this.toDelete), {
                onFinish: () => {
                    this.$notify({
                        group: "app",
                        title: "Tema Removido",
                        text: "Tema Removido Com sucesso",
                        type: "success"
                    });
                }
            });
        }
    }
};
</script>
