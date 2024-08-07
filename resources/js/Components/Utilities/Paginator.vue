<script setup>
import DoubleArrowLeft from '@/Components/Icons/DoubleArrowLeft.vue'
import DoubleArrowRight from '@/Components/Icons/DoubleArrowRight.vue'
import { ref, computed, onMounted } from 'vue'

const emit = defineEmits(['search-link'])

const props = defineProps({
    data: { type: Object },
    disabled: { default: {} }
})

let total = ref(props.data.total ? props.data.total : (props.data.meta ? props.data.meta.total : ''))
let page_number = ref(props.data.page ? (props.data.page === undefined ? props.data.current_page : props.data.page) : (props.data.meta ? (props.data.meta.page === undefined ? props.data.meta.current_page : props.data.meta.page) : props.data.current_page ? props.data.current_page : ''))
let from = ref(props.data.from ? props.data.from : (props.data.meta ? props.data.meta.from : ''))
let to = ref(props.data.to ? props.data.to : (props.data.meta ? props.data.meta.to : ''))
let per_page = ref(props.data.per_page ? props.data.per_page : (props.data.meta ? props.data.meta.per_page : ''))
let last_page = ref(props.data.last_page ? props.data.last_page : (props.data.meta ? props.data.meta.last_page : ''))
let links = ref([])
let maxPage = ref(3)
let countPage = ref(1)

let getLinks = () => {
    return new Array(last_page.value)
}

let searchLink = (go_to) => {
    emit('search-link', go_to)
    if(last_page.value > 3){
        if(go_to >= maxPage.value){
            countPage.value = go_to
            if((go_to + 2) < last_page.value){
                maxPage.value = go_to + 2
            }else{
                countPage.value = last_page.value - 2
                maxPage.value = last_page.value
            }
        }else if(go_to < page_number.value){
            if((go_to + 2) <= maxPage.value && go_to > 1){
                countPage.value = go_to - 1
                maxPage.value = go_to + 1
            }
            else if((go_to + 2) < last_page.value){
                countPage.value = go_to
                maxPage.value = go_to + 2
            }
        }
    }else{
        maxPage.value = last_page.value
    }
    page_number.value = go_to
    for(let page = page_number.value; last_page.value > page; page++){
        if(page >= 1){
            links.value.push(page)
        }
    }
}

const previous = () => {
    if(page_number.value > 1){
        searchLink(page_number.value-1)
    }
}

const next = () =>{
    if(page_number.value<last_page.value){
        searchLink(page_number.value+1)
    }
}

const generateLinks = () => {
    links.value = []
    for(var page = 1; last_page.value+1 > page; page++){
        if(page >= 1){
            links.value.push(page)
        }
    }
    page = page_number.value == "" ?  1 : page
}

onMounted(() => generateLinks())

const startPage = computed(() => {
    if(page_number.value === 1){
        return 1
    }

    if(page_number.value === last_page.value){
        return last_page.value - 2
    }

    return page_number.value - 1
})

const pages = computed(() => { 
    let page_range = []

    if(last_page.value < 3){
        for(let page = 1; page <= last_page.value; page++){
            page_range.push({number: page})
        }
    }else{
        for (let page = startPage.value; page <= Math.min(startPage.value + 3 - 1, last_page.value); page++){
            page_range.push({number: page})
        }
    }

    return page_range
})
</script>
<template>
    <div 
        v-if="last_page > 1" 
        id="static_paginator"
    >
        <div class="w-full flex items-center justify-between static ">
            <div class="h-max flex w-full justify-center static">
                <span>
                    Mostrando {{ from }} a {{ to }} de {{ total }} resultados
                </span>
            </div>
        </div>
        <div class="flex flex-wrap -mb-1">
            <div class="flex items-center justify-center">
                <span @click="previous()" class="flex items-center justify-center px-4 py-3 mb-1 text-sm leading-4 bg-white border cursor-pointer hover:bg-white focus:text-indigo-500" :class="{ 'flex justify-center items-center mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border': page_number === 1}">
                    <double-arrow-left  
                        :icon_height="10" 
                        :icon_width="10" 
                        :settings="'fill-current text-blue-600 mr-1'" 
                    />
                    Anterior
                </span>
                <span 
                    v-for="(link, index) in pages" 
                    :key="index"
                >
                    <p
                        @click="searchLink(link.number)"
                        :class="{ 'bg-blue-500 text-white hover:bg-blue-600': page_number === link.number }"
                        class="px-4 py-3 mb-1 text-sm leading-4 border cursor-pointer hover:bg-white focus:text-indigo-500"
                    >
                        {{link.number}}
                    </p>
                </span>
                <span 
                    @click="next()" 
                    class="flex items-center justify-center px-4 py-3 mb-1 text-sm leading-4 bg-white border cursor-pointer hover:bg-white focus:text-indigo-500" 
                    :class="{ 'flex justify-center items-center mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border': page_number === getLinks().length}"
                >
                    Próximo
                    <double-arrow-right
                        :icon_height="10"
                        :icon_width="10"
                        :settings="'fill-current text-blue-600 ml-1'"
                    />
                </span>
            </div>
        </div>
    </div>
</template>