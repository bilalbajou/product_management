<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({ errors: Object })

import { usePage } from '@inertiajs/vue3'

const page = usePage()


const form = useForm({
    name: null,
    description: null,
    price: null,
    image: null,
    quantity: null
});

const submit = () => {
    form.post(route('products.store'));
 
}


</script>

<template>
    <Head title="Add Product" />

    <AuthenticatedLayout>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="overflow-hidden shadow-sm sm:rounded-lg">

                    <form class="max-w-md mx-auto">
                        
      <div v-if="$page.props.flash.success" class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
  <p>{{ $page.props.flash.success }}</p>
</div>
                        <div v-if="form.hasErrors" role="alert">
                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                Error
                            </div>
                            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                                <p v-for="error in errors">{{ error }}</p>
                               
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="name">Name:</label>
                            <input
                                class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                                v-model="form.name" type="text" placeholder="Product Name">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="description">Description:</label>
                            <textarea v-model="form.description"
                                class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                                rows="3" placeholder="Product Description"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="price">Price (DH):</label>
                            <input v-model="form.price"
                                class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Product Price">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="image">Image :</label>
                            <input @input="form.image = $event.target.files[0]"
                                class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                                type="file">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="quantity">Quantity:</label>
                            <input
                                class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                                v-model="form.quantity" placeholder="Product Quantity">
                        </div>

                        <div class="flex items-center justify-between">
                            <Link preserve-scroll="true" 
                                :disabled="form.processing"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                @click.prevent="submit">Submit
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
