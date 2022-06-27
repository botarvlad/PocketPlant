<template>
    <app-layout title="Update plant">
        <template #header>
            <header-content>
                <template #title>
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight"
                    >
                        Update {{ plant.name }}
                    </h2>
                </template>
            </header-content>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <div class="mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                        <div class="max-w-3xl mx-auto">
                            <div v-if="formPosition == 0">
                                <h2>Specia plantei</h2>
                                <v-select
                                    v-model="form.species"
                                    :options="plants"
                                    :reduce="(plant) => plant.name"
                                    label="name"
                                ></v-select>
                                <div
                                    class="text-red-500"
                                    v-if="$page.props.errors.species"
                                >
                                    {{ $page.props.errors.species }}
                                </div>
                            </div>
                            <div v-if="formPosition == 1">
                                <h2>Tipul ghiveciului</h2>
                                <v-select
                                    v-model="form.pot_type"
                                    :options="pot_types"
                                    label="pot_type"
                                ></v-select>
                                <div
                                    class="text-red-500"
                                    v-if="$page.props.errors.pot_type"
                                >
                                    {{ $page.props.errors.pot_type }}
                                </div>
                            </div>
                            <div v-if="formPosition == 2" class="flex flex-col">
                                <h2>Marimea ghiveciului</h2>
                                <label for="pot_size"
                                    >{{ form.pot_size }} cm</label
                                >
                                <input
                                    type="range"
                                    min="5"
                                    max="100"
                                    name="pot_size"
                                    step="2.5"
                                    v-model="form.pot_size"
                                />
                                <div
                                    class="text-red-500"
                                    v-if="$page.props.errors.pot_size"
                                >
                                    {{ $page.props.errors.pot_size }}
                                </div>
                            </div>
                            <div v-if="formPosition == 3">
                                <h2>Tipul solului</h2>
                                <v-select
                                    v-model="form.soil_type"
                                    :options="soil_types"
                                    label="soil_type"
                                ></v-select>
                                <div
                                    class="text-red-500"
                                    v-if="$page.props.errors.soil_type"
                                >
                                    {{ $page.props.errors.soil_type }}
                                </div>
                            </div>
                            <div v-if="formPosition == 4" class="flex flex-col">
                                <h2>Inaltimea plantei</h2>
                                <label for="height">{{ getPlantSize }}</label>
                                <input
                                    type="range"
                                    min="0"
                                    max="305"
                                    name="height"
                                    step="5"
                                    v-model="form.height"
                                />
                                <div
                                    class="text-red-500"
                                    v-if="$page.props.errors.height"
                                >
                                    {{ $page.props.errors.height }}
                                </div>
                            </div>
                            <div v-if="formPosition == 5">
                                <h2>Adauga o poza cu planta (skippable)</h2>
                                <DropZone
                                    ref="pictureInput"
                                    @drop.prevent="drop"
                                    @change="selectedFile"
                                />
                                <div class="file-info">
                                    File: {{ form.img ? form.img.name : "" }}
                                </div>
                            </div>
                            <div v-if="formPosition == 6">
                                <h2>Numele plantei</h2>
                                <input type="text" v-model="form.name" />
                                <div
                                    class="text-red-500"
                                    v-if="$page.props.errors.name"
                                >
                                    {{ $page.props.errors.name }}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-evenly mt-2">
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                v-if="formPosition !== 0"
                                @click="prevStep"
                            >
                                Prev
                            </button>
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                v-if="formPosition === 5"
                                @click="nextStep"
                            >
                                Skip
                            </button>
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                v-if="formPosition + 1 < 7"
                                @click="nextStep"
                            >
                                Next
                            </button>
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                v-if="formPosition + 1 === 7"
                                @click="submit"
                            >
                                Submit
                            </button>
                        </div>
                    </div>
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
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import DropZone from "../Components/DropZone.vue";

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
        DropZone,
    },
    props: ["plant", "plants"],
    data() {
        return {
            form: this.$inertia.form({
                name: this.plant.name,
                species: this.plant.species,
                pot_type: this.plant.pot_type,
                pot_size: this.plant.pot_size,
                soil_type: this.plant.soil_type,
                height: this.plant.height,
                img: this.plant.image_photo_path,
            }),
            formPosition: 0,
            pot_types: [
                "Platic pot",
                "Terracotta / Earthenware ceramic",
                "Glass pot",
                "Porcelain / Stoneware ceramic",
                "Peat pot",
                "Wood",
                "Concrete / Cement",
            ],
            soil_types: [
                "All purpose potting mix",
                "Seed starting mix",
                "Cactus & succulent soil",
                "Potting soil + extra drainage",
            ],
        };
    },
    computed: {
        getPlantSize() {
            if (this.form.height < 5) return "Less than 5 cm";
            else if (this.form.height >= 300) return "More than 300 cm";
            else return this.form.height + " cm";
        },
    },
    methods: {
        nextStep() {
            this.formPosition += 1;
        },
        prevStep() {
            this.formPosition -= 1;
        },

        submit() {
            this.form.post(route("plants.update", this.plant.id));
        },
        drop(e) {
            this.form.img = e.dataTransfer.files[0];
        },
        selectedFile() {
            this.form.img = document.querySelector(".dropzoneFile").files[0];
        },
    },
};
</script>

<style></style>
