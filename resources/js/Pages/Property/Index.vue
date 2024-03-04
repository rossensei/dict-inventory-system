<script setup>
import TextInput from '@/Components/TextInput.vue';
import PropertyComponent from '@/Components/PropertyComponent.vue';
import LinkButton from '@/Components/LinkButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    properties: Object,

})
</script>
<template>
    <Head title="All Properties" />
    <AppLayout>
        <div class="py-12 px-8 w-full">
            

            <div class="shadow-md">

                <div class="w-full p-5 bg-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-lg font-semibold text-gray-700">All Properties</h1>
                            <p class="mt-1 text-sm font-normal text-gray-500">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                        </div>

                        <LinkButton :href="route('property.create')">Create Property</LinkButton>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <input 
                        type="search" 
                        id="search" 
                        class="rounded-lg text-sm w-[200px] focus:w-[300px] transition-[width] ease-out border-gray-300" 
                        placeholder="Search for properties"
                        >
                    </div>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Property No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Property name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Unit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="property in properties.data" :key="property.id" class="bg-white border-b">
                            <td class="px-6 py-4">
                                {{ property.property_no }}
                            </td>
                            <td class="px-6 py-4">
                                {{ property.item_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ property.status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ property.category.catname }} > {{ property.subcategory.subcatname }}
                            </td>
                            <td class="px-6 py-4">
                                {{ property.unit_value }} {{ property.measurement_unit }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>