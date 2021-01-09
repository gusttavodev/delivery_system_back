<template>
    <div>
        <div class="container row" id="cards-container-product">
            <ProductCard
                v-for="product in $page.products.data"
                :key="product.id"
                :name="product.name"
                :photo="getPhoto(product.photo)"
                :id="product.id"
                :enable="product.enable"
                @confirm-delete="confirmDelete(product.id)"
            />
        </div>
        <div class="p-3">
            <pagination :links="$page.products.links" />
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

import ProductCard from "./ProductCard";
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
        ProductCard,
        JetDialogModal,
        JetDangerButton,
        Pagination
    },
    props: ["products"],
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
            this.form.post(route("deleteProduct", this.toDelete), {
                    preserveScroll: true
                }).then(response => {
                    if (! this.form.hasErrors()) {
                        this.confirmToDelete = false;
                        this.toDelete = null;
                        this.$inertia.replace(route("indexProduct"))
                    }
                })

        }
    }
};
</script>
