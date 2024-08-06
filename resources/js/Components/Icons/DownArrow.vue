<script setup>
const props = defineProps({
    icon_height: { required: true, type: Number },
    icon_width: { required: true, type: Number },
    color: { required: false, type: String, default: '' }
})
</script>
<template>
    <svg
        version="1.1"
        :class="props.color"
        x="0px"
        y="0px"
        :width="props.icon_width"
        :height="props.icon_height"
        viewBox="0 0 123.959 123.958"
        style="enable-background:new 0 0 123.959 123.958;"
        xml:space="preserve"
    >
        <g>
            <path d="M117.979,28.017h-112c-5.3,0-8,6.4-4.2,10.2l56,56c2.3,2.3,6.1,2.3,8.401,0l56-56 C125.979,34.417,123.279,28.017,117.979,28.017z"/>
        </g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
        <g></g>
    </svg>
</template>