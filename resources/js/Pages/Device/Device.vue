<template>
    <Link :href="route('devices.view', device.id)" class="group">
        <div
            class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8"
        >
            <img
                src="https://images.unsplash.com/photo-1631376604269-6f42b26fa9b7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1073&q=80"
            />
        </div>
        <h3 class="mt-4 text-sm text-gray-700">
            {{ device.mac_address }}
        </h3>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },

    props: ["device"],
};
</script>
