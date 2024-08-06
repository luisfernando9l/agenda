<script setup>
import { computed } from 'vue';
const props = defineProps({
    marginHeight: { type: String, required: false, default: 'h-full' },
    marginPadding: { type: String, required: false, default: 'margin-container px-10' }
})
const classMargin = computed(() => props.marginHeight + ' ' + props.marginPadding)
</script>
<template>
    <div
        :class="classMargin"
        class="max-w-[1000px]"
    >
        <slot></slot>
    </div>
</template>
