<script setup>
import BaseButton from '@/Components/Utilities/BaseButton.vue'
import BaseInput from '@/Components/Utilities/BaseInput.vue'
import BaseLabel from '@/Components/Utilities/BaseLabel.vue'
import ErrorMessage from '@/Components/Utilities/ErrorMessage.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { trans } from 'laravel-vue-i18n'
import { onMounted, ref } from 'vue'

const page = usePage()
let logo_url = ref('')
const props = defineProps({
    email: { type: String, required: true },
    token: { type: String, required: true },
})

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('password.store'))
}

onMounted(() => {
    logo_url.value = page.props.logo_landscape
})
</script>
<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <img
            v-if="logo_url"
            :src="logo_url"
            class="w-96"
        >
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <div>
                    <base-label for="email">
                        {{$t('Email')}}
                    </base-label>
                    <base-input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        :value="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <error-message
                        class="mt-2"
                        :message="form.errors.email"
                    />
                </div>
                <div class="mt-4">
                    <base-label for="password">
                        {{$t('Password')}}
                    </base-label>
                    <base-input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="password"
                    />
                    <error-message
                        class="mt-2"
                        :message="form.errors.password"
                    />
                </div>
                <div class="mt-4">
                    <base-label for="password_confirmation">
                        {{$t('Password Confirmation')}}
                    </base-label>
                    <base-input
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <error-message
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <base-button
                        class="w-fit"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{$t('Reset Password')}}
                    </base-button>
                </div>
            </form>
        </div>
    </div>
</template>