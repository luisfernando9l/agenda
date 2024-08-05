<script setup>
import { computed } from 'vue';

const props = defineProps({
    type: { type: String, default: 'submit' },
    buttonClass: { type: String },
    width: { default: 20 },
    height: { type: Number, default: 10 },
    color:{ type: String, default: 'bg-blue-500 hover:bg-blue-700 border border-blue-500 hover:border-blue-700 disabled:hover:bg-blue-500 disabled:hover:border-blue-500' },
    disabled: { type: Boolean, default: false }
})

const classButton = computed(() => 
    'disabled:cursor-not-allowed disabled:opacity-60 rounded flex justify-center items-center py-2 px-2 text-white ' + ('w-' + props.width) + (' h-' + props.height + ' ') + (props.color)
)
</script>
<template>
    <button 
        :type="type" 
        :disabled="disabled" 
        :class="classButton"
    >
        <slot></slot>
    </button>
</template>
