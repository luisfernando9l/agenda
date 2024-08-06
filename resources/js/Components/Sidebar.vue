<script setup>
import SystemExit from '@/Components/Icons/SystemExit.vue'
import ProfileUser from '@/Components/Icons/ProfileUser.vue'
import { router, usePage } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';

const page = usePage()

const logout = () => {
    router.post(route('logout'));
}

const sideBarItemsClass = computed(() => {
    let classes = "flex justify-center text-gray-500"
    classes += ' max-h-[calc(100dvh_-_160px)]'
    classes += ' overflow-y-auto'
    return classes
})

</script>
<template>
    <nav class="bg-cyan-200 w-full h-full justify-between flex flex-col shadow-lg">
        <div class="flex flex-col justify-between flex-1 w-full">
            <div class="h-full flex flex-col w-full">
                <div class="h-24 flex justify-center items-center py-4 mt-4 border-b-1 border-gray-300 shadow">
                    <a
                        href="#"
                        aria-label="logo"
                    >
                        LOGO
                    </a>
                </div>
                <div
                    :class="sideBarItemsClass"
                    class="flex-grow flex-1 w-full px-2"
                >
                    <div class="w-full flex flex-grow flex-1 flex-col items-center justify-start gap-4 py-2">
                        <inertia-link :href="route('departments')">
                            Ramais
                        </inertia-link>
                        <inertia-link :href="route('departments')">
                            Departamentos
                        </inertia-link>
                        <inertia-link :href="route('departments')">
                            Usuários
                        </inertia-link>
                    </div>
                </div>
                <div class="h-20 border w-full">
                    <div class="w-full h-full text-gray-500 hover:text-black border-t-2 py-2 flex flex-row justify-between items-center bg-gray-200 bg-opacity-40 shadow-inner gap-2 px-3">
                        <div class="flex gap-2 items-center w-full truncate">
                            <div class="flex h-full justify-center items-center">
                                <profile-user 
                                    :icon_width="30" 
                                    :icon_height="30" 
                                    :settings="'fill-current text-gray-500'" 
                                />
                            </div>
                            <div class="flex flex-col truncate">
                                <span class="text-black opacity-60 overflow-ellipsis overflow-hidden font-semibold text-sm" >
                                    {{page.props.auth.user.name}}
                                </span>
                                <span
                                    class="text-black opacity-50 overflow-ellipsis overflow-hidden text-sm"
                                >
                                    {{page.props.auth.user.email}}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <form 
                                method="POST" 
                                @submit.prevent="logout" 
                                class="cursor-pointer hover:text-black w-full text-start hover:bg-gray-200 rounded-md"
                            >
                                <button 
                                    aria-label="system_exit" 
                                    type="submit" 
                                    class="flex flex-col"
                                >
                                    <system-exit 
                                        :color="'fill-current'" 
                                        :icon_width="25" 
                                        :icon_height="25"  
                                        class="inline-block align-middle pt-1" 
                                    />
                                    <p class="inline-block align-middle text-sm font-semibold opacity-80 truncate">
                                        Sair
                                    </p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>