<template>
    <Link :href="route('plants.view', plant.id)" class="group">
        <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
        <img src="https://images.unsplash.com/photo-1485955900006-10f4d324d411?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1172&q=80" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="w-full h-full object-center object-cover group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">
        {{ plant.name }}
        </h3>
        <p class="mt-1 text-lg font-medium text-gray-900">
        In good shape
        </p>
    </Link>
</template>

<script>
 import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        Link
    },

    props: ['plant']
}
</script>