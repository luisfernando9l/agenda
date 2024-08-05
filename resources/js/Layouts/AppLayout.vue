<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Sidebar from '@/Components/Sidebar.vue'
import MenuHamburguer from '@/Components/MenuHamburguer.vue'


const page = usePage()
let retracted_logo = page.props.logged_user_company ? page.props.logged_user_company.data.logo_square : ''
let expanded_logo = page.props.logged_user_company ? page.props.logged_user_company.data.logo_landscape : ''

const sidebar_show = computed(() => {
    return !page.url.replace('/','').includes('analysis') && !page.url.replace('/','').includes('home') || page.url.replace('/','').includes('laboratory-analysis')
})
</script>
<template>
    <div v-if="page.url.replace('/','').includes('home')">
        <div
            :class="page.props.level ? ((page.props.level.id == 2 || page.props.level.id == 3 || page.props.level.id == 6) ? 'h-dev-admin flex flex-col justify-between' : 'h-screen') : 'h-dvh'"
            class="h-dvh"
        >
            <slot>
            </slot>
        </div>
    </div>
    <div
        v-else
        class="flex flex-col min-h-dvh min-w-full"
    >
        <div
            v-if="sidebar_show"
            class="xs:block sm:block md:block lg:hidden xl:hidden 2xl:hidden"
        >
            <menu-hamburguer
                :expanded_logo="expanded_logo"
                :retracted_logo="retracted_logo"
            />
        </div>
        <div>
            <div class="xs:hidden sm:hidden md:hidden lg:block xl:block 2xl:block">
                <sidebar
                    v-if="sidebar_show"
                    :expanded_logo="expanded_logo"
                    :retracted_logo="retracted_logo"
                />
            </div>
            <div>
                <div :class="page.props.level ? ((page.props.level.id == 2 || page.props.level.id == 3 || page.props.level.id == 6) ? 'h-dev-admin flex flex-col justify-between' : 'h-dvh') : 'h-dvh'">
                    <div
                        :class="sidebar_show ? 'flex flex-col max-h-full overflow-y-auto' : 'flex flex-col h-full overflow-y-auto'"
                        scroll-region
                    >
                        <div class="w-full xs:px-2 md:pl-20 md:pr-4">
                            <slot name="header">
                            </slot>
                        </div>
                        <div class="w-full shadow-inner">
                            <div class="xs:px-2 md:pl-20 md:pr-4 w-full">
                                <slot name="body">
                                </slot>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page.props.level && !page.url.replace('/','').includes('home')">
            <div v-if="page.props.level.id == 2 || page.props.level.id == 3" class=" h-8 bg-red-500 inset-x-0 text-white font-bold flex flex-row items-center justify-center">
                {{ $t("Logged in as administrator") }}
            </div>
            <div
                v-if="page.props.level.id == 6"
                class=" h-8 bg-black inset-x-0 text-white font-bold flex flex-row items-center justify-center">
                {{ $t("Logged in with a level") }} {{page.props.level.name}}
            </div>
        </div>
    </div>
</template>
