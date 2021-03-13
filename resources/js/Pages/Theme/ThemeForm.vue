<template>
    <form-layout @submitted="sendForm">
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
                <h2 class="font-semibold text-xl text-gray-800">
                    Página
                </h2>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label for="primary_color" value="Primaria" />
                        <div class="row">
                            <jet-input
                                id="primary_color"
                                type="text"
                                class="col-8"
                                v-model="form.primary_color"
                                autofocus
                            />
                            <verte  v-model="form.primary_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.primary_color" class="mt-2" />
                    </div>
                   <div class="col">
                        <jet-label for="secondary_color" value="Secundaria" />
                        <div class="row">
                            <jet-input
                                id="secondary_color"
                                type="text"
                                class="col-8"
                                v-model="form.secondary_color"
                                autofocus
                            />
                            <verte v-model="form.secondary_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.secondary_color" class="mt-2" />
                    </div>

                      <div class="col">
                        <jet-label for="background_color" value="Cor de fundo" />
                        <div class="row">
                            <jet-input
                                id="background_color"
                                type="text"
                                class="col-8"
                                v-model="form.background_color"
                                autofocus
                            />
                            <verte v-model="form.background_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.background_color" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <h2 class="font-semibold text-xl text-gray-800">
                    Textos
                </h2>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label for="text_color" value="Texto Geral" />
                        <div class="row">
                            <jet-input
                                id="text_color"
                                type="text"
                                class="col-8"
                                v-model="form.text_color"
                                autofocus
                            />
                            <verte  v-model="form.text_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.text_color" class="mt-2" />
                    </div>
                   <div class="col">
                        <jet-label for="title_text_color" value="Títulos" />
                        <div class="row">
                            <jet-input
                                id="title_text_color"
                                type="text"
                                class="col-8"
                                v-model="form.title_text_color"
                                autofocus
                            />
                            <verte v-model="form.title_text_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.title_text_color" class="mt-2" />
                    </div>

                      <div class="col">
                        <jet-label for="title_text_hover_color" value="Efeito Títulos" />
                        <div class="row">
                            <jet-input
                                id="title_text_hover_color"
                                type="text"
                                class="col-8"
                                v-model="form.title_text_hover_color"
                                autofocus
                            />
                            <verte v-model="form.title_text_hover_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.title_text_hover_color" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <h2 class="font-semibold text-xl text-gray-800">
                    Produto
                </h2>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label for="card_background_color" value="Cor de Fundo" />
                        <div class="row">
                            <jet-input
                                id="card_background_color"
                                type="text"
                                class="col-8"
                                v-model="form.card_background_color"
                                autofocus
                            />
                            <verte  v-model="form.card_background_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.card_background_color" class="mt-2" />
                    </div>
                   <div class="col">
                        <jet-label for="card_text_color" value="Texto do Nome" />
                        <div class="row">
                            <jet-input
                                id="card_text_color"
                                type="text"
                                class="col-8"
                                v-model="form.card_text_color"
                                autofocus
                            />
                            <verte v-model="form.card_text_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.card_text_color" class="mt-2" />
                    </div>

                      <div class="col">
                        <jet-label for="card_price_color" value="Texto do Preço" />
                        <div class="row">
                            <jet-input
                                id="card_price_color"
                                type="text"
                                class="col-8"
                                v-model="form.card_price_color"
                                autofocus
                            />
                            <verte v-model="form.card_price_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.card_price_color" class="mt-2" />
                    </div>
                </div>
            </div>

             <div class="col-span-6 sm:col-span-4">
                <h2 class="font-semibold text-xl text-gray-800">
                    Carrinho de Compras
                </h2>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="row">
                    <div class="col">
                        <jet-label for="button_background_color" value="Cor de fundo" />
                        <div class="row">
                            <jet-input
                                id="button_background_color"
                                type="text"
                                class="col-8"
                                v-model="form.button_background_color"
                                autofocus
                            />
                            <verte  v-model="form.button_background_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.button_background_color" class="mt-2" />
                    </div>
                    <div class="col">
                        <jet-label for="button_hover_color" value="Efeito" />
                        <div class="row">
                            <jet-input
                                id="button_hover_color"
                                type="text"
                                class="col-8"
                                v-model="form.button_hover_color"
                                autofocus
                            />
                            <verte  v-model="form.button_hover_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.button_hover_color" class="mt-2" />
                    </div>
                   <div class="col">
                        <jet-label for="button_text_color" value="Texto" />
                        <div class="row">
                            <jet-input
                                id="button_text_color"
                                type="text"
                                class="col-8"
                                v-model="form.button_text_color"
                                autofocus
                            />
                            <verte v-model="form.button_text_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.button_text_color" class="mt-2" />
                    </div>

                      <div class="col">
                        <jet-label for="button_count_color" value="Quantidadede produtos" />
                        <div class="row">
                            <jet-input
                                id="button_count_color"
                                type="text"
                                class="col-8"
                                v-model="form.button_count_color"
                                autofocus
                            />
                            <verte v-model="form.button_count_color" picker="square" model="hex" class="col pt-2" menuPosition="center">
                                 <svg width="400" height="110">
                                    <rect width="300" height="100"/>
                                 </svg>
                            </verte>
                        </div>
                        <jet-input-error :message="$page.errors.button_count_color" class="mt-2" />
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
import { ColourPicker } from 'vue-colour-picker'

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
        'colour-picker': ColourPicker
    },
     props: {
        isEdit: {
            default: false
        },
        theme: {
            type: Object,
            required: false,
            default: () => {
                return {
                    name: "",
                    primary_color: "",
                    secondary_color: "",
                    background_color: "",

                    text_color: "",
                    title_text_color: "",
                    title_text_hover_color: "",

                    button_background_color: "",
                    button_hover_color: "",
                    button_text_color: "",
                    button_count_color: "",

                    card_background_color: "",
                    card_text_color: "",
                    card_price_color: ""
                }
            },
        },
    },
    data() {
        return {
            form: this.$inertia.form(
                {
                    name: "",
                    primary_color: "",
                    secondary_color: "",
                    background_color: "",

                    text_color: "",
                    title_text_color: "",
                    title_text_hover_color: "",

                    button_background_color: "",
                    button_hover_color: "",
                    button_text_color: "",
                    button_count_color: "",

                    card_background_color: "",
                    card_text_color: "",
                    card_price_color: ""
                },
                {
                    bag: "createTheme",
                    resetOnSuccess: false
                }
            )
        };
    },
    mounted() {
        if(this.isEdit){
            const data = this.theme.data
            this.form.name = data.name
            this.form.primary_color = data.primary_color
            this.form.secondary_color = data.secondary_color
            this.form.background_color = data.background_color

            this.form.text_color = data.text_color
            this.form.title_text_color = data.title_text_color
            this.form.title_text_hover_color = data.title_text_hover_color

            this.form.button_background_color = data.button_background_color
            this.form.button_count_color = data.button_count_color
            this.form.button_hover_color = data.button_hover_color
            this.form.button_text_color = data.button_text_color

            this.form.card_background_color = data.card_background_color
            this.form.card_price_color = data.card_price_color
            this.form.card_text_color = data.card_text_color
        }
    },
    methods: {
        async sendForm() {
            if(this.isEdit) {
                await this.sendUpdate()
            }else {
                await this.sendStore()
            }
        },
        async sendStore() {
            await this.form.post(route("storeTheme"), {
                onFinish: () => {
                    this.$inertia.replace(route("indexTheme"))
                }
            });
        },
        async sendUpdate() {
            await this.form.post(route("updateTheme", this.theme.data.id), {
                onFinish: () => {
                    this.$notify({
                        group: "app",
                        title: "Tema Atualizado",
                        text: "Tema Atualizado Com sucesso",
                        type: "success"
                    });
                }
            });
        },
    }
};
</script>
