<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import BaseLabel from "@/Components/Utilities/BaseLabel.vue"
import BaseInput from "@/Components/Utilities/BaseInput.vue"
import BaseButton from "@/Components/Utilities/BaseButton.vue"
import BaseAlerts from "@/Components/Utilities/BaseAlerts.vue"
import LoadingCircle from '@/Components/Icons/LoadingCircle.vue'
import MarginLayout from '@/Components/Utilities/MarginLayout.vue'
import ErrorMessage from '@/Components/Utilities/ErrorMessage.vue'
import ArrowLeft from '@/Components/Icons/ArrowLeft.vue'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const title = ref('Visualizar Ramal')
let alerts = ref([])

const props = defineProps({
    extension: { type: Object, default: true }
})

const getFlashAlerts =() => {
    if(page.props.flash.error){
        alerts.value.push({type: "error", message: page.props.flash.error})
    }else if(page.props.flash.success){
        alerts.value.push({type: "success", message: page.props.flash.success})
    }else{
        clearAlerts()
    }
}

const destroyAlert = (index) => {
    alerts.value.splice(index, 1)
}

const clearAlerts = () => {
    alerts.value = []
}
</script>
<template>
    <app-layout>
        <template #header>
            <margin-layout>
                <div class="flex xs:justify-start md:justify-center pb-6 xs:-ml-0.5 md:ml-0 mt-10 mb-2">
                    <div class="flex flex-row w-full justify-between">
                        <inertia-link
                            :href="route('extensions')"
                        >
                            <base-button
                                aria-label="new_button"
                                class="md:w-16 font-semibold"
                                type="button"
                            >
                                <arrow-left
                                    :icon_height="20"
                                    :icon_width="20"
                                    :color="'fill-current text-white'"
                                />
                            </base-button>
                        </inertia-link>
                        <h3 class="text-3xl font-semibold text-gray-500 items-center">
                            {{title}}
                        </h3>
                        <div></div>
                    </div>
                </div>
            </margin-layout>
        </template>
        <template #body>
            <margin-layout>
                <div class="mb-20">
                    <div
                        v-if="alerts"
                        class="flex xs:flex-col md:flex-row justify-center items-center gap-2 pt-10 pb-4 w-full max-w-[1000px] mx-auto"
                    >
                        <div class="w-full">
                            <base-alerts
                                :alerts="alerts"
                                @destroyAlert="destroyAlert($event)"
                            />
                        </div>
                    </div>
                    <div class="flex xs:flex-col md:flex-row justify-center items-center gap-2 pt-10 pb-2 w-full max-w-[1000px] mx-auto">
                        <div class="w-full">
                            <base-label
                                id="number"
                                value="Número do ramal"
                            />
                            <base-input
                                disabled
                                v-model="extension.data.number"
                                :value="extension.data.number"
                                type="text"
                                id="number"
                                placeholder="Número do ramal"
                            />
                        </div>
                        <div class="w-full">
                            <base-label
                                id="created_at"
                                value="Criado em"
                            />
                            <base-input
                                disabled
                                v-model="extension.data.created_at"
                                :value="extension.data.created_at"
                                type="text"
                                id="created_at"
                                placeholder="Criado em"
                            />
                        </div>
                    </div>
                    <div class="flex xs:flex-col md:flex-row justify-center items-center gap-2 pb-4 w-full max-w-[1000px] mx-auto">
                        <div class="w-full">
                            <base-label
                                id="user_owner"
                                value="Atribuído para"
                            />
                            <base-input
                                disabled
                                v-model="extension.data.user_owner.name"
                                :value="extension.data.user_owner.name"
                                type="text"
                                id="user_owner"
                                placeholder="Atribuído para"
                            />
                        </div>
                        <div class="w-full">
                            <base-label
                                id="department"
                                value="Departamento"
                            />
                            <base-input
                                disabled
                                v-model="extension.data.user_owner.department"
                                :value="extension.data.user_owner.department"
                                type="text"
                                id="department"
                                placeholder="Departamento"
                            />
                        </div>
                    </div>
                </div>
            </margin-layout>
        </template>
    </app-layout>
</template>