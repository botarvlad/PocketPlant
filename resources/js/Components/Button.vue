<template>
    <span class="sm:block shadow-sm rounded-md">
        <template v-if="link">
            <Link
                :href="link"
                :method="method"
                as="button"
                :class="`bg-${bg} cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-${color}-700 hover:text-${color}-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-${color}-800 active:bg-${
                    bg.split('-')[0]
                }-700 transition duration-150 ease-in-out`"
            >
                <icon
                    :type="icon"
                    iconClass="flex-shrink-0 mx-1.5 h-4 w-4 ml-0"
                />
                {{ name }}
            </Link>
        </template>
        <template v-else>
            <div
                @click="$emit('click')"
                :class="`bg-${bg} cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-${color}-700 hover:text-${color}-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-${color}-800 active:bg-${
                    bg.split('-')[0]
                }-700 transition duration-150 ease-in-out`"
            >
                <icon
                    :type="icon"
                    iconClass="flex-shrink-0 mx-1.5 h-4 w-4 ml-0"
                />
                {{ name }}
            </div>
        </template>
    </span>
</template>

<script>
import Icon from "@/Components/Icon";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: {
        link: {
            type: String,
            default: null,
        },
        name: {
            type: String,
            default: "No name provided",
        },
        icon: {
            type: String,
            default: null,
        },
        bg: {
            type: String,
            default: "white",
        },
        color: {
            type: String,
            default: "gray",
        },
        method: {
            type: String,
            default: "get",
        },
    },

    components: {
        Icon,
        Link,
    },
};
</script>
