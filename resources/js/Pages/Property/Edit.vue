<script setup>
import FileInput from '@/Components/FileInput.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import SelectInput from '@/Components/SelectInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    property: Object,
    categories: Array,
    offices: Array,
    employees: Array,
    acquisitions: Array,
})

const subcategories = ref([]);
const categoryCode = ref('');

const form = useForm({
    _method: 'PATCH',
    property_no: props.property.property_no,
    category_id: props.property.category_id,
    subcategory_id: props.property.subcategory_id,
    item_name: props.property.item_name,
    description: props.property.description,
    serial_no: props.property.serial_no,
    measurement_unit: props.property.measurement_unit,
    unit_value: props.property.unit_value,
    acquisition_id: props.property.acquisition_id,
    received_from: props.property.received_from,
    office_id: props.property.office_id,
    assigned_to: props.property.assigned_to,
    date_acquired: props.property.date_acquired,
    status: props.property.status,
    photo: null,
    document: null
})

const getSubcategories = (e) => {
    // ensure value is not null or empty string
    if(!e.target.value || e.target.value === '') {
        subcategories.value = [];
        form.subcategory_id = "";
        return;
    }

    // find the category and assign the subcategories to a variable
    props.categories.forEach(category => {
        if(category.id == e.target.value) {
            form.property_no = "";
            form.property_no += category.code + '-';
            subcategories.value = category.subcategories;
            form.subcategory_id = "";
            categoryCode.value = category.code + "-";
        }
    })
}



const appendSubcategoryCode = (e) => {
    // ensure value is not null or empty string
    if(!e.target.value || e.target.value === '') {
        return;
    }

    /**
     * find the selected subcategory and assign the
     * code along with the category code to the field
    */
    subcategories.value.forEach(subcategory => {
        if(subcategory.id == e.target.value) {
            form.property_no = "";
            form.property_no = categoryCode.value + subcategory.code + '-';
        }
    })
}

onMounted(() => {
    props.categories.forEach(category => {
        if(category.id == props.property.category_id) {
            subcategories.value = category.subcategories;
        }
    })
})

// HANDLE DOCUMENT INPUT
// const fileName = ref(null);
// const fileSize = ref(null);

const handleDocumentUpload = (file) => {
    form.document = file;
}

// HANDLE PHOTO UPLOAD
const photoPreview = ref(null);

const handlePhotoUpload = (file) => {
    const photo = file;

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);

    form.photo = file;
}

const submit = () => {
    form.post(route('property.update', props.property.id))
}
</script>
<template>
    <Head :title="property.item_name" />

    <AppLayout>
        <div class="py-12 px-8 w-full">
            <h1 class="text-xl font-semibold text-gray-700">Edit property details</h1>
            <form @submit.prevent="submit">
                <div class="flex items-start mt-3">
                    <div class="max-w-2xl w-full">
                        <div class="mb-4">
                            <InputLabel for="property-name" value="Property name"/>
                            <TextInput id="property-name" v-model="form.item_name" class="w-full text-sm"/>
                            <InputError :message="form.errors.item_name"/>
                        </div>

                        <div class="mb-4">
                            <InputLabel for="serial_no" value="Serial number"/>
                            <TextInput id="serial_no" v-model="form.serial_no" class="w-full text-sm"/>
                            <InputError :message="form.errors.serial_no"/>
                        </div>

                        <div class="mb-4 flex space-x-3">
                            <div class="w-full">
                                <InputLabel for="category" value="Category"/>
                                <SelectInput v-model="form.category_id" id="category" class="w-full text-sm" @change="getSubcategories($event)">
                                    <option value="">Choose category</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">[{{ category.code }}] {{ category.catname }} </option>
                                </SelectInput>
                                <InputError :message="form.errors.category_id"/>
                            </div>
                            <div class="w-full">
                                <InputLabel for="subcategory" value="Subcategory"/>
                                <SelectInput v-model="form.subcategory_id" id="subcategory" class="w-full text-sm" @change="appendSubcategoryCode($event)">
                                    <option value="">Choose subcategory</option>
                                    <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">[{{ subcategory.code }}] {{ subcategory.subcatname }}</option>
                                </SelectInput>
                                <InputError :message="form.errors.subcategory_id"/>
                            </div>
                        </div>

                        <div class="mb-4">
                            <InputLabel for="property-number" value="Property number"/>
                            <TextInput id="property-number" v-model="form.property_no" class="w-full text-sm"/>
                            <InputError :message="form.errors.property_no"/>
                        </div>

                        <div class="mb-4">
                            <InputLabel for="description" value="Description"/>
                            <Textarea v-model="form.description" id="description" class="w-full text-sm h-28" />
                            <InputError :message="form.errors.description"/>
                        </div>

                        <div class="mb-4">
                            <InputLabel for="office" value="Assigned Office"/>
                            <SelectInput v-model="form.office_id" id="office" class="w-full text-sm">
                                <option value="">Choose office</option>
                                <option v-for="office in offices" :key="office.id" :value="office.id">{{ office.office_name }}</option>
                            </SelectInput>
                            <InputError :message="form.errors.office_id"/>
                        </div>

                        <div class="mb-4">
                            <InputLabel for="acquisition-type" value="Acquisition type"/>
                            <SelectInput v-model="form.acquisition_id" id="acquisition-type" class="w-full text-sm">
                                <option value="">Select acquisition type</option>
                                <option v-for="acquisition in acquisitions" :key="acquisition.id" :value="acquisition.id">{{ acquisition.name }}</option>
                            </SelectInput>
                            <InputError :message="form.errors.acquisition_id"/>
                        </div>

                        <div class="mb-4">
                            <InputLabel for="acquisition-date" value="Acquisition date"/>
                            <TextInput type="date" id="acquisition-date" v-model="form.date_acquired" class="w-full text-sm"/>
                            <InputError :message="form.errors.date_acquired"/>
                        </div>
                    </div>
                    <div class="max-w-2xl w-full ml-4">

                        <div class="mb-4 flex space-x-3">
                            <div class="w-full">
                                <InputLabel for="receiving-emp" value="Received from"/>
                                <SelectInput v-model="form.received_from" id="receiving-emp" class="w-full text-sm">
                                    <option value="">Choose employee</option>
                                    <option v-for="emp in employees" :key="emp.id" :value="emp.id">{{ `${emp.fname} ${emp.lname}` }}</option>
                                </SelectInput>
                                <InputError :message="form.errors.received_from"/>
                            </div>
                            <div class="w-full">
                                <InputLabel for="assigned-emp" value="Assigned to"/>
                                <SelectInput v-model="form.assigned_to" id="assigned-emp" class="w-full text-sm">
                                    <option value="">Choose employee</option>
                                    <option v-for="emp in employees" :key="emp.id" :value="emp.id">{{ `${emp.fname} ${emp.lname}` }}</option>
                                </SelectInput>
                                <InputError :message="form.errors.assigned_to"/>
                            </div>
                        </div>

                        <div class="mb-4 flex space-x-3">
                            <div class="w-full">
                                <InputLabel for="unit_value" value="Unit Value"/>
                                <TextInput id="unit_value" type="number" v-model="form.unit_value" class="w-full text-sm" />
                                <InputError :message="form.errors.unit_value"/>
                            </div>
                            
                            <div class="w-full">
                                <InputLabel for="measurement_unit" value="Measurement Unit"/>
                                <TextInput id="measurement_unit" type="text" v-model="form.measurement_unit" class="w-full text-sm" />
                                <InputError :message="form.errors.measurement_unit"/>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="block font-medium text-sm text-gray-700">Status:</p>
                            <div class="flex flex-wrap">
                                <div class="flex items-center me-4">
                                    <input id="serviceable" type="radio" v-model="form.status" name="status" value="Serviceable">
                                    <label for="serviceable" class="ms-2 text-sm">Serviceable</label>
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="unserviceable" type="radio" v-model="form.status" name="status" value="Unserviceable">
                                    <label for="unserviceable" class="ms-2 text-sm">Unserviceable</label>
                                </div>
                            </div>
                            <InputError :message="form.errors.status"/>
                        </div>

                        <div class="mb-4">
                            <InputLabel for="document" value="Document"/>
                            <FileInput mimeType=".pdf" @change="handleDocumentUpload" />
                            <div v-if="property.document" class="flex items-center space-x-2 mt-2 bg-white p-3 shadow-sm rounded-lg border">
                                <div class="shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                                                           
                                </div>
                                <div class="block leading-3">
                                    <p class="flex-1 text-sm truncate font-medium text-gray-700">{{ property.document }}</p>
                                </div>
                            </div>
                            <InputError :message="form.errors.document"/>
                        </div>

                        <div class="mb-4">
                            <InputLabel for="photo" value="Photo"/>
                            <FileInput mimeType="image/png, image/jpeg, image/jpg" @change="handlePhotoUpload" />
                            <InputError :message="form.errors.photo"/>

                            <div class="h-[150px] w-[150px] mt-4">
                                <img v-if="property.photo_url && !photoPreview" :src="property.photo_url" alt="item_photo" class="object-cover w-full h-full rounded-lg">
                                <img v-else :src="photoPreview" alt="item_photo" class="object-cover w-full h-full rounded-lg">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 rounded-lg shadow-md text-white text-sm font-medium">Save changes</button>
            </form>
        </div>
    </AppLayout>
</template>