<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    property: Object,
})

const crumbs = [
    {
        name: "Dashboard",
        url: route('dashboard'),
    },
    {
        name: "All Properties",
        url: route('property.index'),
    },
    {
        name: props.property.item_name,
        url: null,
    },
];
</script>

<template>
    <Head :title="property.item_name" />
    <AppLayout>

        <!-- <a :href="'/properties/view-pdf/' + props.property.id" target="_blank">{{ property.document }}</a> -->
        <div class="py-6 px-6 w-full">
            <Breadcrumb :crumbs="crumbs" class="mb-4" />

            <h1 class="text-2xl font-semibold text-gray-700">{{ property.item_name }}</h1>

            <hr class="mt-2 mb-3">

            <div class="flex space-x-4 mt-4">
                <!-- image -->
                <div class="h-full w-[500px] overflow-hidden">
                    <img :src="property.photo_url" alt="item-photo" class="object-cover h-full w-full rounded-lg">
                </div>

                <!-- property details -->
                <div class="w-full">
                    <table class="w-full max-w-5xl border">
                        <thead>
                            <th colspan="2" class="px-4 py-2 text-gray-900 text-left border-b">Property Information</th>
                        </thead>
                        <tbody>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Property number</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.property_no }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Property name</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.item_name }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Serial number</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.serial_no }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Category</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.category.catname }} > {{ property.subcategory.subcatname }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Description</th>
                                <td class="text-sm text-gray-900 px-4 py-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Units</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.unit_value }} {{ property.measurement_unit }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Received from</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.receiving_employee.fname }} {{ property.receiving_employee.lname }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Assigned to</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.assigned_employee.fname }} {{ property.assigned_employee.lname }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Office</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.office.office_name }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Date acquired</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.date_acquired }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Acquisition type</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.acquisition.name }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Status</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.status }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Document</th>
                                <td class="text-sm text-gray-900 px-4 py-2"><a :href="'/properties/view-pdf/' + property.document" target="_blank" class="inline-flex items-center text-blue-600 underline visited:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                {{ property.document }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>