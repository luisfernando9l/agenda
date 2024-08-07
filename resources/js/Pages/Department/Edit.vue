<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import BaseLabel from "@/Components/Utilities/BaseLabel.vue"
import BaseInput from "@/Components/Utilities/BaseInput.vue"
import BaseButton from "@/Components/Utilities/BaseButton.vue"
import BaseAlerts from "@/Components/Utilities/BaseAlerts.vue"
import LoadingCircle from '@/Components/Icons/LoadingCircle.vue'
import MarginLayout from '@/Components/Utilities/MarginLayout.vue'
import ErrorMessage from '@/Components/Utilities/ErrorMessage.vue'
import { ref, onMounted } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage()

const title = ref('Atualizar Departamento')
let alerts = ref([])

const props = defineProps({
    department: { type: Object, default: true }
})

const form = useForm({
    name: '',
    department_id: '',
})

const submit = () => {
    clearAlerts()
    form.put(route('department.update', { department: props.department.data.id } ),{
        preserveScroll: true
    })
}

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

onMounted(() => {
    getFlashAlerts()
    form.id = props.department.data.id
    form.name = props.department.data.name
})
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
                <form @submit.prevent="submit">
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
                                :disabled="form.processing"
                                v-model="form.name"
                                :value="form.name"
                                type="text"
                                id="name"
                                placeholder="Nome do Departamento"
                                :class="form.errors.name ? 'border border-red-500' : ''"
                            />
                            <div class="h-2">
                                <error-message
                                    v-if="form.errors.name"
                                    :message="form.errors.name"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-[1000px] mx-auto flex justify-end">
                        <base-button
                            v-if="!form.processing"
                            type="submit"
                            :class="{ 'opacity-50': form.processing }"
                            :disabled="form.processing"
                        >
                            Salvar
                        </base-button>
                        <base-button
                            v-else
                            :class="{ 'opacity-50': form.processing }"
                            :disabled="form.processing"
                        >
                            <LoadingCircle
                                :icon_width="20"
                                :icon_height="20"
                                :color="'fill-current animate-spin'"
                            />
                        </base-button>
                    </div>
                </form>
            </margin-layout>
        </template>
    </app-layout>
</template>