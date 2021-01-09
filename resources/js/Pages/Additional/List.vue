<template>
    <div>
        <div>
            <table-layout>
                <tr slot="table-title">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade Maxima</th>
                    <th>Ações</th>
                </tr>
                <tr
                    v-for="additional in $page.additionals.data"
                    :key="additional.id"
                    slot="table-content"
                >
                    <td>{{ additional.id }}</td>
                    <td>{{ additional.name }}</td>
                    <td>R$ {{ additional.price }}</td>
                    <td>{{ additional.quantity_limit }}</td>
                    <td>
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
                                    :href="route('editAddition', additional.id)"
                                >
                                    Editar
                                </jet-dropdown-link>
                                 <span @click="showConfirmDelete(additional.id)">
                            <jet-dropdown-link as="button">
                                    Remover
                            </jet-dropdown-link>
                        </span>
                            </template>
                        </jet-dropdown>
                    </td>
                </tr>
            </table-layout>
        </div>

        <div class="p-3">
            <pagination :links="$page.additionals.links" />
        </div>

        <confirm-delete-modal
            :show-modal="showRemoveModal"
            @accept-delete="deleteData"
            @cancel-delete="cancelDelete"
        />
    </div>
</template>

<script>
import TableLayout from "@/Layouts/TableLayout";
import JetButton from "@/Jetstream/Button";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import Pagination from "@/Shared/Pagination";
import ConfirmDeleteModal from '@/Shared/ConfirmDeleteModal'

export default {
    components: {
        JetButton,
        TableLayout,
        Pagination,
        JetDropdown,
        JetDropdownLink,
        ConfirmDeleteModal
    },
    props: ["additionals"],
    data() {
        return {
            showRemoveModal: false,
            itemIdToRemove: null,

            form: this.$inertia.form({
                '_method': 'DELETE',
                password: '',
            }, {
                bag: 'deleteAddition'
            })
        };
    },
    methods: {
        showConfirmDelete(id) {
           this.showRemoveModal = true
           this.itemIdToRemove = id
        },

        cancelDelete() {
           this.showRemoveModal = false
           this.itemIdToRemove = null
        },
        async deleteData() {
            await this.form.delete(route("deleteAddition", this.itemIdToRemove), {
                onFinish: () => {
                    this.$notify({
                        group: "app",
                        title: "Adicional Removido",
                        text: "Adicional Removido Com sucesso",
                        type: "success"
                    });
                }
            });

        }
    },
    mounted() {
        console.log("PAGE ", this.$page.additionals.data);
    }
};
</script>
