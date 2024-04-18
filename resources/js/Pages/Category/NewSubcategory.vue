<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    category: Object
})

const form = useForm({
    category_id: props.category.id,
    code: '',
    subcatname: '',
})

const submit = () => {
    form.post(route('subcategory.store', props.category.id));
}
</script>

<template>
    <AppLayout>
        <template #header>
            <div class="flex items-center divide-x divide-gray-200">
                <div class="px-2">
                    <Link :href="route('category.index')" class="h-8 w-8 rounded-lg hover:bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                          </svg>                          
                    </Link>
                </div>
                <div class="px-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add subcategory to {{ props.category.catname }}</h2>
                </div>
            </div>
        </template>

        <div class="py-4">
            <div class="w-full px-6">
                <form @submit.prevent="submit" class="max-w-xl">
                    <div class="mb-4">
                        <InputLabel for="subcatname" value="Subcategory name" />
                        <TextInput v-model="form.subcatname" id="subcatname" class="w-full text-sm" />
                        <InputError :message="form.errors.subcatname" />
                    </div>
                    <div class="mb-4">
                        <InputLabel for="code" value="Code" />
                        <TextInput v-model="form.code" id="code" class="w-full text-sm" />
                        <InputError :message="form.errors.code" />
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-lg inline-flex items-center">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>