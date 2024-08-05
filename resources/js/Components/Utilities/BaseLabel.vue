<script setup>
const props = defineProps({
    value: { type: String }
});
</script>

<template>
    <label class="text-gray-500">
        <span v-if="value">{{ value }}</span>
        <span v-else>
            <slot></slot>
        </span>
    </label>
</template>
