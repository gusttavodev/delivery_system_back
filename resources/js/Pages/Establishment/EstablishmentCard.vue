<template>
    <div class="card ext-white m-3" style="max-width: 18rem;">
        <img :src="picture" id="category-card" class="card-img-top" :alt="name" />
        <div class="card-body">
            <div id="category-card-actions" style="">
                <p class="card-text">{{ name }}</p>
                <jet-dropdown align="right" width="48">
                    <template #trigger>
                        <jet-secondary-button >
                            Ações
                        </jet-secondary-button>
                    </template>

                    <template #content>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Escolha uma ação
                        </div>
                        <jet-dropdown-link :href="route('editEstablishment', id)">
                            Editar
                        </jet-dropdown-link>
                        <span @click="actionDelete(id)">
                            <jet-dropdown-link as="button">
                                    Remover
                            </jet-dropdown-link>
                        </span>
                        <jet-dropdown-link :href="route('indexPublicEstablishment', link)">
                            Link Publico
                        </jet-dropdown-link>
                    </template>
                </jet-dropdown>
            </div>
        </div>
    </div>
</template>

<script>
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import ConfirmDeleteModal from '@/Shared/ConfirmDeleteModal'

export default {
    props: ["name", "picture", "id", "link"],
    components: {
        JetSecondaryButton,
        JetDropdown,
        JetDropdownLink,
        ConfirmDeleteModal
    },
    methods: {
        async actionDelete(id){
           this.$emit('confirm-delete', id);
        },
    }
};
</script>

<style scoped>
.desable_img {
    opacity: 0.2;
    filter: alpha(opacity=20); /* msie */
    background-color: #000;
}
#category-card-actions {
   display: flex;
   justify-content: center;
   align-items: center;
   flex-direction: column;
}
#category-card {
    width: 300px;
    height: 200px;
}
</style>
