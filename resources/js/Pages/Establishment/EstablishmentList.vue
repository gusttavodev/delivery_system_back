<template>
    <div>
        <div class="container row" id="cards-container-category">
            <EstablishmentCard
                v-for="establishment in $page.establishments.data"
                :key="establishment.id"
                :name="establishment.name"
                :picture="establishment.picture"
                :id="establishment.id"
                :link="establishment.public_link_name"
                @confirm-delete="confirmDelete"
            />
        </div>

        <div class="p-3">
            <pagination :links="$page.establishments.links" />
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
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetDangerButton from "@/Jetstream/DangerButton";

import EstablishmentCard from "./EstablishmentCard";
import Pagination from '@/Shared/Pagination'
import ConfirmDeleteModal from '@/Shared/ConfirmDeleteModal'

export default {
    components: {
        JetActionMessage,
        JetButton,
        TableLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        EstablishmentCard,
        JetDialogModal,
        JetDangerButton,
        Pagination,
        ConfirmDeleteModal
    },
    props: ["establishments"],
    data() {
        return {
            showRemoveModal: false,
            itemIdToRemove: null,

            form: this.$inertia.form({
                '_method': 'DELETE',
                password: '',
            }, {
                bag: 'deleteCategory'
            })
        };
    },
    methods: {
        confirmDelete(id) {
           this.showRemoveModal = true
           this.itemIdToRemove = id
        },
        cancelDelete() {
           this.showRemoveModal = false
           this.itemIdToRemove = null
        },

        async deleteData() {
            await this.form.delete(route("deleteEstablishment", this.itemIdToRemove), {
                onFinish: () => {
                    this.$notify({
                        group: "app",
                        title: "Estabelecimento Removido",
                        text: "Estabelecimento Removido Com sucesso",
                        type: "success"
                    });
                }
            });

        }
    },
    mounted(){

    }

};
</script>
