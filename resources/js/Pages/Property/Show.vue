<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    property: Object,
})
</script>

<template>
    <Head :title="property.item_name" />
    <AppLayout>

        <!-- <a :href="'/properties/view-pdf/' + props.property.id" target="_blank">{{ property.document }}</a> -->
        <div class="py-12 px-8 w-full">
            <div class="flex items-start rounded-lg bg-white shadow-md">
                <div class="w-[700px] h-auto overflow-hidden">
                    <img :src="property.photo_url" alt="" class="object-cover h-full w-full rounded-l-lg">
                </div>
                <div class="p-4 w-full">
                    <!-- <h1 class="text-lg font-semibold text-gray-700 mb-2">Property Details</h1> -->

                    <table class="max-w-6xl w-full mb-4">
                        <tbody>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Property number</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.property_no }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Property name</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.item_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Serial number</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.serial_no }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Category</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.category.catname }} > {{ property.subcategory.subcatname }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Description</th>
                                <td class="text-sm text-gray-900 px-4 py-1">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum voluptatum adipisci eveniet molestiae deserunt maxime laborum cumque dignissimos, provident inventore error officia nobis possimus magni natus enim omnis aliquid deleniti.</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Units</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.unit_value }} {{ property.measurement_unit }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Received from</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.receiving_employee.fname }} {{ property.receiving_employee.lname }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Assigned to</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.assigned_employee.fname }} {{ property.assigned_employee.lname }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Office</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.office.office_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Date acquired</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.date_acquired }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Acquisition type</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.acquisition.name }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Status</th>
                                <td class="text-sm text-gray-900 px-4 py-1">{{ property.status }}</td>
                            </tr>
                            <tr>
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-1">Document</th>
                                <td class="text-sm text-gray-900 px-4 py-1"><a :href="'/properties/view-pdf/' + property.id" target="_blank" class="inline-flex items-center text-blue-600 underline visited:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                {{ property.document }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex items-center justify-end space-x-2">
                        <Link :href="route('property.edit', property.id)" class="inline-flex items-center px-4 py-2 text-sm text-white font-medium bg-blue-600 rounded-lg shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                            Edit
                        </Link>

                        <button class="inline-flex items-center px-4 py-2 text-sm text-white font-medium bg-red-600 rounded-lg shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>