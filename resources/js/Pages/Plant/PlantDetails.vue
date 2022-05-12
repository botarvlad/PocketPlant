<template>
    <app-layout title="My Plants">
        <template #header>
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
                        :link="route('plants.edit', plant.id)"
                        name="Edit Plant"
                        icon="plus-circle"
                        method="get"
                    />
                    <action-button
                        :link="route('plants.destroy', plant.id)"
                        name="Delete Plant"
                        icon="plus-circle"
                        method="delete"
                    />
                </template>
            </header-content>
        </template>

        <div class="py-12 bg-opacity-40">
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
                        <div class="mb-6">
                            Last time watered:
                            {{
                                plant_stats.last_time_watered
                                    ? plant_stats.last_time_watered.created_at
                                    : "No data yet"
                            }}
                        </div>
                        <div>
                            <h2 class="text-2xl mb-4">Istoric Umiditate:</h2>
                            <div class="grid grid-cols-3 text-xl pl-4">
                                <div>Data</div>
                                <div>Ora</div>
                                <div>Umiditatea solului</div>
                            </div>
                            <div
                                v-for="humid_data in returnHumidDataPage"
                                :key="humid_data.id"
                                class="grid grid-cols-3 border-t-2"
                            >
                                <div class="text-xl py-2 px-4">
                                    {{
                                        moment(humid_data.created_at).format(
                                            "DD-MM-YYYY"
                                        )
                                    }}
                                </div>
                                <div class="text-xl py-2 px-4">
                                    {{
                                        moment(humid_data.created_at).format(
                                            "h:mm:ss"
                                        )
                                    }}
                                </div>
                                <div class="text-xl py-2 px-4">
                                    {{ humid_data.umid_sol }} %
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-4">
                                <button
                                    class="px-6 py-2 rounded-md bg-green-600 font-extrabold text-white"
                                    @click="humidPrevPage"
                                >
                                    &lt
                                </button>
                                <div>
                                    {{ humidCurrentPage }} of {{ humidPagesNo }}
                                </div>
                                <button
                                    class="px-6 py-2 rounded-md bg-green-600 font-extrabold text-white"
                                    @click="humidNextPage"
                                >
                                    >
                                </button>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl mb-4">Istoric Temperatura:</h2>
                            <div class="grid grid-cols-3 text-xl pl-4">
                                <div>Data</div>
                                <div>Ora</div>
                                <div>Temperatura camerei</div>
                            </div>
                            <div
                                v-for="temp_data in returnTempDataPage"
                                :key="temp_data.id"
                                class="grid grid-cols-3 border-t-2"
                            >
                                <div class="text-xl py-2 px-4">
                                    {{
                                        moment(temp_data.created_at).format(
                                            "DD-MM-YYYY"
                                        )
                                    }}
                                </div>
                                <div class="text-xl py-2 px-4">
                                    {{
                                        moment(temp_data.created_at).format(
                                            "h:mm:ss"
                                        )
                                    }}
                                </div>
                                <div class="text-xl py-2 px-4">
                                    {{ temp_data.temp }}
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-4">
                                <button
                                    class="px-6 py-2 rounded-md bg-green-600 font-extrabold text-white"
                                    @click="tempPrevPage"
                                >
                                    &lt
                                </button>
                                <div>
                                    {{ tempCurrentPage }} of {{ tempPagesNo }}
                                </div>
                                <button
                                    class="px-6 py-2 rounded-md bg-green-600 font-extrabold text-white"
                                    @click="tempNextPage"
                                >
                                    >
                                </button>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl mb-4">
                                Istoric Umiditate Camera:
                            </h2>
                            <div class="grid grid-cols-3 text-xl pl-4">
                                <div>Data</div>
                                <div>Ora</div>
                                <div>Umiditatea camerei</div>
                            </div>
                            <div
                                v-for="air_data in returnAirDataPage"
                                :key="air_data.id"
                                class="grid grid-cols-3 border-t-2"
                            >
                                <div class="text-xl py-2 px-4">
                                    {{
                                        moment(air_data.created_at).format(
                                            "DD-MM-YYYY"
                                        )
                                    }}
                                </div>
                                <div class="text-xl py-2 px-4">
                                    {{
                                        moment(air_data.created_at).format(
                                            "h:mm:ss"
                                        )
                                    }}
                                </div>
                                <div class="text-xl py-2 px-4">
                                    {{ air_data.umid_atm }}
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-4">
                                <button
                                    class="px-6 py-2 rounded-md bg-green-600 font-extrabold text-white"
                                    @click="airPrevPage"
                                >
                                    &lt
                                </button>
                                <div>
                                    {{ airCurrentPage }} of {{ airPagesNo }}
                                </div>
                                <button
                                    class="px-6 py-2 rounded-md bg-green-600 font-extrabold text-white"
                                    @click="airNextPage"
                                >
                                    >
                                </button>
                            </div>
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
