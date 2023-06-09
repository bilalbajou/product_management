<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


const props = defineProps({
    products:Object
})

const form=useForm({

});

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {

        form.delete(route('products.destroy',id),{
            preserveScroll:true,
            onSuccess:()=>alert('Product deleted successfully')
        });


         
    }

}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>

            <div class="grid grid-cols-2 gap-4 place-content-between ...">
                <div>Product management</div>
                <div class="justify-self-end">
                    <Link :href="route('products.create')"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add product</Link>
                </div>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="flex flex-wrap">
                        <div v-for="product in products" class="w-full md:w-1/3 px-2 mb-4 md:mb-3">
                            <div class="max-w-sm rounded-md overflow-hidden shadow-lg">
                                <img class="w-full h-64 object-cover" :src="product.image ? '/images/'+product.image : 'https://via.placeholder.com/300'"
                                    alt="Product Image">
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{product.name}}</h3>
                                    <p class="text-gray-700 text-base mb-2">{{ product.description }}</p>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-600 font-bold text-xl">{{ product.price }} DH</p>
                                        <div class="flex items-center justify-between">
                                            <button
                                             @click="deleteProduct(product.id)"
                                            class="px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out mr-1">
                                            Delete
                                        </button>
                                        <Link
                                            :href="route('products.edit',product.id)"
                                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">
                                            Update
                                        </Link>
                                        </div>
                                       
                                        
                                    </div>
                                </div>
                            </div>


                        </div>

                        
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
