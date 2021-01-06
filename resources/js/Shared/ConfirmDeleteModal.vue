<template>
    <div>
        <jet-dialog-modal
            :show="showModal"
            @close="showModal = false"
        >
            <template #title>
                {{title}}
            </template>

            <template #content>
                {{textContent}}
            </template>

            <template #footer>
                <jet-secondary-button
                    @click.native="actionCancel"
                >
                    {{textCancel}}
                </jet-secondary-button>

                <jet-danger-button
                    class="ml-2"
                    @click.native="actionDelete"
                >
                    {{textConfirm}}
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
    props: {
        title: {
            type: String,
            default: "Deletar"
        },
        textContent: {
            type: String,
            default: "Deseja realmente deletar ?"
        },
        textCancel: {
            type: String,
            default: "Cancelar"
        },
        textConfirm: {
            type: String,
            default: "Deletar"
        },
        showModal: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        actionDelete(){
           this.$emit('accept-delete');
        },
        actionCancel(){
           this.$emit('cancel-delete');
        },
    }
};
</script>
