<template>
    <form-layout @submitted="storeTheme">
        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <div class="row">                   
                    <div class="col">
                        <jet-label
                            for="establishment_theme"
                            value="Tema deste estabelecimento"
                        />
                        <v-select
                            label="name"
                            :options="themes"
                            v-model="form.theme"
                        />
                        <jet-input-error :message="$page.errors.theme" class="mt-2" />
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
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import TextAreaInput from "@/Shared/TextAreaInput";
import ImageInput from "@/Shared/ImageInput"

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
        ImageInput
    },
    props: ['errors', 'themes'],
    data() {
        return {
            form: {
                theme: this.$page.establishment.data.theme,
                establishment: this.$page.establishment.data
            }
        };
    },
    mounted() {
    },
    methods: {
        async storeTheme() {
            await this.$inertia.post(route("storeEstablishmentTheme"), this.form)
           this.$notify({
                group: 'app',
                title: 'Estabelecimento',
                text: 'Estabelecimento Atualizado com Sucesso!',
                type: 'success'
           })
        }
    }
};
</script>
