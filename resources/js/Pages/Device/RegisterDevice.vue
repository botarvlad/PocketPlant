<template>
  <app-layout title="Register Device">
        <template #header>
            <header-content>
                <template #title>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Register device</h2>
                </template>
            </header-content>
        </template>

        <div class="py-12">
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                            <div v-if="new_devices">
                                <div v-for="new_device in new_devices" :key="new_device.id">
                                    <!-- <action-button :link="route('devices.claim', new_device.id)" :name="'Claim ' + new_device.mac_address" icon="plus-circle" /> -->
                                    <button @click="claim(new_device.mac_address)">Claim {{new_device.mac_address}}</button>
                                    <h2 class="text-green-500" v-if="new_device.claimed == 1">Claimed!</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import HeaderContent from '../../Components/HeaderContent.vue'
import ActionButton from '../../Components/Button.vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        AppLayout,
        HeaderContent,
        ActionButton,
        Inertia
    },
    props: ['new_devices'],
    methods: {
        claim(id) {
            console.log(id);
            Inertia.patch(route('devices.claim', id));
        }
    }
}
</script>

<style>

</style>