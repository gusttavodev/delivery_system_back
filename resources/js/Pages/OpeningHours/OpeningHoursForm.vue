<template>
    <form-layout @submitted="sendForm">
        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <div class="row" v-for="(input, key) in form.openingHour" :key="key">

                    <div class="col mt-4">
                        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{input.label}}
                        </h4>
                    </div>

                    <div class="col mt-4">
                        <jet-label value="Não Funciona" />
                         <label class="inline-flex items-center">
                            <input
                                v-model="input.not_open"
                                type="checkbox"
                                class="form-checkbox h-5 w-5 text-gray-600"
                                checked
                            />
                        </label>
                    </div>

                    <div class="col" v-show="!input.not_open">
                        <jet-label for="start_time" value="Inicio" />
                        <date-picker valueType="format" format="HH:mm" v-model="input.start_time" type="time"/>
                    </div>

                    <div class="col" v-show="!input.not_open">
                        <jet-label for="end_time" value="Fim" />
                        <date-picker valueType="format" format="HH:mm" v-model="input.end_time" type="time"/>
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

import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

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
        JetDangerButton,
        DatePicker
    },
    props: ["errors"],
    data() {
        return {
            form: this.$inertia.form(
                {
                    openingHour: this.$page.daysOfWeek,
                    establishment_id: this.$page.establishment.data.id
                },
                {
                    bag: "createOpeningHours",
                    resetOnSuccess: true
                }
            ),
        };
    },
    mounted() {
    },
    methods: {
        async sendForm() {
            const response = await this.form.post(route("storeEstablishmentOpeningHour"));
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
