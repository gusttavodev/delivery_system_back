<template>
    <form-layout @submitted="sendForm">
        <template #form>
            <div class="col-span-6 sm:col-span-4">

                <div class="row" v-for="(input, key) in form.inputs" :key="key">
                     <div class="col">
                        <jet-label for="title" value="Produto:" />
                         <label class="inline-flex items-center mt-2">
                            <input
                                v-model="input.is_product"
                                type="checkbox"
                                class="form-checkbox h-5 w-5 text-gray-600"
                                checked
                            /><span class="ml-2 text-gray-700">Sim</span>
                        </label>
                    </div>


                    <div class="col-6" v-if="input.is_product">
                        <jet-label for="title" value="Produto" />
                        <v-select
                            label="name"
                            :options="$page.products"
                            v-model="input.product"
                        />
                    </div>
                    <div class="col-6" v-else>
                        <jet-label for="title" value="Texto" />
                        <jet-input
                            type="text"
                            class="mt-1 block w-full"
                            v-model="input.text"
                            autofocus
                        />
                    </div>


                    <div class="col pt-4">
                        <jet-button @click.native="addInput(key)" type="button">
                            Adicionar
                        </jet-button>
                    </div>
                    <div class="col mt-4">
                        <jet-danger-button @click.native="removeInput(key)" type="button">
                            Remover
                        </jet-danger-button>
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
import TextAreaInput from "@/Shared/TextAreaInput";
import JetDangerButton from '@/Jetstream/DangerButton'

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
        TextAreaInput,
        JetDangerButton
    },
    props: ["errors", "roadmapSteps", "products"],
    data() {
        return {
            form: this.$inertia.form(
                {
                    inputs: [
                        {id: 0, is_product: false, text: null, product: null}
                    ],
                },
                {
                    bag: "createStepOption",
                    resetOnSuccess: true
                }
            ),
        };
    },
    mounted() {},
    methods: {
        addInput(index) {
            this.form.inputs.push(
                { id: index, is_product: false, text: null, product: null }
            );
        },
        removeInput(index) {
            if(index > 0)this.form.inputs.splice(index, 1);
        },
        async sendForm() {
            if (this.form.step_before_invalid_response)
                this.form.step_before_invalid_response = this.form.step_before_invalid_response.id;
            const response = await this.form.post(
                route("storeRoadmapStep", this.$page.roadmap.id),
                {
                    onFinish: () => {
                        this.$notify({
                            group: "app",
                            title: "Etapa criada",
                            text: "Sua etapa foi criada com sucesso",
                            type: "success"
                        });
                    }
                }
            );
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
