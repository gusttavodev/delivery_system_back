<template>
    <div>
        <input
            type="file"
            class="hidden"
            ref="component_picture_upload"
            accept="image/*"
            @change="change"
        />

        <jet-label for="picture" :value="label" />

        <div class="mt-2" v-show="photoPreview">
            <div v-if="isEdit && !editPhotoPreview">
                <img
                    id="old_image"
                    :src="getCategoryPhoto(defaultImageUrl)"
                    class="block rounded-full w-40 h-40"
                />
            </div>
            <div v-else>
                <span
                    class="block rounded-full w-40 h-40"
                    :style="
                        'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                            photoPreview +
                            '\');'
                    "
                >
                </span>
            </div>
        </div>

        <!-- <jet-secondary-button type="button" class="mt-2" @click.native.prevent="remove" v-if="photoPreview">
            Remover Foto
        </jet-secondary-button> -->

        <jet-secondary-button
            class="mt-2 mr-2"
            type="button"
            @click.native.prevent="selectNewPhoto"
        >
            Escolha uma Foto
        </jet-secondary-button>



        <jet-input-error :message="errors" class="mt-2" />
    </div>
</template>

<script>
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton
    },
    props: {
        value: {
            type: [File, String, Boolean]
        },
        label: {
            type: String,
            default: "Foto:"
        },

        isEdit: {
            type: Boolean,
            default: false
        },
        defaultImageUrl: {
            type: [File, String, Boolean],
            default: ""
        },

        errors: {
            type: Array
        }
    },
    watch: {
        value(value) {
            if (!value) {
                this.$refs.component_picture_upload.value = ''
            }
        }
    },
    data() {
        return {
            photoPreview: null,
            editPhotoPreview: false
        };
    },
    methods: {
       change(e) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            const eventFile = e.target.files[0]
            if(this.isEdit) this.editPhotoPreview = true
            reader.readAsDataURL(eventFile);

            // Emmit v-model default input event
            this.$emit('input',eventFile)
        },
        remove() {
            this.photoPreview = null
            this.$emit('input', null)
        },

        getCategoryPhoto(photoPath) {
            const host = window.location.host;
            const picture = `http://${host}/storage/${photoPath}`;
            this.photoPreview = true;
            return picture;
        },

        selectNewPhoto() {
            this.$refs.component_picture_upload.click();
        }
    }
};
</script>
