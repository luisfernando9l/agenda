<!-- <script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import BaseButton from '@/Components/Utilities/BaseButton.vue'
import BaseInput from '@/Components/Utilities/BaseInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import LoadingCircle from '@/Components/Icons/LoadingCircle.vue'
import { useForm } from '@inertiajs/vue3'
import HeaderPage from '@/Components/HeaderPage.vue'
import MarginLayout from '@/Components/Utilities/MarginLayout.vue'
import ErrorMessage from '@/Components/Utilities/ErrorMessage.vue'
import { ref, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { trans } from 'laravel-vue-i18n'

let form = useForm ({
    name: '',
})

const page = usePage()
let title = trans('Genus Registration')
let titles = ref([{'title':'Genus', 'url':'genus'}, {'title':'New', 'url':'genus.create'}])
let alerts = ref([])

const submit = () => {
    clearAlerts()
    form.post(route('genus.store'), {
        preserveScroll: true,
    })
}

const clearAlerts = () => {
	alerts.value = []
}

onMounted(() => 
    
)
</script>
<template>
    <app-layout>
        <template #header>
            <margin-layout>
                <div>
                    <header-page :titles="titles"/>
                </div>
                <div class="flex xs:justify-start md:justify-center pb-6 xs:-ml-0.5 md:ml-0">
                    <h3 class="text-3xl font-semibold text-gray-500">{{$t(title)}}</h3>
                </div>
            </margin-layout>
        </template>
        <template #body>
            <margin-layout>
                <div class="w-full mt-2">
                    <form 
                        @submit.prevent="submit" 
                        class="w-full flex flex-col justify-center items-center"
                    >
                        <div class="flex xs:flex-col sm:flex-col md:flex-row lg:flex-row xl:flex-row mt-2 space-x-2 w-full justify-center sm:px-8 xs:px-0">
                            <div class="sm:w-full xs:w-full md:w-4/12 lg:w-4/12 xl:w-4/12 px-3">
                                    <error-message 
                                        v-if="page.props.flash.error" 
                                        :message="page.props.flash.error" 
                                        class="text-lg"
                                    />
                            </div>
                        </div>
                        <div class="flex xs:flex-col sm:flex-col md:flex-row lg:flex-row xl:flex-row mt-2 space-x-2 w-full justify-center sm:px-8 xs:px-0 mb-2">
                            <div class="sm:w-full xs:w-full md:w-5/12 lg:w-5/12 xl:w-5/12">
                                <div class="flex flex-row w-full items-end xs:justify-end sm:justify-items-end sm:mt-2 xs:mt-2 space-x-2">
                                    <div class="w-full">
                                        <input-label 
                                            :value="$t('Name')" 
                                            for="name" 
                                        />
                                        <base-input 
                                            :disabled="form.processing" 
                                            v-model="form.name" 
                                            type="text" 
                                            id="name"
                                            :class="!form.errors ? 'border border-red-500' : ''"
                                        />
                                    </div>
                                    <base-button 
                                        :class="{ 'opacity-50': form.processing }" 
                                        :disabled="form.processing"    
                                        type="submit"
                                    >
                                        <loading-circle 
                                            v-if="form.processing"
                                            :icon_width="20" 
                                            :icon_height="20" 
                                            :settings="'fill-current animate-spin'"
                                        />
                                        <span v-else>
                                            {{$t('Save')}}
                                        </span>
                                    </base-button>
                                </div>
                                <error-message 
                                    v-if="form.errors.name" 
                                    :message="form.errors.name" 
                                    class="text-lg"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </margin-layout>
        </template>
    </app-layout>
</template>
 -->
