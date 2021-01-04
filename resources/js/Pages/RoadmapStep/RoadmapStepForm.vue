<template>
    <form-layout @submitted="sendForm">
        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label for="title" value="Titulo" />
                        <jet-input
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            autofocus
                        />
                        <jet-input-error
                            :message="$page.errors.title"
                            class="mt-2"
                        />
                    </div>
                    <div class="col">
                        <jet-label
                            for="message_invalid_response"
                            value="Mensagem para opção invalida"
                        />
                        <text-area-input
                            id="message_invalid_response"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.message_invalid_response"
                        />
                        <jet-input-error
                            :message="$page.errors.message_invalid_response"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label
                            for="message_before_options"
                            value="Mensagem antes das opções"
                        />
                        <text-area-input
                            id="message_before_options"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.message_before_options"
                        />
                        <jet-input-error
                            :message="$page.errors.message_before_options"
                            class="mt-2"
                        />
                    </div>

                    <div class="col">
                        <jet-label
                            for="message_after_options"
                            value="Mensagem depois das opções"
                        />
                        <text-area-input
                            id="message_after_options"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.message_after_options"
                        />
                        <jet-input-error
                            :message="$page.errors.message_after_options"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label
                            for="has_options"
                            value="Está estapa tem opções:"
                        />
                        <label class="inline-flex items-center mt-3">
                            <input
                                v-model="form.has_options"
                                type="checkbox"
                                class="form-checkbox h-5 w-5 text-gray-600"
                                checked
                            /><span class="ml-2 text-gray-700">Sim</span>
                        </label>
                        <jet-input-error
                            :message="$page.errors.has_options"
                            class="mt-2"
                        />
                    </div>

                    <div class="col">
                        <jet-label
                            for="step_before_invalid_response"
                            value="Etapa caso resposta inválida"
                        />
                        <v-select
                            label="step_before_invalid_response"
                            :options="roadmapStepsNoOptions"
                            v-model="form.step_before_invalid_response"
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
    props: ["errors", "roadmap", "roadmapSteps"],
    data() {
        return {
            form: this.$inertia.form(
                {
                    title: "",
                    message_before_options: "",
                    message_after_options: "",
                    message_invalid_response: "",
                    has_options: true,
                    step_before_invalid_response: null
                },
                {
                    bag: "createRoadmapStep",
                    resetOnSuccess: true
                }
            ),
            roadmapStepsNoOptions: this.$page.roadmapStepsNoOptions
        };
    },
    mounted() {

    },
    methods: {
        async sendForm() {
            if (this.form.step_before_invalid_response)
                this.form.step_before_invalid_response = this.form.step_before_invalid_response.id;
            const response = await this.form.post(route("storeRoadmapStep", this.$page.roadmap.id), {
                onFinish: () => {
                    this.$notify({
                        group: 'app',
                        title: 'Etapa criada',
                        text: 'Sua etapa foi criada com sucesso',
                        type: 'success'
                    })
                }
            })
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
