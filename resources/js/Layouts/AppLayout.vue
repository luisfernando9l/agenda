<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Sidebar from '@/Components/Sidebar.vue'

const page = usePage()

const sidebar_show = computed(() => {
    return !page.url.replace('/','').includes('dashboard')
})
</script>
<template>
    <div v-if="page.url.replace('/','').includes('home')">
        <div class="h-dvh">
            <slot />
        </div>
    </div>
    <div
        v-else
        class="flex min-h-dvh w-full"
    >
        <!-- Sidebar -->
        <div
            class="hidden lg:block lg:w-2/12 bg-gray-100"
        >
            <sidebar />
        </div>

        <!-- Main Content -->
        <div
            :class="sidebar_show ? 'w-full' : 'w-10/12'"
            class="flex-1 h-dvh bg-white"
        >
            <div
                :class="sidebar_show ? 'flex flex-col max-h-full overflow-y-auto' : 'flex flex-col h-full overflow-y-auto'"
                scroll-region
            >
                <div class="w-full xs:px-2 md:pr-4">
                    <slot name="header" />
                </div>
                <div class="w-full shadow-inner">
                    <div class="xs:px-2 md:pr-4 w-full">
                        <slot name="body" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>