<template>
    <div>
        <div class="container row" id="cards-container-category">
            <CategoryCard
                v-for="category in $page.categories.data"
                :key="category.id"
                :name="category.name"
                :photo="getCategoryPhoto(category.photo)"
                :id="category.id"
                :enable="category.enable"
                @confirm-delete="confirmDelete(category.id)"
            />
        </div>
        <div class="p-3">
            <pagination :links="$page.categories.links" />
        </div>

        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal
            :show="confirmingCategoryDeletion"
            @close="confirmingCategoryDeletion = false"
        >
            <template #title>
                Deletar Categoria
            </template>

            <template #content>
                Deseja realmente deletar essa categoria
            </template>

            <template #footer>
                <jet-secondary-button
                    @click.native="confirmingCategoryDeletion = false"
                >
                    Cancelar
                </jet-secondary-button>

                <jet-danger-button
                    class="ml-2"
                    @click.native="deleteCategory"
                >
                    Deletar Categoria
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

import CategoryCard from "./CategoryCard";
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
        CategoryCard,
        JetDialogModal,
        JetDangerButton,
        Pagination
    },
    props: ["categories"],
    data() {
        return {
            confirmingCategoryDeletion: false,
            categeoryToDelete: null,

            form: this.$inertia.form({
                '_method': 'DELETE',
                password: '',
            }, {
                bag: 'deleteCategory'
            })
        };
    },
    methods: {
        getCategoryPhoto(photoPath) {
            const host = window.location.host;
            const photo = `http://${host}/storage/${photoPath}`;

            return photo;
        },
        confirmDelete(id) {
            this.confirmingCategoryDeletion = true;
            this.categeoryToDelete = id;
        },
        async deleteCategory() {
            this.form.post(route("deleteCategory", this.categeoryToDelete), {
                    preserveScroll: true
                }).then(response => {
                    if (! this.form.hasErrors()) {
                        this.confirmingCategoryDeletion = false;
                        this.categeoryToDelete = null;
                        this.$inertia.replace(route("indexCategory"))
                    }
                })

        },
        async changePage(page = 1,){
            this.$inertia.replace('/category?page='+page)
        }
    },
    mounted(){

    }

};
</script>

<style>
#cards-container-category {
}
</style>
