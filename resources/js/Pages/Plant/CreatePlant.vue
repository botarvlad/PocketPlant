<template>
  <app-layout title="Add plant">
        <template #header>
            <header-content>
                <template #title>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add plant</h2>
                </template>
            </header-content>
        </template>

        <div class="py-12">
            
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import HeaderContent from '../../Components/HeaderContent.vue'

export default {
    components: {
        AppLayout,
        HeaderContent
    }
}
</script>

<style>

</style>