<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

defineProps({
    categories: Array,
    offices: Array,
    acquisitions: Array,
    employees: Array
})

const form = useForm({
    property_no: '',
    item_name: '',
    category_id: '',
    subcategory_id: '',
    description: '',
    serial_no: '',
    measurement_unit: '',
    unit_value: '',
    acquisition_id: '',
    received_from: '',
    office_id: '',
    assigned_to: '',
    date_acquired: '',
    status: '',
    photo: '',
    document: '',
})

const submit = () => {
    form.post(route('property.store'), {
        onSuccess: () => form.reset()
    })
}

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
        name: "Create Property",
        url: null,
    },
];
</script>

<template>
    <Head title="Create Property" />
    <AppLayout>
        <div class="w-full py-12 px-8">
            <Breadcrumb :crumbs="crumbs" />

            <h1 class="text-2xl text-gray-700 font-bold mt-3 mb-2">Create New Property</h1>

            <hr>

            <div class="flex items-start mt-6">
                <div class="w-full max-w-xl">
                    <div class="mb-4">
                        <InputLabel for="property-no" value="Property number"/>
                        <TextInput id="property-no" v-model="form.property_no" class="w-full text-sm"/>
                        <InputError :message="form.errors.property_no"/>
                    </div>
                    <div class="mb-4">
                        <InputLabel for="property-name" value="Property name"/>
                        <TextInput id="property-name" v-model="form.item_name" class="w-full text-sm"/>
                        <InputError :message="form.errors.item_name"/>
                    </div>
                    <div class="mb-4 flex space-x-3">
                        <div class="w-full">
                            <InputLabel for="category" value="Category"/>
                            <select v-model="form.category_id" id="category" class="w-full text-sm">
                                <option value="">Select category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.catname }}</option>
                            </select>
                            <InputError :message="form.errors.category_id"/>
                        </div>
                        <div class="w-full">
                            <InputLabel for="category" value="Subcategory"/>
                            <select v-model="form.subcategory_id" id="category" class="w-full text-sm">
                                <option value="">Select subcategory</option>
                            </select>
                            <InputError :message="form.errors.item_name"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>