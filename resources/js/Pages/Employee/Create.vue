<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    photo: null,
    fname: '', 
    mname: '', 
    lname: '',
    address: '', 
    id_no: '',
    emp_type: '', 
    status: '',
    role: ''
})

const photoInput = ref(null)
const photoPreview = ref(null);

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
}

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

const submit = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post('/employees/create', {
        onSuccess: () => {
            clearPhotoFileInput();
            form.reset();
        },
    });
}
</script>

<template>
    <Head title="New Employee" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Create new employee</h1>
                <p class="text-sm text-gray-500 mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus maxime perferendis culpa accusantium expedita nam consequatur aspernatur sequi ullam.</p>
                <!-- <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/fnames/helene-engels.png" alt="" class="rounded-full w-20"> -->
                
                
            </div>
        </div>
    </AppLayout>
</template>