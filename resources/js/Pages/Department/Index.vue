<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import MarginLayout from '@/Components/Utilities/MarginLayout.vue'
import BaseButton from '@/Components/Utilities/BaseButton.vue'
import BaseInput from '@/Components/Utilities/BaseInput.vue'
import BaseLabel from '@/Components/Utilities/BaseLabel.vue'
import BaseAlerts from '@/Components/Utilities/BaseAlerts.vue'
import LoadingCircle from '@/Components/Icons/LoadingCircle.vue'
import DialogModal from '@/Components/Utilities/DialogModal.vue'
import Paginator from '@/Components/Utilities/Paginator.vue'
import ArrowLeft from '@/Components/Icons/ArrowLeft.vue'
import Dots from '@/Components/Icons/Dots.vue'
import axios from 'axios'
import debounce from 'lodash/debounce'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { ref, onMounted } from 'vue'
import { usePage, router } from '@inertiajs/vue3'

const page = usePage()
let loading = ref(true)
const title = ref('Departamentos Registrados')
const alerts = ref([])
let search = ref({ name: '' })
let selected_department = ref(null)
let departments = ref({})
let dropdown_options = ref({ index : '', show : false})
let show_modal_delete = ref(false)

const getDepartments = debounce(async function(url=1, success=false){
    loading.value = true
    let params = ""

    if(search.value.name !== "")
        params += params + '&name=' + search.value.name

    await axios.get('api/departments?page='+url+params)
    .then((response) => {
        departments.value = response.data
        loading.value = false
    })
    .catch(() => {
        alert('Erro ao obter departamentos')
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

const confirmDelete = async () => {
    loading.value = true
    clearAlerts()
    router.delete(route('department.destroy', selected_department.value.id ), {
        onSuccess: async () => {
            getDepartments(),
            getFlashAlerts(),
            show_modal_delete.value = false
            selected_department.value = null
        },
        onError: (errors) => {
            loading.value = false
            clearAlerts()
            alerts.value = []
            for(let error in errors){
                if(errors[error].data !== undefined){
                    if(errors[error].status == 500 || errors[error].status == 422){
                        alerts.value.push({type: "error", message:"Erro ao deletar, contate o time de desenvolvimento."})
                    }else if(errors[error].status == 300 || errors[error].status == 403){
                        alerts.value.push({type: "error", message: "Você não tem permissão para realizar essa ação."})
                    }
                }
            }
            selected_department.value = null
            show_modal_delete.value = false
            dropdown_options.value.index = ''
            dropdown_options.value.show = false
        }
    })
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
    getDepartments(),
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
                            :href="route('department.create')"
                        >
                            <base-button
                                aria-label="new_button"
                                class="md:w-20 font-semibold"
                                type="button"
                            >
                                Novo
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
                <div class="flex xs:flex-col md:flex-row mt-4">
                    <div class="flex flex-col py-1 xs:w-full sm:w-full md:w-full lg:w-3/12 xl:w-3/12 lg:pr-1 xl:pr-1">
                        <base-label
                            for="name_search"
                        >
                            Nome
                        </base-label>
                        <base-input
                            id="name_search"
                            v-model="search.name"
                            placeholder="Nome"
                        />
                    </div>
                    <div class="flex flex-col justify-end float-right py-1 lg:pl-2 xl:pl-2">
                        <base-button
                            @click="getDepartments()"
                            class="w-full md:w-fit"
                        >
                            Buscar
                        </base-button>
                    </div>
                </div>
                <div class="mt-8 h-full mb-20">
                    <div v-if="!loading">
                        <base-alerts
                            :alerts="alerts"
                            @destroyAlert="destroyAlert($event)"
                        />
                            <div
                                v-if="departments.data.length > 0"
                                class="min-h-0 space-y-4"
                            >
                            <table class="w-full border-gray-200 shadow xs:hidden md:table sm:rounded-lg overflow-auto relative">
                                <tr class="bg-gray-100 th_rows">
                                    <th class="th">
                                        Nome
                                    </th>
                                    <th class="th">
                                        Criado em
                                    </th>
                                    <th class="th">
                                        Opções
                                    </th>
                                </tr>
                                <tr
                                    v-for="(department, index) in departments.data"
                                    :key="index"
                                    class="tb_rows hover:bg-gray-100"
                                >
                                    <td class="td">
                                        {{department.name}}
                                    </td>
                                    <td class="td">
                                        {{department.created_at}}
                                    </td>
                                    <td class="td">
                                        <div class="inline-block text-left">
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
                                                    class="absolute z-30 -mt-6 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg right-5 ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                    role="menu"
                                                    aria-orientation="vertical"
                                                    aria-labelledby="menu-button"
                                                    tabindex="-1"
                                                >
                                                    <div>
                                                        <inertia-link :href="route('department.show', department.id)">
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
                                                        <inertia-link :href="route('department.edit', department.id)">
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
                                                            @click="show_modal_delete = true, selected_department = department, show_options"
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
                                        v-for="(department, index) in departments.data"
                                        :key="index"
                                        class="p-3 bg-gray-100 border-b rounded relative"
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
                                                        class="flex flex-col items-center absolute z-30 bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none right-3 top-1 px-2"
                                                        role="menu" 
                                                        aria-orientation="vertical" 
                                                        aria-labelledby="menu-button" 
                                                        tabindex="-1"
                                                    >
                                                        <div role="none">
                                                            <inertia-link
                                                                :href="route('department.show', department.id)"
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
                                                                :href="route('department.edit', department.id)"
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
                                                                @click="show_modal_delete = true, selected_department = department, dropdown_options.show = false, dropdown_options.index = ''"  
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
                                            <div class="flex flex-col gap-2 pr-2 items-start">
                                                <div class="flex gap-1">
                                                    <span class="font-bold">
                                                        Nome:
                                                    </span>
                                                    <span>{{department.name}}</span>
                                                </div>
                                                <div class="flex gap-1">
                                                    <span class="font-bold">
                                                        Criado por:
                                                    </span>
                                                    <span>{{department.created_by.name}}</span>
                                                </div>
                                                <div class="flex gap-1">
                                                    <span class="font-bold">
                                                        Criado em:
                                                    </span>
                                                    <span>{{department.created_at}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div v-if="!loading">
                                <div class="w-full flex justify-center mt-1">
                                    <paginator
                                        :data="departments"
                                        @search-link="getDepartments"
                                    />
                                </div>
                            </div>
                        </div>
                        <div v-else class="flex flex-row items-center justify-center w-full h-48 rounded-lg mb-10">
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
                <dialog-modal
                    :show="show_modal_delete"
                    @close="show_modal_delete = !show_modal_delete"
                >
                    <template
                        #title
                        v-if="!loading"
                    >
                        Deletar Departamento
                    </template>
                    <template #content>
                        <div
                            v-if="loading"
                            class="flex flex-col items-center justify-center w-full h-full"
                        >
                            <loading-circle
                                :settings="'animate-spin fill-current text-gray-500'"
                                :icon_height="30" :icon_width="30"
                            />
                            <p class="mt-4">
                                Deletando departamento, aguarde um momento...
                            </p>
                        </div>
                        <div
                            v-else-if="!loading"
                        >
                            Tem certeza que deseja deletar o departamento:
                            <span class="font-semibold">
                                {{selected_department.name}} ?
                            </span>
                        </div>
                    </template>
                    <template
                        #footer
                        v-if="!loading"
                    >
                        <div class="flex flex-row items-end justify-end">
                            <secondary-button
                                @click="show_modal_delete = !show_modal_delete"
                            >
                                Cancelar
                            </secondary-button>
                            <base-button
                                @click="confirmDelete()"
                                class="inline-flex items-center px-4 py-2 ml-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-blue-500 rounded-md shadow-sm hover:bg-blue-700 hover:border-blue-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 active:bg-gray-50 disabled:opacity-25"
                            >
                                Confirmar
                            </base-button>
                        </div>
                    </template>
                </dialog-modal>
            </margin-layout>
        </template>
    </app-layout>
</template>