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
import { ref, onMounted } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage()
const title = ref('Editar Usuário')
let alerts = ref([])

const props = defineProps({
    departments: { type: Object, required: true },
    user: { type: Object, required: true }
})

const form = useForm({
    name: '',
    email: '',
    department_id: '',
})

const submit = () => {
    clearAlerts()
    form.post(route('user.store'), {
        preserveScroll: true,
    })
    getFlashAlerts()
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
    form.id = props.user.data.id
    form.name = props.user.data.name
    form.email = props.user.data.email
    form.department_id = props.user.data.department_id ? props.user.data.department_id : ''
})
</script>
<template>
    <app-layout>
        <template #header>
            <margin-layout>
                <div class="flex xs:justify-start md:justify-center pb-6 xs:-ml-0.5 md:ml-0 mt-10 mb-2">
                    <div class="flex flex-row w-full justify-between">
                        <inertia-link
                            :href="route('users')"
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
                <form
                    @submit.prevent="submit"
                    class="mb-20"
                >
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
                                id="name"
                                value="Nome Completo"
                            />
                            <base-input
                                :disabled="form.processing"
                                v-model="form.name"
                                :value="form.name"
                                type="text"
                                id="name"
                                placeholder="Nome Completo"
                                :class="form.errors.name ? 'border border-red-500' : ''"
                            />
                            <div class="h-2">
                                <error-message
                                    v-if="form.errors.name"
                                    :message="form.errors.name"
                                />
                            </div>
                        </div>
                        <div class="w-full">
                            <base-label
                                id="email"
                                value="E-mail"
                            />
                            <base-input
                                :disabled="form.processing"
                                v-model="form.email"
                                :value="form.email"
                                type="text"
                                id="email"
                                placeholder="E-mail"
                                :class="form.errors.email ? 'border border-red-500' : ''"
                            />
                            <div class="h-2">
                                <error-message
                                    v-if="form.errors.email"
                                    :message="form.errors.email"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex xs:flex-col md:flex-row justify-center items-center gap-2 pt-2 pb-2 w-full max-w-[1000px] mx-auto">
                        <div class="w-full">
                            <base-label
                                id="department_id"
                                value="Selecione um departamento"
                            />
                            <select
                                id="department_id"
                                :disabled="props.departments.length === 0 || form.processing"
                                v-model="form.department_id"
                                :class="form.errors.department_id ? 'border border-red-500' : ''"
                                class="placeholder-gray-500 border-gray-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled:bg-gray-100 disabled:placeholder-gray-500"
                            >
                                <option
                                    value=""
                                    selected
                                    disabled
                                >
                                    Selecione um departamento
                                </option>
                                <option
                                    v-for="department in departments"
                                    :key="`department_${department.id}`"
                                    :value="department.id"
                                >
                                    {{department.name}}
                                </option>
                            </select>
                            <div class="h-2">
                                <error-message
                                    v-if="form.errors.department__id"
                                    :message="form.errors.department__id"
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
                                :settings="'fill-current animate-spin'"
                            />
                        </base-button>
                    </div>
                </form>
            </margin-layout>
        </template>
    </app-layout>
</template>