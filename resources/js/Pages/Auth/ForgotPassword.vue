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
    status: { type: String },
})

const form = useForm({
    email: ''
})

const submit = () => {
    form.post(route('password.email'));
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
            <div class="mb-4 text-sm text-gray-600">
                {{ $t('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
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
