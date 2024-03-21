<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import Textarea from '@/Components/Textarea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';

const props = defineProps({
    categories: Array,
    offices: Array,
    acquisitions: Array,
    employees: Array
})

const categoryCode = ref('');

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

const handleDocumentUpload = (e) => {
    form.document = e.target.files[0];
}

// handles photo upload
const photoInput = ref(null);
const photoPreview = ref(null);

const handlePhotoUpload = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);

    form.photo = photoInput.value.files[0];
}

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

const submit = () => {
    // if (photoInput.value) {
    //     form.photo = photoInput.value.files[0];
    // }
    
    form.post(route('property.store'), {
        onSuccess: () => {
            clearPhotoFileInput();
            form.reset();
        }
    })
}

</script>

<template>
    <Head title="Create Property" />

    <AppLayout>
        <div class="w-full py-12 px-8">
            <Breadcrumb :crumbs="crumbs" />

            <h1 class="text-2xl text-gray-700 font-bold mt-3 mb-2">Create New Property</h1>

            <hr>

            <div class="flex items-start space-x-4 mt-6">
                <form @submit.prevent="submit" class="w-full max-w-3xl">
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
                        <InputLabel for="property-no" value="Property number"/>
                        <TextInput id="property-no" v-model="form.property_no" class="w-full text-sm"/>
                        <InputError :message="form.errors.property_no"/>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="serial-no" value="Serial number"/>
                        <TextInput id="serial-no" v-model="form.serial_no" class="w-full text-sm"/>
                        <InputError :message="form.errors.serial_no"/>
                    </div>

                    <div class="mb-4 flex space-x-3">
                        <div class="w-full">
                            <InputLabel for="unit-value" value="Unit Value"/>
                            <TextInput
                            id="unit-value"
                            type="text"
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
                        <InputLabel for="description" value="Description"/>
                        <Textarea v-model="form.description" id="description" class="w-full text-sm h-28" />
                        <InputError :message="form.errors.description"/>
                    </div>
                    
                    <!-- <hr class="mb-4"> -->

                    <div class="mb-4">
                        <InputLabel for="office" value="Assigned Office"/>
                        <SelectInput v-model="form.office_id" id="office" class="w-full text-sm">
                            <option value="">Choose office</option>
                            <option v-for="office in offices" :key="office.id" :value="office.id">{{ office.office_name }}</option>
                        </SelectInput>
                        <InputError :message="form.errors.office_id"/>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="acquisition" value="Acquisition type"/>
                        <SelectInput v-model="form.acquisition_id" id="acquisition" class="w-full text-sm">
                            <option value="">Choose acquisition type</option>
                            <option v-for="acquisition in acquisitions" :key="acquisition.id" :value="acquisition.id">{{ acquisition.name }}</option>
                        </SelectInput>
                        <InputError :message="form.errors.acquisition_id"/>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="received-from" value="Received from"/>
                        <SelectInput v-model="form.received_from" id="received-from" class="w-full text-sm">
                            <option value="">Choose employee</option>
                            <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ `${employee.fname} ${employee.lname}` }}</option>
                        </SelectInput>
                        <InputError :message="form.errors.received_from"/>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="assigned-to" value="Assigned to"/>
                        <SelectInput v-model="form.assigned_to" id="assigned-to" class="w-full text-sm">
                            <option value="">Choose employee</option>
                            <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ `${employee.fname} ${employee.lname}` }}</option>
                        </SelectInput>
                        <InputError :message="form.errors.assigned_to"/>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="date" value="Acquisition Date"/>
                        <TextInput id="date" type="date" v-model="form.date_acquired" class="w-full text-sm"/>
                        <InputError :message="form.errors.date_acquired"/>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="status" value="Status"/>
                        <SelectInput v-model="form.status" id="status" class="w-full text-sm">
                            <option value="">Choose employee</option>
                            <option value="Serviceable">Serviceable</option>
                            <option value="Unserviceable">Unserviceable</option>
                        </SelectInput>
                        <InputError :message="form.errors.status"/>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="document" value="Property Document (Accepts only PDF)"/>
                        <input 
                        id="document" 
                        type="file" 
                        @input="handleDocumentUpload($event)" 
                        class="w-full text-sm" 
                        accept=".pdf"
                        />
                        <InputError :message="form.errors.document"/>
                    </div>

                    <div class="mb-4">
                        <p class="block font-medium text-sm text-gray-700">Photo</p>

                        <div v-if="!photoPreview" class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input 
                                id="dropzone-file" 
                                ref="photoInput"
                                type="file" 
                                @change="handlePhotoUpload"
                                class="hidden" 
                                accept="image/png, image/jpeg, image/jpg" 
                                />
                            </label>
                        </div> 

                        <!-- <label for="photo" class="block font-medium text-sm text-gray-700">
                            <input 
                            id="photo" 
                            ref="photoInput"
                            type="file" 
                            @change="handlePhotoUpload" 
                            class="w-full text-sm hidden" 
                            accept="image/png, image/jpeg, image/jpg"
                            />

                            Upload photo
                        </label> -->
                        
                        <InputError :message="form.errors.photo"/>

                        <div v-if="photoPreview" class="flex items-center justify-center bg-gray-200 mt-4 w-[300px] h-[300px] rounded-lg overflow-hidden relative">

                            <button v-show="photoPreview" type="button" @click="photoPreview = null" class="absolute top-3 right-3 bg-gray-500 hover:bg-gray-400 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <img v-show="photoPreview" :src="photoPreview" alt="user-photo" class="object-cover h-full w-full">
                        </div>
                    </div>

                    <button type="submit" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg">Add property</button>
                </form>

                <!-- <div class="w-full max-w-xl">
                    
                </div> -->
            </div>
        </div>
    </AppLayout>
</template>