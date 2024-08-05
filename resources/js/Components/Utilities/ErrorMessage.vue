<script setup>
const props = defineProps({
    message : { type : String }
});
</script>
<template>
    <p class="text-xs text-red-500 font-semibold"> 
        {{ message }}
    </p>
</template>