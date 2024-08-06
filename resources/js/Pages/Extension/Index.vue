<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import MarginLayout from '@/Components/Utilities/MarginLayout.vue'
import BaseButton from '@/Components/Utilities/BaseButton.vue'
import BaseInput from '@/Components/Utilities/BaseInput.vue'
import BaseLabel from '@/Components/Utilities/BaseLabel.vue'
import BaseAlerts from '@/Components/Utilities/BaseAlerts.vue'
import LoadingCircle from '@/Components/Icons/LoadingCircle.vue'
import Dots from '@/Components/Icons/Dots.vue'
import axios from 'axios'
import debounce from 'lodash/debounce'
import Paginator from '@/Components/Utilities/Paginator.vue'
import { ref, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
let loading = ref(true)
const title = ref('Ramais Registrados')
const alerts = ref([])
let search = ref({ number: '', owner: '', department: '' })
let selected_extension = ref(null)
let extensions = ref({})
let dropdown_options = ref({ index : '', show : false})

const getExtensions = debounce(async function(url=1, success=false){
    loading.value = true
    let params = ""

    if(search.value.number !== "")
        params += params + '&number=' + search.value.number
    if(search.value.owner !== "")
        params += params + '&owner=' + search.value.owner
    if(search.value.department !== "")
        params += params + '&department=' + search.value.department

    await axios.get('api/extensions?page='+url+params)
    .then((response) => {
        extensions.value = response.data
        loading.value = false
    })
    .catch(() => {
        alert('Erro ao obter ramais')
    })
    loading.value = false
}, 400)

const getFlashAlerts =() => {
    if(page.props.flash.error){
        alerts.value.push({type: "error", message: page.props.flash.error})
    }else if(page.props.flash.success){
        alerts.value.push({type: "success", message: page.props.flash.success})
    }else{
        clearAlerts()
    }
}

const show_options = (index) => {
    if(dropdown_options.value.show === true){
        dropdown_options.value.index = ''
        dropdown_options.value.show = false
    } else {
        dropdown_options.value.index = index
        dropdown_options.value.show = true
    }
}

const destroyAlert = (index) => {
	alerts.value.splice(index, 1)
}

const clearAlerts = () => {
	alerts.value = []
}

onMounted(() =>
    getExtensions(),
    getFlashAlerts(),
    document.addEventListener("click", (el) => {
        if(el.target.tagName != 'svg' && el.target.tagName != 'circle' && el.target.tagName != 'A' && el.target.tagName != 'path' && el.target.tagName != 'P' && el.target.tagName != 'SPAN'){
            dropdown_options.value = { index : '', show : false }
        }
    })
)
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
                <div class="flex xs:flex-col md:flex-row mt-4">
                    <div class="flex flex-col py-1 xs:w-full sm:w-full md:w-full lg:w-3/12 xl:w-3/12 lg:pr-1 xl:pr-1">
                        <base-label
                            for="number_search"
                        >
                            Ramal
                        </base-label>
                        <base-input
                            id="number_search"
                            v-model="search.number"
                            placeholder="Ramal"
                        />
                    </div>
                    <div class="flex flex-col py-1 xs:w-full sm:w-full md:w-full lg:w-3/12 xl:w-3/12 lg:pr-1 xl:pr-1">
                        <base-label
                            for="owner_search"
                        >
                            Atribuído para
                        </base-label>
                        <base-input
                            id="owner_search"
                            v-model="search.owner"
                            placeholder="Atribuído para"
                        />
                    </div>
                    <div class="flex flex-col py-1 xs:w-full sm:w-full md:w-full lg:w-3/12 xl:w-3/12 lg:pr-1 xl:pr-1">
                        <base-label
                            for="department_search"
                        >
                        Departamento
                        </base-label>
                        <base-input
                            id="department_search"
                            v-model="search.department"
                            placeholder="Departamento"
                        />
                    </div>
                    <div class="flex flex-col justify-end float-right py-1 lg:pl-2 xl:pl-2">
                        <base-button
                            @click="getExtensions()"
                            class="w-full md:w-fit"
                            :disabled="loading"
                        >
                            Buscar
                        </base-button>
                    </div>
                </div>
                <div class="mt-8 h-full">
                    <div v-if="!loading">
                        <base-alerts
                            :alerts="alerts"
                            @destroyAlert="destroyAlert($event)"
                        />
                        <div
                            v-if="extensions.data.length > 0"
                            class="min-h-0 space-y-4"
                        >
                            <table class="w-full border-gray-200 shadow xs:hidden md:table sm:rounded-lg overflow-hidden">
                                <tr class="bg-gray-100 th_rows">
                                    <th class="th">
                                        Ramal
                                    </th>
                                    <th class="th">
                                        Atribuído para
                                    </th>
                                    <th class="th">
                                        Setor
                                    </th>
                                    <th class="th">
                                        Opções
                                    </th>
                                </tr>
                                <tr
                                    v-for="(extension, index) in extensions.data"
                                    :key="index"
                                    class="tb_rows hover:bg-gray-100"
                                >
                                    <td class="td">
                                        {{extension.number}}
                                    </td>
                                    <td class="td">
                                        {{extension.user_owner.name}}
                                    </td>
                                    <td class="td">
                                        {{extension.user_owner.department}}
                                    </td>
                                    <td class="td">
                                        <div class="inline-block text-left relative">
                                            <button
                                                @click="show_options(index)"
                                                type="button"
                                                class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" 
                                                aria-expanded="true"
                                                aria-haspopup="true"
                                            >
                                            <dots
                                                :icon_width="25" 
                                                :icon_height="25" 
                                                color="'fill-current text-black'"
                                            />
                                            </button>
                                            <transition name="slide-fade">
                                                <div
                                                    v-show="dropdown_options.show && dropdown_options.index === index"
                                                    class="absolute -mt-6 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg right-5 ring-1 ring-black ring-opacity-5 focus:outline-none" 
                                                    role="menu"
                                                    aria-orientation="vertical"
                                                    aria-labelledby="menu-button"
                                                    tabindex="-1"
                                                >
                                                    <div>
                                                        <inertia-link :href="route('extension.show', extension.id)">
                                                            <button 
                                                                type="button" 
                                                                role="menuitem" 
                                                                tabindex="-1" 
                                                                id="menu-item-0" 
                                                                class="flex items-center justify-center px-3 py-2 text-sm font-bold text-gray-700 border-b border-gray-200 rounded w-36 hover:text-gray-500"
                                                            >
                                                                Visualizar
                                                            </button>
                                                        </inertia-link>
                                                    </div>
                                                    <div >
                                                        <inertia-link :href="route('extension.edit', extension.id)">
                                                            <button 
                                                                type="button" 
                                                                role="menuitem" 
                                                                tabindex="-1" 
                                                                id="menu-item-0" 
                                                                class="flex items-center justify-center px-3 py-2 text-sm font-bold text-gray-700 border-b border-gray-200 rounded w-36 hover:text-gray-500"
                                                            >
                                                                Editar
                                                            </button>
                                                        </inertia-link>
                                                    </div>
                                                    <div>
                                                        <button
                                                            @click="show_modal_delete = true, selected_extension = extension, show_options"
                                                            type="button" 
                                                            role="menuitem" 
                                                            tabindex="-1" 
                                                            id="menu-item-0" 
                                                            class="flex items-center justify-center px-3 py-2 text-sm font-bold text-gray-700 border-b border-gray-200 rounded w-36 hover:text-gray-500"
                                                        >
                                                            Deletar
                                                        </button>
                                                    </div>
                                                </div>
                                            </transition>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="xs:block md:hidden">
                                <ul class="flex flex-col w-full gap-5 h-full">
                                    <li
                                        v-for="(extension, index) in extensions.data"
                                        :key="index"
                                        class="p-3 bg-gray-100 border-b rounded border-gray-cygni relative"
                                    >
                                        <div>
                                            <div class="flex justify-end mb-2 absolute top-1 right-1.5">
                                                <button
                                                    @click="show_options(index)"
                                                    type="button"
                                                    class="-mr-2 flex items-start justify-end mt-1 ml-2 text-gray-400 hover:text-gray-600 focus:outline-none" 
                                                    aria-expanded="true"
                                                    aria-haspopup="true"
                                                >
                                                    <dots
                                                        :icon_width="25" 
                                                        :icon_height="25" 
                                                        color="'fill-current text-black'"
                                                    />
                                                </button>
                                                <transition name="slide-fade">
                                                    <div 
                                                        v-show="dropdown_options.show && dropdown_options.index === index" 
                                                        class="absolute z-30 bg-white divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none right-3 top-1"
                                                        role="menu" 
                                                        aria-orientation="vertical" 
                                                        aria-labelledby="menu-button" 
                                                        tabindex="-1"
                                                    >
                                                        <div role="none">
                                                            <inertia-link
                                                                :href="route('extension.show', extension.id)"
                                                            >
                                                                <button
                                                                    type="button"
                                                                    :width="20"
                                                                    :height="10"
                                                                    :color="'flex items-center justify-center px-3 py-2 text-sm font-bold text-gray-700 border-b border-gray-200 rounded w-36 hover:text-gray-500'"
                                                                >
                                                                    Visualizar
                                                                </button>
                                                            </inertia-link>
                                                        </div>
                                                        <div role="none">
                                                            <inertia-link
                                                                :href="route('extension.edit', extension.id)"
                                                            >
                                                                <button 
                                                                    type="button" 
                                                                    :color="'flex items-center justify-center px-3 py-2 text-sm font-bold text-gray-700 border-b border-gray-200 rounded w-36 hover:text-gray-500'" 
                                                                    :width="20" 
                                                                    :height="10" 
                                                                    class="float-right"
                                                                >
                                                                    Editar
                                                                </button>
                                                            </inertia-link>
                                                        </div>
                                                        <div role="none">
                                                            <button
                                                                @click="show_modal_delete = true, selected_extension = extension, dropdown_options.show = false, dropdown_options.index = ''"  
                                                                :color="'flex items-center justify-center px-3 py-2 text-sm font-bold text-gray-700 border-b border-gray-200 rounded w-36 hover:text-gray-500'"
                                                                :width="20" 
                                                                :height="10"
                                                                type="button" 
                                                                class="float-right"
                                                            >
                                                                Deletar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </transition>
                                            </div>
                                            <div class="flex flex-col gap-2 pr-2">
                                                <div class="flex gap-1">
                                                    <span class="font-bold">
                                                        Ramal:
                                                    </span>
                                                    <span>{{extension.number}}</span>
                                                </div>
                                                <div class="flex gap-1">
                                                    <span class="font-bold">
                                                        Atribuído para:
                                                    </span>
                                                    <span>{{extension.user_owner.name}}</span>
                                                </div>
                                                <div class="flex gap-1">
                                                    <span class="font-bold">
                                                        Setor:
                                                    </span>
                                                    <span>{{extension.user_owner.department}}</span>
                                                </div>
                                                <div class="flex gap-1">
                                                    <span class="font-bold">
                                                        Criado em:
                                                    </span>
                                                    <span>{{extension.user_owner.department}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div v-if="!loading">
                                <div class="w-full flex justify-center mt-1">
                                    <paginator
                                        :data="extensions"
                                        @search-link="getExtensions"
                                    />
                                </div>
                            </div>
                        </div>
                        <div v-else class="flex flex-row items-center justify-center w-full h-48 rounded-lg">
                            Nenhum resultado encontrado.
                        </div>
                    </div>
                    <div v-else>
                        <div class="flex flex-row items-center justify-center h-48">
                            <loading-circle
                                :icon_height="35"
                                :icon_width="35"
                                :settings="'fill-current animate-spin'"
                            />
                        </div>
                    </div>
                </div>
            </margin-layout>
        </template>
    </app-layout>
</template>