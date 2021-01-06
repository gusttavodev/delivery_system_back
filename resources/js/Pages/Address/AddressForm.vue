<template>
    <form-layout @submitted="sendForm">
        <template #form>

            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label for="zip_code" value="CEP" />
                        <the-mask
                            v-model="form.zip_code"
                            :mask="'#####-###'"
                            @blur.native="getZipcodeInfo()"
                            name="zip_code"
                            type="text"
                            id="zip_code"
                            class="form-control input-lg"
                        />
                        <jet-input-error
                            :message="$page.errors.zip_code"
                            class="mt-2"
                        />
                    </div>
                    <div class="col">
                        <jet-label
                            for="street"
                            value="Rua"
                        />
                        <jet-input
                            id="street"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.street"
                        />
                        <jet-input-error
                            :message="$page.errors.street"
                            class="mt-2"
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <jet-label for="city" value="Cidade" />
                        <jet-input
                            id="city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.city"
                        />
                        <jet-input-error
                            :message="$page.errors.city"
                            class="mt-2"
                        />
                    </div>
                    <div class="col">
                        <jet-label
                            for="district"
                            value="Bairro/Logradouro"
                        />
                        <jet-input
                            id="district"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.district"
                        />
                        <jet-input-error
                            :message="$page.errors.district"
                            class="mt-2"
                        />
                    </div>
                </div>

                 <div class="row">
                    <div class="col">
                        <jet-label for="state" value="Estado" />
                        <jet-input
                            id="state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.state"
                        />
                        <jet-input-error
                            :message="$page.errors.state"
                            class="mt-2"
                        />
                    </div>
                    <div class="col">
                        <jet-label
                            for="country"
                            value="País"
                        />
                        <jet-input
                            id="country"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.country"
                        />
                        <jet-input-error
                            :message="$page.errors.country"
                            class="mt-2"
                        />
                    </div>

                     <div class="col">
                        <jet-label
                            for="complement"
                            value="Complemento"
                        />
                        <jet-input
                            id="complement"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.complement"
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
                    zip_code: "",
                    street: "",
                    city: "",
                    country: "",
                    district: "",
                    state: "",
                    number: "",
                    complement: "",
                },
                {
                    bag: "saveEstablishmentAddress",
                    resetOnSuccess: true
                }
            )
        };
    },
    mounted() {

    },
    methods: {
        async getZipcodeInfo() {
          let instance = axios.create();
          // Clear Headers
          delete instance.defaults.headers.common["X-Requested-With"];

          const result = await instance.get(`https://api.postmon.com.br/v1/cep/33030120`)
          console.log("RESULT", result);
        },
        async sendForm() {
            const response = await this.form.post(route("storeRoadmapStep"), {
                onFinish: () => {
                    this.$notify({
                        group: 'app',
                        title: 'Etapa criada',
                        text: 'Endereço adicionado com sucesso',
                        type: 'success'
                    })
                }
            })
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
