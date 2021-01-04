<template>
    <form-layout @submitted="createCategory">
        <template #form>
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
                <input type="file" class="hidden"
                            ref="picture"
                            @change="updatePhotoPreview">

                <jet-label for="picture" value="Foto" />

                <div class="mt-2" v-show="photoPreview">
                    <div v-if="isEdit && !editPhotoPreview">
                        <img id="old_image" :src="getCategoryPhoto(form.picture)" class="block rounded-full w-40 h-40" :alt="form.name" />
                    </div>
                    <div v-else>
                        <span class="block rounded-full w-40 h-40"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Escolha uma Foto
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto" v-if="form.picture">
                    Remover Foto
                </jet-secondary-button>

                <jet-input-error :message="$page.errors.picture" class="mt-2" />
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
                        <jet-label for="min_value" value="Preço" />
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
    props: ['errors', 'isEdit', 'editData'],
    data() {
        return {
            form: {
                name: "",
                description: "",
                picture: "",
                delivery_time: "",
                min_value: null
            },
            editPhotoPreview: false,
            photoPreview: null
        };
    },
    mounted() {
        if(this.isEdit){
            this.form = this.editData.data
        }
    },
    methods: {
        getCategoryPhoto(photoPath) {
            const host = window.location.host;
            const picture = `http://${host}/storage/${photoPath}`;
            this.photoPreview = true
            return picture;
        },
        async createCategory() {
            if(this.isEdit){
                return await this.updateCategory()
            }
            if (this.$refs.picture) {
                    this.form.picture = this.$refs.picture.files[0]
            }
            var data = new FormData()
            data.append('name', this.form.name || '')
            data.append('picture', this.form.picture || '')
            data.append('priority', this.form.priority || '')
            data.append('enable', this.form.enable)

            await this.$inertia.post(route("storeCategory"), data)

            this.$inertia.replace(route("indexCategory"))
        },
        async updateCategory() {
            let updateImage = true
            if (this.$refs.picture && this.editPhotoPreview) {
               this.form.picture = this.$refs.picture.files[0]
            }else{
               updateImage = false
            }

            var data = new FormData()
            data.append('name', this.form.name)
            data.append('picture', this.form.picture)
            data.append('priority', this.form.priority)
            data.append('enable', this.form.enable)
            data.append('updateImage', updateImage)

            await this.$inertia.post(route("updateCategory", this.form.id), data)
        },
        updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };
                if(this.isEdit) this.editPhotoPreview = true
                reader.readAsDataURL(this.$refs.picture.files[0]);
        },
        selectNewPhoto() {
            this.$refs.picture.click();
        },
    }
};
</script>
