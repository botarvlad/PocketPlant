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
                <div v-for="plant_data in plant_datas" :key="plant_data.id">
                  <p>{{plant_data}}</p>
                </div>
              </div>
          </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'

export default {
  components: {
    AppLayout
  },

    props: ['plant_datas']
}
</script>

<style>

</style>