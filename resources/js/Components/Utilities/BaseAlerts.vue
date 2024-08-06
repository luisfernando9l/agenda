<script setup>
import CancelClose from '@/Components/Icons/CancelClose.vue'

const props = defineProps({
    alerts: { type: Array, required: true }
})

const emits = defineEmits([
    'destroyAlert'
])

const classType = (type) => {
    switch(type) {
        case 'success':
            return 'bg-green-100 border-green-400 text-green-700'
        case 'error':
            return 'bg-red-400 text-red-800 border-red-600'
        case 'warning':
            return 'bg-yellow-400 border-red-600 text-yellow-800'
        default:
            return 'bg-yellow-400 border-red-600 text-yellow-800'
    }
}

const iconClassType = (type) => {
    switch(type) {
        case 'success':
            return 'fill-current text-green-700'
        case 'error':
            return 'fill-current text-red-800'
        case 'warning':
            return 'fill-current text-yellow-800'
        default:
            return 'fill-current text-yellow-800'
    }
}

const handleClick = (index, event) => {
    event.preventDefault()
    emits('destroyAlert', index)
}
</script>
<template>
    <div
        v-if="props.alerts.length > 0"
        class="w-full py-2 flex flex-col gap-1 text-sm"
    >
        <div
            v-for="(alert, index) in props.alerts"
            :key="index"
            :class="classType(alert.type)"
            class="flex relative px-2 py-2 w-full rounded font-bold"
        >
            <div>
                {{ alert.message }}
            </div>
            <button
                @click="handleClick(index, $event)"
                class="absolute top-2 right-2"
            >
                <cancel-close
                    :icon_width="10"
                    :icon_height="10"
                    :color="iconClassType(alert.type)"
                />
            </button>
        </div>
    </div>
</template>