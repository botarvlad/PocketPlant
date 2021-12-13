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
            <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <jet-label for="species" value="Species" />
                <jet-input id="species" type="text" class="mt-1 block w-full" v-model="form.species" required />
            </div>

            <select v-model="form.device">
                <option disabled value="">Select one</option>
                <option v-for="device in devices" :key="device.id" :value="device.mac_address">{{device.mac_address}}</option>
            </select>

            <div class="flex items-center justify-end mt-4">
                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Add plant
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import HeaderContent from '../../Components/HeaderContent.vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        AppLayout,
        HeaderContent,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        Head,Link,JetValidationErrors,JetLabel,JetCheckbox,JetInput,JetButton
    },
    props: ['devices'],
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                species: '',
                device: ''
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('plants.store', 1))
        }
    }
}
</script>

<style>

</style>