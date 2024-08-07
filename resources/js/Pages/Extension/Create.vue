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
const title = ref('Criar Ramal')
let alerts = ref([])

const props = defineProps({
    users: { type: Object, required: true }
})

const form = useForm({
    number: '',
    extension_id: '',
    user_id: '',
})

const submit = () => {
    clearAlerts()
    form.post(route('extension.store'), {
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

onMounted(() =>
    getFlashAlerts()
)
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
                    <div class="flex xs:flex-col md:flex-row justify-center items-center gap-2 pt-10 pb-4 w-full max-w-[1000px] mx-auto">
                        <div class="w-full">
                            <base-label
                                id="number"
                                value="Número do ramal"
                            />
                            <base-input
                                :disabled="form.processing"
                                v-model="form.number"
                                :value="form.number"
                                type="text"
                                id="number"
                                placeholder="Número do ramal"
                                :class="form.errors.number ? 'border border-red-500' : ''"
                            />
                            <div class="h-2">
                                <error-message
                                    v-if="form.errors.number"
                                    :message="form.errors.number"
                                />
                            </div>
                        </div>
                        <div class="w-full">
                            <base-label
                                id="user_id"
                                value="Selecione um usuário"
                            />
                            <select
                                id="user_id"
                                :disabled="props.users.length === 0 || form.processing"
                                v-model="form.user_id"
                                :class="form.errors.user_id ? 'border border-red-500' : ''"
                                class="placeholder-gray-500 border-gray-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline disabled:bg-gray-100 disabled:placeholder-gray-500"
                            >
                                <option
                                    value=""
                                    selected
                                >
                                    Selecione um usuário
                                </option>
                                <option
                                    v-for="user in users"
                                    :key="`user_${user.id}`"
                                    :value="user.id"
                                >
                                    {{user.name}}
                                </option>
                            </select>
                            <div class="h-2">
                                <error-message
                                    v-if="form.errors.user_id"
                                    :message="form.errors.user_id"
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