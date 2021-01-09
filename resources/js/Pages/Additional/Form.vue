<template>
    <form-layout @submitted="sendForm">
        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <p class="text-sm">{{ $page.flash.message }}</p>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label for="name" value="Nome" />
                        <jet-input
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            autofocus
                        />
                        <jet-input-error
                            :message="$page.errors.name"
                            class="mt-2"
                        />
                    </div>

                    <div class="col">
                        <jet-label for="price" value="Preço" />
                        <jet-input
                            id="price"
                            type="number"
                            step="0.5"
                            class="mt-1 block w-full"
                            v-model="form.price"
                            autofocus
                        />
                        <jet-input-error
                            :message="$page.errors.price"
                            class="mt-2"
                        />
                    </div>

                    <div class="col">
                        <jet-label for="quantity_limit" value="Quantidade Limite" />
                        <jet-input
                            id="quantity_limit"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.quantity_limit"
                            autofocus
                        />
                        <jet-input-error
                            :message="$page.errors.quantity_limit"
                            class="mt-2"
                        />
                    </div>
                </div>

            </div>

        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Salvo.
            </jet-action-message>

            <jet-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Salvar
            </jet-button>
        </template>
    </form-layout>
</template>

<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import FormLayout from "@/Layouts/FormLayout";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    props: {
        isEdit: {
            default: false
        },
        additional: {
            default: null
        },
    },
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        FormLayout,
        JetSecondaryButton,
    },
    data() {
        return {
             form: this.$inertia.form(
                {
                   name: "",
                   price: null,
                   quantity_limit: null
                },
                {
                    bag: "createAddiction",
                    resetOnSuccess: false
                }
            )
        };
    },
    mounted() {
        if(this.isEdit){
            this.form.name = this.additional.name
            this.form.price = this.additional.price
            this.form.quantity_limit = this.additional.quantity_limit
        }
    },
    methods: {
        async sendForm() {
            if(this.isEdit) {
                await this.sendUpdate()
            }else {
                await this.sendStore()
            }
        },
        async sendStore() {
            await this.form.post(route("storeAddition"), {
                onFinish: () => {
                    this.$inertia.replace(route("indexAddition"))
                }
            });
        },
        async sendUpdate() {
            await this.form.post(route("updateAddition", this.additional.id), {
                onFinish: () => {
                    this.$notify({
                        group: "app",
                        title: "Adicional Atualizado",
                        text: "Adicional Atualizado Com sucesso",
                        type: "success"
                    });
                }
            });
        },

    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
