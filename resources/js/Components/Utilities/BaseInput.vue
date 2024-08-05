<script setup>
import { onMounted, ref } from 'vue'

const props = defineProps({
    modelValue: {default: ''},
    initialValue: { type: String, default: '' },
    valid : { type: Boolean, default: true }
})

const emit = defineEmits(['update:modelValue'])
const inputValue = ref(props.modelValue)
const updateValue = (value) => {
    inputValue.value = value
    emit('update:modelValue', value)
}

onMounted(() => {
    inputValue.value = props.initialValue
})
</script>
<template>
    <input
        :value="inputValue"
        @input="updateValue($event.target.value)"
        v-bind="$attrs"
        :class="props.valid === true ? 'placeholder-gray-500 border-gray-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled:bg-gray-100 disabled:cursor-not-allowed' : 'placeholder-gray-500 border-red-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled:bg-gray-100 disabled:cursor-not-allowed'"
        class="disabled:bg-gray-100 disabled:placeholder-gray-500"
    />
</template>
