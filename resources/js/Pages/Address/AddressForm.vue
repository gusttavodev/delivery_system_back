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
                            value="Bairro"
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

                    <div class="col">
                        <jet-label
                            for="number"
                            value="Numero"
                        />
                        <jet-input
                            id="district"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.number"
                        />
                        <jet-input-error
                            :message="$page.errors.number"
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
    props: ["errors", "establishment"],
    data() {
        return {
            form: {
                establishment_id: null,
                zip_code: "",
                street: "",
                city: "",
                country: "",
                district: "",
                state: "",
                number: "",
                complement: "",
            }
        };
    },
    mounted() {
        if(this.establishment.address) this.form = this.establishment.address
    },
    methods: {
        async getZipcodeInfo() {
          let instance = axios.create();
          // Clear Headers
          delete instance.defaults.headers.common["X-Requested-With"];

          const response = await instance.get(`https://api.postmon.com.br/v1/cep/33030120`)
          if(response.status === 200){
              const address = response.data
              this.form.zip_code = address.cep
              this.form.street = address.logradouro
              this.form.city = address.cidade
              this.form.district = address.bairro
              this.form.state = address.estado
          }
        },
        async sendForm() {
            this.form.establishment_id = this.establishment.id

            let inertiaForm = this.$inertia.form(
                this.form,
                {
                    bag: "saveEstablishmentAddress",
                    resetOnSuccess: true
                }
            )
            const response = await inertiaForm.post(route("storeEstablishmentAddress"), {
                onFinish: () => {
                    this.$notify({
                        group: 'app',
                        title: 'Endereço Salvo',
                        text: 'Seu Endereço foi salvo com sucesso',
                        type: 'success'
                    })
                }
            })
        }
    }
};
</script>
