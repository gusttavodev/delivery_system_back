<template>
<div class="container row" id="cards-container-category">
    <CategoryCard v-for="category in $page.categories" :key="category.id"
        :name="category.name"
        :photo="getCategoryPhoto(category.photo)"
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

import CategoryCard from './CategoryCard'

export default {
    components: {
        JetActionMessage,
        JetButton,
        TableLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        CategoryCard
    },
    props: ["categories"],
    data() {
        return {
            data: null
        };
    },
    methods: {
        getCategoryPhoto(photoPath){
            const host = window.location.host
            const photo = `http://${host}/storage/${photoPath}`

            return photo
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
