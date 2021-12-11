<template>
  <div class="lg:flex lg:items-center lg:justify-between">
    <div class="flex-1 min-w-0">
      <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9">
        <div class="flex items-center">
          <img :src="image" class="block h-12 w-auto mr-2" :class="{ 'rounded-full object-cover': roundedImage }" v-if="image" />
          <Link :href="link" v-if="link">{{ name }}</Link>
          <div v-else-if="name">{{ name }}</div>
          <slot name="title"></slot>
        </div>
      </h2>

      <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap">
        <div class="mt-2 flex items-center text-sm leading-5 text-gray-500 sm:mr-6">
          <slot name="content"></slot>
        </div>
      </div>
    </div>

    <div class="mt-5 flex lg:mt-0 lg:ml-4">
      <slot name="actions"></slot>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    },

  props: {
    image: {
      type: String,
      default: null
    },
    link: {
      type: String,
      default: null
    },
    name: {
      type: String,
      default: null
    },
    roundedImage: {
      type: Boolean,
      default: false
    }
  }
}
</script>