<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import Accordion from '@/Components/Accordion.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    categories: Object,
})

const toggledCategories = ref([]);

const showSubcategories = (category) => {
    if(toggledCategories.value.includes(category)) {
        const index = toggledCategories.value.indexOf(category);
        toggledCategories.value.splice(index, 1);
    } else {
        toggledCategories.value.push(category);
    }
}

const show = ref(false);
const categoryToDelete = ref({})

const closeModal = () => {
    show.value = false;
}

const deleteCategory = (category) => {
    categoryToDelete.value = category;
    show.value = true;
}

const confirmDelete = () => {
    router.delete(route('category.destroy', categoryToDelete.value.id), {
        onSuccess: () => closeModal()
    });
}

const cancelDelete = () => {
    closeModal();
    categoryToDelete.value = {};
}
</script>

<template>
    <Head title="Categories" />

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Property Categories</h2>
            </div>
        </template>

        <div class="py-4">
            <div class="w-full px-6">
                <div class="mt-4 max-w-3xl">
                    <Link :href="route('category.create')" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg">Add Category</Link>
                    
                    <div class="p-2 flex flex-col space-y-2 bg-white shadow-md rounded-lg mt-4">
                        <div v-for="category in categories.data" :key="category.id">
                            <div class="flex items-center space-x-2 p-2 bg-gray-50 hover:bg-gray-100 rounded-lg">
                                <div @click="showSubcategories(category.id)" role="button" class="flex-1">
                                    <h6 class="text-sm text-gray-700 font-medium">{{ category.catname }}</h6>
                                    <p class="text-xs text-gray-500">{{ category.code }}</p>
                                </div>
                                <div class="shrink-0 flex items-center justify-center space-x-2">
                                    <Link :href="route('category.edit', category.id)" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </Link>
                                    <button @click="deleteCategory(category)" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div v-if="toggledCategories.includes(category.id)">
                                <ul class="flex flex-col space-y-2 mt-2 ml-8">
                                    <li v-for="subcategory in category.subcategories" :key="subcategory.id">
                                        <div class="flex items-center space-x-2 p-2 bg-gray-50 hover:bg-gray-100 rounded-lg">
                                            <div class="flex-1">
                                                <h6 class="text-sm text-gray-700 font-medium">{{ subcategory.subcatname }}</h6>
                                                <p class="text-xs text-gray-500">{{ subcategory.code }}</p>
                                            </div>
                                            <div class="shrink-0 flex items-center justify-center space-x-2">
                                                <span class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                </span>
                                                <span class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2 p-4 bg-gray-50 hover:bg-gray-100 rounded-lg">
                                            <Link :href="route('subcategory.create', category.id)" class="text-sm text-gray-700">&#x2B; Add subcategory</Link>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>

    <Modal maxWidth="md" :show="show" @close="closeModal">
        <div class="p-5">
            <h1 class="text-lg text-gray-700 font-semibold">Delete confirmation</h1>
            <p class="text-sm text-gray-500">Are you sure you want to delete "{{ categoryToDelete.catname }}"?</p>
            <div class="flex justify-end items-center space-x-2">
                <button type="button" @click="confirmDelete" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium rounded-lg mt-2">
                    Confirm
                </button>
                <button type="button" @click="cancelDelete" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg mt-2">
                    Cancel
                </button>
            </div>
        </div>
    </Modal>
</template>