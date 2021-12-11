<template>
  <app-layout title="My Plants">
        <template #header>
            <header-content>
                <template #title>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Plants</h2>
                </template>
                <template #actions v-if="$page.props.user">
                    <action-button :link="route('plants.add')" icon="plus-circle" />
                </template>
            </header-content>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                            <div v-for="plant in plants" :key=plant.id>
                                <plant :plant="plant" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Plant from '../Plant/Plant.vue'
import HeaderContent from '../../Components/HeaderContent.vue'
import ActionButton from '../../Components/Button.vue'

export default defineComponent({
    components: {
        AppLayout,
        Plant,
        HeaderContent,
        ActionButton
    },

    props: ['plants']
})
</script>

<style>

</style>