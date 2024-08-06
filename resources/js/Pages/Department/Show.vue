<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import BaseLabel from "@/Components/Utilities/BaseLabel.vue"
import BaseInput from "@/Components/Utilities/BaseInput.vue"
import BaseAlerts from "@/Components/Utilities/BaseAlerts.vue"
import MarginLayout from '@/Components/Utilities/MarginLayout.vue'
import { ref } from 'vue'

const title = ref('Visualizar Departamento')
let alerts = ref([])

const props = defineProps({
    department: { type: Object, default: true }
})

const destroyAlert = (index) => {
    alerts.value.splice(index, 1)
}
</script>
<template>
    <app-layout>
        <template #header>
            <margin-layout>
                <div class="flex xs:justify-start md:justify-center pb-6 xs:-ml-0.5 md:ml-0 mt-10 mb-3">
                    <h3 class="text-3xl font-semibold text-gray-500">
                        {{title}}
                    </h3>
                </div>
            </margin-layout>
        </template>
        <template #body>
            <margin-layout>
                <div>
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
                    <div class="flex xs:flex-col md:flex-row justify-center items-center gap-2 pt-10 pb-4 w-full max-w-[1000px] mx-auto">
                        <div class="w-full">
                            <base-label
                                id="name"
                                value="Nome do Departamento"
                            />
                            <base-input
                                disabled
                                v-model="department.data.id"
                                :value="department.data.id"
                                type="text"
                                id="name"
                                placeholder="Nome do Departamento"
                            />
                        </div>
                    </div>
                </div>
            </margin-layout>
        </template>
    </app-layout>
</template>