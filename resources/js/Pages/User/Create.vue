<!-- <script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import MarginLayout from '@/Components/Utilities/MarginLayout.vue'
import ErrorMessage from '@/Components/Utilities/ErrorMessage.vue'
import BaseButton from '@/Components/Utilities/BaseButton.vue'
import BaseInput from '@/Components/Utilities/BaseInput.vue'
import BaseAlerts from '@/Components/Utilities/BaseAlerts.vue'
import InputLabel from '@/Components/InputLabel.vue'
import { vMaska } from "maska"
import LoadingCircle from '@/Components/Icons/LoadingCircle.vue'
import HeaderPage from '@/Components/HeaderPage.vue'
import { useForm } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'
import * as Constants from '../../Helpers/Constants.js'
import { trans } from 'laravel-vue-i18n'

const page = usePage()
const alerts = ref([])
const props = defineProps({
    levels : { type : Array, required: true },
})

let title = trans('User Registration')
let titles = ref([{'title':trans('Users'), 'url':'users'}, {title: title, url: 'users.create'}])

let form = useForm({
    email: '',
    name: '',
    gender: '',
    cpf: '',
    rg: '',
    birthday: '',
    level_id: '1',
    company_id: '1',
})

const submit = () => {
    form.post(route('users.store'))
}
onMounted(() => 
)
</script>
<template>
    <app-layout>
        <template #header>
            <margin-layout>
                <div>
                    <header-page 
                        :titles="titles" 
                    />
                </div>
                <div class="flex xs:justify-start md:justify-center pb-6 xs:-ml-0.5 md:ml-0">
                    <h3 class="text-3xl font-semibold text-gray-500">{{$t(title)}}</h3>
                </div>
            </margin-layout>
        </template>
        <template #body>
            <margin-layout>
                <div class="mt-8">
                    <div>
                        <div>
                            <div>
                                <base-alerts 
                                    :alerts="alerts" 
                                    @destroyAlert="destroyAlert($event)" 
                                />
                            </div>
                            <div class="min-h-0 space-y-4">
                                <div class="xs:w-full sm:w-full md:max-w-7xl lg:max-w-7xl xl:max-w-7xl mx-auto px-3 lg:px-8">
                                    <form 
                                        @submit.prevent="submit" 
                                        class="xs:flex xs:flex-col md:px-36 lg:px-36 xl:px-36 pt-5"
                                    >
                                        <error-message 
                                            v-if="page.props.flash.error" 
                                            :message="page.props.flash.error" 
                                            class="text-lg"
                                        />
                                        <div class="flex xs:flex-col md:flex-row">
                                            <div class="xs:w-full md:w-6/12 lg:w-6/12 xl:w-6/12 md:ml-2 lg:ml-2 xl:ml-2 sm:mt-4 xs:mt-4">
                                                <input-label 
                                                    for="name" 
                                                    :value="$t('Name')"
                                                />
                                                <base-input
                                                    v-model="form.name"
                                                    id="name"
                                                    type="text"
                                                    autocomplete="off"
                                                />
                                                <error-message
                                                    v-if="form.errors.name"
                                                    :message="form.errors.name"
                                                />
                                            </div>
                                            <div class="xs:w-full md:w-6/12 lg:w-6/12 xl:w-6/12 md:ml-2 lg:ml-2 xl:ml-2 sm:mt-4 xs:mt-4">
                                                <input-label 
                                                    for="email" 
                                                    :value="$t('Email')" 
                                                />
                                                <base-input
                                                    v-model="form.email"
                                                    id="email"
                                                    type="email"
                                                    autocomplete="off"
                                                />
                                                <error-message 
                                                    v-if="form.errors.email"
                                                    :message="form.errors.email"
                                                />
                                            </div>
                                        </div>
                                        <div class="flex xs:flex-col md:flex-row">
                                            <div class="xs:w-full md:w-6/12 lg:w-6/12 xl:w-6/12 md:ml-2 lg:ml-2 xl:ml-2 sm:mt-4 xs:mt-4">
                                                <input-label 
                                                    for="birthday"
                                                    :value="$t('Date of Birth')"
                                                />
                                                <base-input
                                                    v-model="form.birthday"
                                                    id="birthday"
                                                    type="date"
                                                    autocomplete="off"
                                                />
                                                <error-message 
                                                    v-if="form.errors.birthday"
                                                    :message="form.errors.birthday"
                                                />
                                            </div>
                                            <div class="xs:w-full md:w-6/12 lg:w-6/12 xl:w-6/12 md:ml-2 lg:ml-2 xl:ml-2 sm:mt-4 xs:mt-4">
                                                <input-label 
                                                    for="gender"
                                                    :value="$t('Gender')"
                                                />
                                                <select 
                                                    id="gender"
                                                    v-model="form.gender"
                                                    class="placeholder-gray-500 border-gray-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                >
                                                    <option 
                                                        class="text-gray-700" 
                                                        value=""
                                                        disabled
                                                    >
                                                        {{ $t('Select') }}
                                                    </option>
                                                    <option 
                                                        class="text-gray-700"
                                                        value="Feminino"
                                                    >
                                                        {{ $t('Female') }}
                                                    </option>
                                                    <option
                                                        class="text-gray-700"
                                                        value="Masculino"
                                                    >
                                                        {{ $t('Male') }}
                                                    </option>
                                                    <option 
                                                        class="text-gray-700"
                                                        value="Prefiro não dizer"
                                                    >
                                                        {{ $t('Prefer not to say') }}
                                                    </option>
                                                </select>
                                                <error-message
                                                    v-if="form.errors.gender"
                                                    :message="form.errors.gender"
                                                />
                                            </div>
                                        </div>
                                        <div class="flex xs:flex-col md:flex-row">
                                            <div class="xs:w-full md:w-6/12 lg:w-6/12 xl:w-6/12 md:ml-2 lg:ml-2 xl:ml-2 sm:mt-4 xs:mt-4">
                                                <input-label 
                                                    for="cpf"
                                                    value="CPF"
                                                />
                                                <base-input
                                                    v-model="form.cpf"
                                                    id="cpf"
                                                    v-maska
                                                    data-maska="###.###.###-##"
                                                    type="text"
                                                    autocomplete="off"
                                                />
                                                <error-message
                                                    v-if="form.errors.cpf"
                                                    :message="form.errors.cpf"
                                                />
                                            </div>
                                            <div class="xs:w-full md:w-6/12 lg:w-6/12 xl:w-6/12 md:ml-2 lg:ml-2 xl:ml-2 sm:mt-4 xs:mt-4">
                                                <input-label
                                                    for="rg"
                                                    value="RG"
                                                />
                                                <base-input
                                                    v-model="form.rg"
                                                    id="rg"
                                                    v-maska
                                                    data-maska="##.###.###-#"
                                                    type="text"
                                                    autocomplete="off"
                                                />
                                                <error-message 
                                                    v-if="form.errors.rg"
                                                    :message="form.errors.rg"
                                                />
                                            </div>
                                        </div>
                                        <div 
                                            v-if="page.props.auth.user.level_id === Constants.LEVEL_DEV"
                                            class="flex xs:flex-col md:flex-row"
                                        >
                                            <div class="xs:w-full md:w-6/12 lg:w-6/12 xl:w-6/12 md:ml-2 lg:ml-2 xl:ml-2 sm:mt-4 xs:mt-4">
                                                <input-label
                                                    for="level"
                                                    :value="$t('Access Level')"
                                                />
                                                <select 
                                                    id="level"
                                                    v-model="form.level_id"
                                                    class="placeholder-gray-500 border-gray-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                >
                                                    <option
                                                        v-for="level in levels"
                                                        :key="level.id"
                                                        class="text-gray-700"
                                                        :value="level.id"
                                                    >
                                                        {{ level.name }}
                                                    </option>
                                                </select>
                                                <error-message
                                                    v-if="form.errors.gender"
                                                    :message="form.errors.gender"
                                                />
                                            </div>
                                        </div>
                                        <div class="flex flex-row items-center justify-end xs:mt-4 md:mt-2">
                                            <base-button
                                                :class="{ 'opacity-50': form.processing}"
                                                :disabled="form.processing"
                                                type="submit"
                                                class="xs:w-full md:w-24"
                                            >
                                                <loading-circle 
                                                    v-if="form.processing"
                                                    :settings="'animate-spin fill-current text-white'"
                                                    :icon_height="20"
                                                    :icon_width="20"
                                                />
                                                <span v-else>{{ $t('Save') }}</span>
                                            </base-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </margin-layout>
        </template>
    </app-layout>
</template> -->