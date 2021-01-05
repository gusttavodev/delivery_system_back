<template>
    <form-layout @submitted="createCategory">
        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <image-input
                            v-model="form.picture"
                            :errors="$page.errors.picture"
                            label="Foto"
                            :isEdit="isEdit"
                            :defaultImageUrl="editData.data.picture"
                        />
                    </div>
                     <div class="col">
                        <image-input
                            v-model="form.background_picture"
                            :errors="$page.errors.background_picture"
                            label="Foto de Fundo"
                            :isEdit="isEdit"
                            :defaultImageUrl="editData.data.background_picture"
                        />
                    </div>
                </div>
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
                        <jet-input-error :message="$page.errors.name" class="mt-2" />
                    </div>

                    <div class="col">
                         <jet-label
                            for="description"
                            value="Descrição"
                        />
                        <text-area-input
                            id="description"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.description"
                        />
                        <jet-input-error
                            :message="$page.errors.description"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label for="delivery_time" value="Tempo de entrega" />
                        <jet-input
                            id="delivery_time"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.delivery_time"
                        />
                        <jet-input-error
                            :message="$page.errors.delivery_time"
                            class="mt-2"
                        />
                    </div>
                    <div class="col">
                        <jet-label for="min_value" value="Preço Minimo" />
                        <jet-input
                            id="min_value"
                            type="number"
                            step="0.01"
                            class="mt-1 block w-full"
                            v-model="form.min_value"
                        />
                        <jet-input-error
                            :message="$page.errors.min_value"
                            class="mt-2"
                        />
                    </div>

                    <div class="col">
                        <jet-label for="phone" value="Telefone" />
                        <the-mask
                            id="phone"
                            type="text"
                            v-model="form.phone"
                            :mask="['(##) ####-####', '(##) #####-####']"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                        />
                        <jet-input-error
                            :message="$page.errors.phone"
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
    props: ['errors', 'isEdit', 'editData'],
    data() {
        return {
            form: {
                name: "",
                description: "",
                picture: null,
                delivery_time: "",
                min_value: null,
                background_picture: null,
                phone: ""
            }
        };
    },
    mounted() {
        if(this.isEdit){
            console.log(this.editData);
            this.form = this.editData.data
        }
    },
    methods: {
        async createCategory() {
            if (this.isEdit) {
                return await this.updateProduct();
            }

            var data = new FormData()

            data.append('name', this.form.name || '')
            data.append('description', this.form.description || '')
            data.append('picture', this.form.picture || '')
            data.append('delivery_time', this.form.delivery_time || '')
            data.append('min_value', this.form.min_value || '')
            data.append('background_picture', this.form.background_picture || '')
            data.append('phone', this.form.phone || '')

            const response = await this.$inertia.post(route("storeEstablishment"), data)

            this.$inertia.replace(route("indexEstablishment"))
        },
         async updateProduct() {
            if(typeof this.form.picture === 'string'){
                this.form.picture = false
            }
            if(typeof this.form.background_picture === 'string'){
                this.form.background_picture = false
            }

            var data = new FormData()

            data.append('name', this.form.name || '')
            data.append('description', this.form.description || '')
            data.append('picture', this.form.picture || '')
            data.append('delivery_time', this.form.delivery_time || '')
            data.append('min_value', this.form.min_value || '')
            data.append('background_picture', this.form.background_picture || '')
            data.append('phone', this.form.phone || '')

            const response = await this.$inertia.post(route("updateEstablishment", this.form.id), data)

            this.$notify({
                group: 'app',
                title: 'Estabelecimento',
                text: 'Estabelecimento Atualizado com Sucesso!',
                type: 'success'
            })
        },
    }
};
</script>
