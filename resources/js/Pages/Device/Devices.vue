<template>
  <app-layout title="My Devices">
        <template #header>
            <header-content>
                <template #title>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Devices</h2>
                </template>
                <template #actions v-if="$page.props.user">
                    <action-button :link="route('devices.add')" name="Add new device" icon="plus-circle" />
                </template>
            </header-content>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                            <div v-if="devices">
                                <div v-for="device in devices" :key=device.id>
                                    <device :device="device" />
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
import Device from '../Device/Device.vue'
import HeaderContent from '../../Components/HeaderContent.vue'
import ActionButton from '../../Components/Button.vue'

export default {
    components: {
        AppLayout,
        Device,
        HeaderContent,
        ActionButton
    },

    props: ['devices']
}
</script>