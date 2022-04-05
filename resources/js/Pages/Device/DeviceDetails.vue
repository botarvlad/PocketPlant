<template>
    <app-layout title="My Devices">
        <template #header>
            <header-content>
                <template #title>
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight"
                    >
                        My Devices
                    </h2>
                </template>
                <template #actions v-if="$page.props.user"> </template>
            </header-content>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                        <div
                            class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
                        >
                            <p>MAC-ul device-ului: {{ device.mac_address }}</p>
                            <p>Planta in care sta: {{ plant_host.name }}</p>
                            <v-select
                                v-model="form.plant_host"
                                :options="plants"
                                label="name"
                            ></v-select>
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
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
import AppLayout from "@/Layouts/AppLayout.vue";
import Device from "../Device/Device.vue";
import HeaderContent from "../../Components/HeaderContent.vue";
import ActionButton from "../../Components/Button.vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
    components: {
        AppLayout,
        Device,
        HeaderContent,
        ActionButton,
        vSelect,
    },
    props: ["device", "plant_host", "plants"],

    data() {
        return {
            form: this.$inertia.form({
                device_id: this.device.id,
                plant_host: this.plant_host,
            }),
        };
    },

    methods: {
        submit() {
            this.form.patch("/devices/switch_plant", {
                preserveScroll: true,
            });
        },
    },
};
</script>

<style></style>
