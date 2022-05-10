<template>
    <app-layout title="My Plants">
        <template #header>
            <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Plants
            </h2> -->
            <header-content>
                <template #title>
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight"
                    >
                        {{ plant.name }}
                    </h2>
                </template>
                <template #actions v-if="$page.props.user">
                    <action-button
                        :link="route('plants.destroy', plant.id)"
                        name="Delete Plant"
                        icon="plus-circle"
                        method="delete"
                    />
                </template>
            </header-content>
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
                        <h3 class="mt-4">Humidity records</h3>
                        <div
                            class="flex"
                            v-for="humid_data in returnHumidDataPage"
                            :key="humid_data.id"
                        >
                            {{
                                moment(humid_data.created_at).format(
                                    "DD-MM-YYYY"
                                )
                            }}
                            {{
                                moment(humid_data.created_at).format("h:mm:ss")
                            }}
                            /
                            {{ humid_data.umid_sol }}
                        </div>
                        <div class="flex">
                            <button
                                class="bg-gray-700 text-white mr-6"
                                @click="humidPrevPage"
                            >
                                &lt
                            </button>
                            <button
                                class="bg-gray-700 text-white"
                                @click="humidNextPage"
                            >
                                >
                            </button>
                        </div>
                        <h3 class="mt-4">Temp records</h3>
                        <div
                            class="flex"
                            v-for="temp_data in returnTempDataPage"
                            :key="temp_data.id"
                        >
                            {{
                                moment(temp_data.created_at).format(
                                    "DD-MM-YYYY"
                                )
                            }}
                            {{ moment(temp_data.created_at).format("h:mm:ss") }}
                            /
                            {{ temp_data.temp }}
                        </div>
                        <div class="flex">
                            <button
                                class="bg-gray-700 text-white mr-6"
                                @click="tempPrevPage"
                            >
                                &lt
                            </button>
                            <button
                                class="bg-gray-700 text-white"
                                @click="tempNextPage"
                            >
                                >
                            </button>
                        </div>
                        <h3 class="mt-4">Air records</h3>
                        <div
                            class="flex"
                            v-for="air_data in returnAirDataPage"
                            :key="air_data.id"
                        >
                            {{
                                moment(air_data.created_at).format("DD-MM-YYYY")
                            }}
                            {{ moment(air_data.created_at).format("h:mm:ss") }}
                            /
                            {{ air_data.umid_atm }}
                        </div>
                        <div class="flex">
                            <button
                                class="bg-gray-700 text-white mr-6"
                                @click="airPrevPage"
                            >
                                &lt
                            </button>
                            <button
                                class="bg-gray-700 text-white"
                                @click="airNextPage"
                            >
                                >
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
import HeaderContent from "../../Components/HeaderContent.vue";
import ActionButton from "../../Components/Button.vue";
import TableLite from "vue3-table-lite";
import moment from "moment";
//! Formateaza Data din tabele si fa pagination

export default {
    components: {
        AppLayout,
        HeaderContent,
        ActionButton,
        TableLite,
    },

    props: [
        "plant_datas",
        "plant_care",
        "device_attached",
        "plant",
        "plant_stats",
    ],

    data() {
        return {
            moment: moment,
            tableRows: 10,
            humidPagesNo: 0,
            airPagesNo: 0,
            tempPagesNo: 0,
            humidCurrentPage: 1,
            airCurrentPage: 1,
            tempCurrentPage: 1,
        };
    },
    computed: {
        humidDataPages() {
            const chunkedData = [];
            for (
                let i = 0;
                i < this.plant_datas.plant_soil_records.length;
                i += this.tableRows
            ) {
                const chunk = this.plant_datas.plant_soil_records.slice(
                    i,
                    i + this.tableRows
                );
                console.log(chunk);
                this.humidPagesNo++;
                chunkedData.push(chunk);
            }
            return chunkedData;
        },
        airDataPages() {
            const chunkedData = [];
            for (
                let i = 0;
                i < this.plant_datas.plant_air_records.length;
                i += this.tableRows
            ) {
                const chunk = this.plant_datas.plant_air_records.slice(
                    i,
                    i + this.tableRows
                );
                console.log(chunk);
                this.airPagesNo++;
                chunkedData.push(chunk);
            }
            return chunkedData;
        },
        tempDataPages() {
            const chunkedData = [];
            for (
                let i = 0;
                i < this.plant_datas.plant_temp_records.length;
                i += this.tableRows
            ) {
                const chunk = this.plant_datas.plant_temp_records.slice(
                    i,
                    i + this.tableRows
                );
                console.log(chunk);
                this.tempPagesNo++;
                chunkedData.push(chunk);
            }
            return chunkedData;
        },
        returnHumidDataPage() {
            return this.humidDataPages[this.humidCurrentPage - 1];
        },
        returnAirDataPage() {
            return this.airDataPages[this.airCurrentPage - 1];
        },
        returnTempDataPage() {
            return this.tempDataPages[this.tempCurrentPage - 1];
        },
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
        humidPrevPage() {
            if (this.humidCurrentPage === 1) {
                return;
            }
            this.humidCurrentPage--;
        },
        humidNextPage() {
            if (this.humidCurrentPage === this.humidPagesNo) {
                return;
            }
            this.humidCurrentPage++;
        },
        airPrevPage() {
            if (this.airCurrentPage === 1) {
                return;
            }
            this.airCurrentPage--;
        },
        airNextPage() {
            if (this.airCurrentPage === this.airPagesNo) {
                return;
            }
            this.airCurrentPage++;
        },
        tempPrevPage() {
            if (this.tempCurrentPage === 1) {
                return;
            }
            this.tempCurrentPage--;
        },
        tempNextPage() {
            if (this.tempCurrentPage === this.tempPagesNo) {
                return;
            }
            this.tempCurrentPage++;
        },
    },
};
</script>

<style scoped></style>
