<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4"
                >
                    <p>
                        You have in total
                        <span>{{ plants.length }}</span> plants.
                    </p>
                    <div>
                        <p>The following plants need your attention:</p>
                        <div v-for="plant in plants" :key="plant.id">
                            <p>{{ plant.name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
    },
    props: ["plants", "plants_datas", "plants_care"],
    computed: {
        mapped_humidity() {
            // let last_val =
            //     this.plants_datas["plants_soil_records"][
            //         this.plants_datas["plants_soil_records"].length - 1
            //     ];
            let last_vals = [];
            this.plants_datas["plants_soil_records"].forEach(
                (plant_soil_records) => {
                    last_vals.push(plant_soil_records.at(-1));
                }
            );

            let array_to_return = [];

            last_vals.forEach((last_val) => {
                if (last_val) {
                    let last_humidity_val = last_val.umid_sol;
                    if (last_humidity_val >= 0 && last_humidity_val < 72)
                        array_to_return.push({
                            soil: "dry",
                            value: last_humidity_val,
                        });
                    else if (last_humidity_val >= 72 && last_humidity_val < 88)
                        array_to_return.push({
                            soil: "moist",
                            value: last_humidity_val,
                        });
                    else if (
                        last_humidity_val >= 88 &&
                        last_humidity_val <= 100
                    )
                        array_to_return.push({
                            soil: "wet",
                            value: last_humidity_val,
                        });
                } else {
                    array_to_return.push("No data yet!");
                }
            });

            return array_to_return;
        },
        humidity_health() {
            // const qwerty = this.convertSoilToValue(this.plant_care.water);
            let qwertys = [];
            this.plants_care.forEach((plant_care) => {
                qwertys.push(this.convertSoilToValue(plant_care.water));
            });
            // if (typeof this.mapped_humidity === "object") {
            //     return this.mapped_humidity.soil === this.plant_care.water
            //         ? "Good"
            //         : this.mapped_humidity.value < qwerty[0]
            //         ? "Too less water"
            //         : "Too much water";
            // } else {
            //     return "No data yet!";
            // }

            return qwertys;
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
