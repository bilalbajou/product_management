<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <div class="flex flex-col items-center justify-center w-screen h-screen bg-gray-200 text-gray-700">
        <h1 class="font-bold text-2xl">Welcome Back 😜 </h1>
        <form @submit.prevent="submit" class="flex flex-col bg-white rounded shadow-lg p-12 mt-12" action="">
            <label class="font-semibold text-xs">Email</label>
            <input v-model="form.email"
                class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2"
                autocomplete="username" autofocus required>
            <InputError class="mt-2" :message="form.errors.email" />
            <label class="font-semibold text-xs mt-3">Password</label>
            <input type="password" v-model="form.password"
                class="flex items-center h-12 px-4 w-64 bg-gray-200 mt-2 rounded focus:outline-none focus:ring-2" required
                autocomplete="current-password">
            <InputError class="mt-2" :message="form.errors.password" />
            <div class="block mt-2">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>
            <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 rounded font-semibold text-sm text-blue-100 hover:bg-blue-700">Login</button>
            <div class="flex mt-6 justify-center text-xs">
                <Link v-if="canResetPassword" :href="route('password.request')" class="text-blue-400 hover:text-blue-500"
                    href="#">Forgot Password</Link>
                <span class="mx-2 text-gray-300">/</span>
                <Link :href="route('register')" class="text-blue-400 hover:text-blue-500" href="#">Sign Up</Link>
            </div>
        </form>


</div></template>
