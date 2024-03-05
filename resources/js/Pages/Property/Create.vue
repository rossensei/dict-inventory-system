<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';

const props = defineProps({
    categories: Array,
    offices: Array,
    acquisitions: Array,
    employees: Array
})

// const categoryCode = ref('');
// const subcategoryCode = ref('');
const p = ref('');

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

const subcategories = ref([]);

const getSubcategories = (e) => {
    if(!e.target.value || e.target.value === '') {
        subcategories.value = [];
        form.subcategory_id = "";
        return;
    }

    props.categories.forEach(category => {
        if(category.id == e.target.value) {
            form.property_no = "";
            form.property_no += category.code + '-';
            subcategories.value = category.subcategories;
            form.subcategory_id = "";
            p.value = category.code + "-";
        }
    })
}



const appendSubcategoryCode = (e) => {
    if(!e.target.value || e.target.value === '') {
        return;
    }

    subcategories.value.forEach(subcategory => {
        if(subcategory.id == e.target.value) {
            form.property_no = "";
            form.property_no = p.value + subcategory.code + '-';
        }
    })

    // p.value = '';
}
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
                    <!-- <div class="mb-4">
                        <InputLabel for="property-no" value="Property number"/>
                        <TextInput id="property-no" v-model="form.property_no" class="w-full text-sm"/>
                        <InputError :message="form.errors.property_no"/>
                    </div> -->
                    <div class="mb-4">
                        <InputLabel for="property-name" value="Property name"/>
                        <TextInput id="property-name" v-model="form.item_name" class="w-full text-sm"/>
                        <InputError :message="form.errors.item_name"/>
                    </div>
                    <div class="mb-4 flex space-x-3">
                        <div class="w-full">
                            <InputLabel for="category" value="Category"/>
                            <SelectInput v-model="form.category_id" id="category" class="w-full text-sm" @change="getSubcategories($event)">
                                <option value="">Choose category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.catname }} {{ category.code }}</option>
                            </SelectInput>
                            <InputError :message="form.errors.category_id"/>
                        </div>
                        <div class="w-full">
                            <InputLabel for="subcategory" value="Subcategory"/>
                            <SelectInput v-model="form.subcategory_id" id="subcategory" class="w-full text-sm" @change="appendSubcategoryCode($event)">
                                <option value="">Choose subcategory</option>
                                <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">{{ subcategory.subcatname }} {{ subcategory.code }}</option>
                            </SelectInput>
                            <InputError :message="form.errors.subcategory_id"/>
                        </div>
                    </div>
                    <div class="mb-4 flex space-x-3">
                        <div class="w-full">
                            <InputLabel for="unit-value" value="Unit Value"/>
                            <TextInput
                            id="unit-value"
                            type="number"
                            class="w-full text-sm"
                            v-model="form.unit_value"
                            />
                            <InputError :message="form.errors.unit_value"/>
                        </div>
                        <div class="w-full">
                            <InputLabel for="measurement-unit" value="Measurement Unit"/>
                            <TextInput
                            id="measurement-unit"
                            class="w-full text-sm"
                            v-model="form.measurement_unit"
                            />
                            <InputError :message="form.errors.measurement_unit"/>
                        </div>
                    </div>
                    <div class="mb-4">
                        <InputLabel for="property-no" value="Property number"/>
                        <TextInput id="property-no" v-model="form.property_no" class="w-full text-sm"/>
                        <InputError :message="form.errors.property_no"/>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>