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
    props: ["plants"],
};
</script>
