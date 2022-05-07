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
                        <table-lite
                            :is-loading="soilTable.isLoading"
                            :columns="soilTable.columns"
                            :rows="soilTable.rows"
                            :total="soilTable.totalRecordCount"
                            :sortable="soilTable.sortable"
                            @is-finished="soilTable.isLoading = false"
                        />
                        <h3 class="mt-4">Humidity records</h3>
                        <table-lite
                            :is-loading="tempTable.isLoading"
                            :columns="tempTable.columns"
                            :rows="tempTable.rows"
                            :total="tempTable.totalRecordCount"
                            :sortable="tempTable.sortable"
                            @is-finished="tempTable.isLoading = false"
                        />
                        <h3 class="mt-4">Humidity records</h3>
                        <table-lite
                            :is-loading="airTable.isLoading"
                            :columns="airTable.columns"
                            :rows="airTable.rows"
                            :total="airTable.totalRecordCount"
                            :sortable="airTable.sortable"
                            @is-finished="airTable.isLoading = false"
                        />
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
            soilTable: {
                isLoading: false,
                columns: [
                    {
                        label: "Date",
                        field: "created_at",
                        width: "1%",
                        sortable: true,
                        isKey: true,
                    },
                    {
                        label: "Umiditate Sol",
                        field: "umid_sol",
                        width: "2%",
                        sortable: true,
                    },
                ],
                rows: this.plant_datas.plant_soil_records,
                totalRecordCount: 0,
                pageSize: 2,
                sortable: {
                    order: "id",
                    sort: "asc",
                },
            },
            tempTable: {
                isLoading: false,
                columns: [
                    {
                        label: "Date",
                        field: "created_at",
                        width: "1%",
                        sortable: true,
                        isKey: true,
                    },
                    {
                        label: "Temperatura Camera",
                        field: "temp",
                        width: "2%",
                        sortable: true,
                    },
                ],
                rows: this.plant_datas.plant_temp_records,
                totalRecordCount: 0,
                pageSize: 2,
                sortable: {
                    order: "id",
                    sort: "asc",
                },
            },
            airTable: {
                isLoading: false,
                columns: [
                    {
                        label: "Date",
                        field: "created_at",
                        width: "1%",
                        sortable: true,
                        isKey: true,
                    },
                    {
                        label: "Umiditate Aer",
                        field: "umid_atm",
                        width: "2%",
                        sortable: true,
                    },
                ],
                rows: this.plant_datas.plant_air_records,
                totalRecordCount: 0,
                pageSize: 2,
                sortable: {
                    order: "id",
                    sort: "asc",
                },
            },
        };
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
