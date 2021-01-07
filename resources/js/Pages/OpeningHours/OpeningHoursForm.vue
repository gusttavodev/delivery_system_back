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
                        <jet-input-error :message="input.start_time_error" />
                    </div>

                    <div class="col" v-show="!input.not_open">
                        <jet-label for="end_time" value="Fim" />
                        <date-picker valueType="format" format="HH:mm" v-model="input.end_time" type="time"/>
                        <jet-input-error :message="input.end_time_error" />
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
                    openingHour: this.$page.establishment.data.opening_hours.length > 5 ? this.$page.establishment.data.opening_hours : this.$page.daysOfWeek,
                    establishment_id: this.$page.establishment.data.id
                },
                {
                    bag: "createOpeningHours",
                    resetOnSuccess: false
                }
            ),
        };
    },
    created() {

    },
    methods: {
        validate() {
            const required = "Preencha este campo"
            const mustBeBigger = "Precisa ser maior que o inicio"
            this.form.openingHour.forEach(element => {
                if(!element.not_open){
                    //Required
                    if(element.start_time == null){
                        element.start_time_error = required
                    }else{
                        element.start_time_error = null
                    }

                    if(element.end_time == null){
                        element.end_time_error = required
                    }else{
                        element.end_time_error = null
                        //MustBeBigger
                        if(element.start_time != null){
                            const startTime = new Date(`01/01/1970 ${element.start_time}`);
                            const endTime = new Date(`01/01/1970 ${element.end_time}`);
                            const timeDiff = endTime.getTime() - startTime.getTime()
                            if(timeDiff < 0){
                                element.end_time_error = mustBeBigger
                            } else{
                                element.end_time_error = null
                            }

                        }
                    }
                }else {
                    element.start_time_error = null
                    element.end_time_error = null
                }
            });

            let valid = true
            this.form.openingHour.forEach(element => {
                if(element.start_time_error !== null || element.end_time_error !== null ){
                    valid = false
                }
            })

            return valid
        },
        async sendForm() {
            if(this.validate()){
                const response = await this.form.post(route("storeEstablishmentOpeningHour"), {
                    onFinish: () => {
                        this.$notify({
                            group: "app",
                            title: "Horarios Atualizados",
                            text: "Seus horarios foram atualizados com sucesso!!",
                            type: "success"
                        });
                    }
                });
            }
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
