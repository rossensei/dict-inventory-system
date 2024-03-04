<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';

const props = defineProps({
    category: Object,
})

const form = useForm({
    catname: '',
    code: '',
})

const submit = () => {
    form.post(route('category.store'), {
        onSuccess: () => form.reset()
    })
}

const crumbs = [
    {
        name: "Dashboard",
        url: route('dashboard'),
    },
    {
        name: "Categories",
        url: route('category.index'),
    },
    {
        name: "Create Category",
        url: null,
    },
]
</script>
<template>
    <Head title="Create Category" />

    <AppLayout>
        <div class="w-full p-12">
            <Breadcrumb :crumbs="crumbs" class="mb-3" />
            <h1 class="text-2xl text-gray-700 font-bold mb-4">Create Category</h1>

            <form @submit.prevent="submit" class="max-w-xl">
                <div class="mb-4">
                    <InputLabel for="catname" value="Category name" />
                    <TextInput v-model="form.catname" id="catname" class="w-full text-sm" />
                    <InputError :message="form.errors.catname" />
                </div>
                <div class="mb-4">
                    <InputLabel for="code" value="Code" />
                    <TextInput v-model="form.code" id="code" class="w-full text-sm" />
                    <InputError :message="form.errors.code" />
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-700 hover:bg-blue-600 text-sm text-white rounded-lg inline-flex items-center">
                    Submit
                </button>
            </form>
        </div>
    </AppLayout>
</template>