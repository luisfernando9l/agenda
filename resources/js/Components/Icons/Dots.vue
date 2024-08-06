<script setup>
defineProps({
    icon_height: { required: true, type: Number },
    icon_width: { required: true, type: Number },
    color: { required: false, type: String, default: '' }  
})
</script>

<template>
    <svg 
        :class="color" 
        :width="icon_width" 
        :height="icon_height" 
        viewBox="0 0 24 24"  
        xmlns="http://www.w3.org/2000/svg"
    >
    <g id="Option" :fill="color != '' ? color : 'rgb(0,0,0)'" fill-rule="evenodd"><circle id="Oval" cx="12" cy="12" r="2" transform="matrix(0 1 -1 0 24 0)"/><circle id="Oval-Copy-2" cx="12" cy="5" r="2" transform="matrix(0 1 -1 0 17 -7)"/><circle id="Oval-Copy" cx="12" cy="19" r="2" transform="matrix(0 1 -1 0 31 7)"/></g></svg>
</template>