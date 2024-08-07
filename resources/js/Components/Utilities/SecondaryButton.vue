<script setup>
import { computed } from 'vue'

const props = defineProps({
	width: { default: 20 },
	height: { type: Number, default: 10 },
	color:{ type: String, default: 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150' },
})
const classButton = computed(() => 'disabled:cursor-not-allowed disabled:opacity-60 rounded flex justify-center items-center py-2 px-2 ' + ('w-' + props.width) + (' h-' + props.height + ' ') + (props.color))
</script>
<template>
    <button
        :class="[props.color, classButton]"
        v-bind="$attrs"
    >
        <slot></slot>
    </button>
</template>