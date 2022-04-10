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
                        <h1 class="text-xl">
                            Plant Name:
                            <span class="text-base"> {{ plant.name }} </span>
                        </h1>
                        <h2>Plant Species: {{ plant.species }}</h2>
                        <p>Soil moist: {{ humidity_health }}</p>
                        <p :class="{ 'text-red-600': !device_attached }">
                            Device attached:
                            {{
                                device_attached
                                    ? device_attached.mac_address
                                    : "Nici un device atasat"
                            }}
                        </p>
                        <div>
                            Last time watered:
                            {{
                                plant_stats.last_time_watered
                                    ? plant_stats.last_time_watered.created_at
                                    : "No data yet"
                            }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button @click="send" class="rounded-md bg-gray-700">Click</button>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
    },

    props: [
        "plant_datas",
        "plant_care",
        "device_attached",
        "plant",
        "plant_stats",
    ],

    data() {
        return {};
    },
    computed: {
        mapped_humidity() {
            let last_val =
                this.plant_datas["plant_soil_records"][
                    this.plant_datas["plant_soil_records"].length - 1
                ];
            if (last_val) {
                let last_humidity_val = last_val.umid_sol;
                if (last_humidity_val >= 0 && last_humidity_val < 72)
                    return { soil: "dry", value: last_humidity_val };
                else if (last_humidity_val >= 72 && last_humidity_val < 88)
                    return { soil: "moist", value: last_humidity_val };
                else if (last_humidity_val >= 88 && last_humidity_val <= 100)
                    return { soil: "wet", value: last_humidity_val };
            } else {
                return "No data yet!";
            }
        },
        humidity_health() {
            const qwerty = this.convertSoilToValue(this.plant_care.water);
            if (typeof this.mapped_humidity === "object") {
                return this.mapped_humidity.soil === this.plant_care.water
                    ? "Good"
                    : this.mapped_humidity.value < qwerty[0]
                    ? "Too less water"
                    : "Too much water";
            } else {
                return "No data yet!";
            }
        },
    },
    methods: {
        convertSoilToValue(soil_type) {
            if (soil_type === "dry") return [0, 72];
            else if (soil_type === "moist") return [73, 88];
            else if (soil_type === "wet") return [89, 100];
        },
    },
};
</script>

<style scoped></style>
