<template>
    <form-layout @submitted="createCategory">
        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <p class="text-sm">{{ $page.flash.message }}</p>
            </div>
            <div class="col-span-6 sm:col-span-4">
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

            <div class="col-span-6 sm:col-span-4">
                <input type="file" class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview">

                <jet-label for="photo" value="Photo" />

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-40 h-40"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Escolha uma Foto
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto" v-if="form.photo">
                    Remover Foto
                </jet-secondary-button>

                <jet-input-error :message="$page.errors.photo" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="priority" value="Prioridade" />
                <jet-input
                    id="priority"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.priority"
                />
                <jet-input-error :message="$page.errors.priority" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Habilitado" />
                <label class="inline-flex items-center mt-3">
                    <input v-model="form.enable" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" checked><span class="ml-2 text-gray-700">Sim</span>
                 </label>
                <jet-input-error :message="$page.errors.enable" class="mt-2" />
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

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        FormLayout,
        JetSecondaryButton
    },
    props: ['errors'],
    data() {
        return {
            // form: this.$inertia.form(
            //     {
            //         name: "",
            //         photo: "",
            //         priority: "",
            //         enable: true
            //     },
            //     {
            //         bag: "storeCategory",
            //         resetOnSuccess: true
            //     }
            // ),
            form: {
                name: "",
                photo: "",
                priority: "",
                enable: true
            },

            photoPreview: null
        };
    },

    methods: {
        createCategory() {
            if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
            }
            var data = new FormData()
            data.append('name', this.form.name || '')
            data.append('photo', this.form.photo || '')
            data.append('priority', this.form.priority || '')
            data.append('enable', this.form.enable)

            this.$inertia.post(route("storeCategory"), data)
            // this.form.post(route("storeCategory"), {
            //     preserveScroll: true
            // });
        },
        updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
        },
        selectNewPhoto() {
            this.$refs.photo.click();
        },
    }
};
</script>
