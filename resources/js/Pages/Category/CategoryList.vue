<template>
    <table-layout>
        <template #table-title>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Prioridade</th>
                <th class="p-3 text-left" width="110px">Habilitado</th>
                <th class="p-3 text-left" width="110px">Ações</th>
        </template>

        <template #table-content>
            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0" v-for="category in $page.categories" :key="category.id">
                 <td class="border-grey-light border hover:bg-gray-100 p-3">
                    {{category.name}}
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    {{category.priority}}
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    {{category.enable}}
                </td>
                <td
                    class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer"
                >
                    Delete
                </td>
            </tr>
        </template>
    </table-layout>
</template>

<script>
import TableLayout from "@/Layouts/TableLayout";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        JetActionMessage,
        JetButton,
        TableLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton
    },
    props: ["categories"],
    data() {
        return {
            data: null
        };
    },
    methods: {

    },
    mounted(){

    }
};
</script>
