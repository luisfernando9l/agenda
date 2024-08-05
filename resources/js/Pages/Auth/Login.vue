<script setup>
import BaseButton from '@/Components/Utilities/BaseButton.vue'
import BaseInput from '@/Components/Utilities/BaseInput.vue'
import BaseLabel from '@/Components/Utilities/BaseLabel.vue'
import ErrorMessage from '@/Components/Utilities/ErrorMessage.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3'
import { trans } from 'laravel-vue-i18n'
import { onMounted, ref } from 'vue'
import axios from 'axios'

let logo_url = ref('')
const props = defineProps({
    canResetPassword: { type: Boolean },
    status: { type: String },
    logo_landscape: { type: String },
})

const form = useForm({
    email: '',
    password: '',
})

const checkUserCompanyDomain = async () => {
    await axios.get('/api/domain?email=' + form.email)
        .then((response) => {
            logo_url.value = response.data.logo_landscape
        }).catch(()=> {
            logo_url.value = props.logo_landscape
        })
}

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}

onMounted(() => {
    logo_url.value = props.logo_landscape
})
</script>
<template>
    <GuestLayout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <img
            v-if="logo_url"
            :src="logo_url"
            class="w-96"
        >
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div
                v-if="status"
                class="mb-4 font-medium text-sm text-green-600"
            >
                {{ status }}
            </div>
            <form @submit.prevent="submit">
                <div>
                    <base-label for="email">
                        Email
                    </base-label>
                    <base-input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="email"
                        @change="checkUserCompanyDomain"
                    />
                    <error-message
                        class="mt-2"
                        :message="form.errors.email"
                    />
                </div>
                <div class="mt-4">
                    <base-label for="password">
                        Senha
                    </base-label>
                    <base-input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                    <error-message
                        class="mt-2"
                        :message="form.errors.password"
                    />
                </div>
                <div class="flex flex-col justify-center items-center gap-2 w-full py-3 text-center">
                    <base-button
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Entrar
                    </base-button>
                    <div class="w-full flex md:flex-row xs:flex-col xs:justify-center md:justify-between items-center mt-4">
                        <inertia-link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Esqueceu sua senha ?
                        </inertia-link>
                        <inertia-link
                            :href="route('register')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Não possui conta ?
                        </inertia-link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</GuestLayout>
</template>