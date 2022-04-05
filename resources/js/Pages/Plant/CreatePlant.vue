<template>
    <app-layout title="Add plant">
        <template #header>
            <header-content>
                <template #title>
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight"
                    >
                        Add plant
                    </h2>
                </template>
            </header-content>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto">
                    <div v-if="formPosition == 0">
                        <h2>Aici alegi planta</h2>
                        <v-select
                            v-model="form.species"
                            :options="plants"
                            :reduce="(plant) => plant.name"
                            label="name"
                        ></v-select>
                    </div>
                    <div v-if="formPosition == 1">
                        <h2>Ce tip de ghiveci are</h2>
                    </div>
                    <div v-if="formPosition == 2">
                        <h2>Marimea ghiveciului</h2>
                    </div>
                    <div v-if="formPosition == 3">
                        <h2>Tipul solului</h2>
                    </div>
                    <div v-if="formPosition == 4">
                        <h2>Marimea plantei</h2>
                    </div>
                    <div v-if="formPosition == 5">
                        <h2>Adauga o poza cu planta (skippable)</h2>
                    </div>
                    <div v-if="formPosition == 6">
                        <h2>Numele plantei</h2>
                        <input type="text" v-model="form.name" />
                    </div>
                </div>
                <div class="flex justify-evenly">
                    <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        v-if="formPosition !== 0"
                        @click="prevStep"
                    >
                        Prev
                    </button>
                    <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        v-if="formPosition === 5"
                        @click="nextStep"
                    >
                        Skip
                    </button>
                    <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        v-if="formPosition + 1 < 7"
                        @click="nextStep"
                    >
                        Next
                    </button>
                    <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        v-if="formPosition + 1 === 7"
                        @click="submit"
                    >
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
// ! Cand adaugi o planta noua mai intai trebe sa alegi in ce camera va sta;
import AppLayout from "@/Layouts/AppLayout.vue";
import HeaderContent from "../../Components/HeaderContent.vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import Vue from "vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
    components: {
        AppLayout,
        HeaderContent,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        Head,
        Link,
        JetValidationErrors,
        JetLabel,
        JetCheckbox,
        JetInput,
        ChevronLeftIcon,
        ChevronRightIcon,
        JetButton,
        vSelect,
    },
    props: ["devices", "plants"],
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                species: "",
            }),
            formPosition: 0,
        };
    },
    methods: {
        nextStep() {
            this.formPosition += 1;
        },
        prevStep() {
            this.formPosition -= 1;
        },

        submit() {
            this.form.post(route("plants.store"));
        },
    },
};
</script>

<style></style>
