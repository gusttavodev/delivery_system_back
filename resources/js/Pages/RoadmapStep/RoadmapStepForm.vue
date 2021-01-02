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
                          <jet-label for="email" value="Descrição" />
                            <text-area-input
                                id="email"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.email"
                            />
                            <jet-input-error :message="$page.errors.email" class="mt-2" />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <jet-label for="password" value="Senha" />
                        <jet-input
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            autofocus
                        />
                        <jet-input-error
                            :message="$page.errors.password"
                            class="mt-2"
                        />
                    </div>

                    <div class="col">
                        <jet-label for="password_confirmation" value="Confirmar Senha" />
                        <jet-input
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password_confirmation"
                            autofocus
                        />
                        <jet-input-error
                            :message="$page.errors.password_confirmation"
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
                Adicionar
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
import TextAreaInput from "@/Shared/TextAreaInput";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        FormLayout,
        JetSecondaryButton,
        TextAreaInput
    },
    props: ["errors"],
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },

        };
    },
    mounted() {

    },
    methods: {

        async sendForm() {
            let response = await this.$inertia.post(route("storeUser"), this.form);
        },

    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
