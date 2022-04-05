<template>
    <app-layout title="My Plants">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Plants
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                        <h1>{{ plant.name }}</h1>
                        <p>Soil moist: {{ humidity_health }}</p>
                    </div>
                </div>
            </div>
        </div>
        <button @click="send" class="rounded-md bg-gray-700">Click</button>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";

export default {
    components: {
        AppLayout,
    },

    props: ["plant_datas", "plant_care", "device_attached", "plant"],

    data() {
        return {};
    },
    computed: {
        mapped_humidity() {
            let last_val = this.plant_datas[this.plant_datas.length - 1];
            let last_humidity_val = last_val.umid_sol;
            if (last_humidity_val >= 0 && last_humidity_val < 45) return "dry";
            else if (last_humidity_val >= 45 && last_humidity_val < 75)
                return "moist";
            else if (last_humidity_val >= 75 && last_humidity_val <= 100)
                return "wet";
        },
        humidity_health() {
            return this.mapped_humidity === this.plant_care.water
                ? "Good"
                : "Bad :(((((";
        },
    },
};
</script>

<style></style>
