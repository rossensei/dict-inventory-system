<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    categories: Object,
    filters: Object
})

const showModal = ref(false);
const categoryToDelete = ref(null);

const showConfirmationModal = (category) => {
    categoryToDelete.value = category;
    showModal.value = true;
}

const hideConfirmationModal = () => {
    showModal.value = false;
    categoryToDelete.value = null;
}

const confirmDelete = () => {
    if(categoryToDelete.value) {
        router.delete(route('category.destroy', categoryToDelete.value.id), {
            onFinish: () => hideConfirmationModal()
        });
    }
}

// Search
const search = ref(props.filters.search);

watch(search, debounce(() => {
    let params = {
        search: search.value,
    }

    Object.keys(params).forEach(key => {
        if(params[key] === '' || params[key] === null) {
            delete params[key];
        }
    })

    router.get(route('category.index'), params,{ preserveState: true, replace: true })
}, 300))
</script>

<template>
    <Head title="Categories" />

    <AppLayout>
        <div class="py-12">
            <div class="w-full px-12">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl text-gray-700 font-bold">Categories</h1>

                    <!-- <Link :href="route('category.create')" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create new
                    </Link> -->
                </div>

                <div class="p-4 bg-white mt-4 shadow-md rounded-lg">
                    <!-- <ul class="text-sm w-full bg-white">
                        <li v-for="category in categories.data" :key="category.id">
                            <div class="flex items-center space-x-3 hover:bg-gray-50 p-4 rounded-lg">
                                <div class="flex-1 text-gray-500">
                                    {{ category.catname }} &#8208; <span class="text-gray-700 font-semibold">{{ category.code }}</span>
                                </div>
                                <div class="shrink-0 flex items-center space-x-2">
                                    <Link :href="route('category.edit', category.id)" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </Link>
                                    <button type="button" @click="showConfirmationModal(category)" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul> -->

                    <div class="flex items-center justify-between mb-4">
                        <TextInput
                        v-model="search"
                        id="search"
                        type="search"
                        placeholder="Search..."
                        class="text-sm w-[280px] focus:w-[350px] transition-[width]"
                        />

                        <Link :href="route('category.create')" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Create new
                        </Link>
                    </div>

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Code
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created at
                                </th>
                                <th scope="col" class="px-6 py-3 w-44 text-center">
                                    <!-- <span class="sr-only">Edit</span> -->...
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories.data" :key="category.id" class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ category.code }}
                                </td>
                                <td scope="row" class="px-6 py-4">
                                    {{ category.catname }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ category.created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <Link :href="route('category.edit', category.id)" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </Link>
                                        <button type="button" @click="showConfirmationModal(category)" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>

    <!-- Delete Modal -->
    <Modal :show="showModal" maxWidth="lg" @close="hideConfirmationModal">
        <div class="p-6 space-y-3">
            <div>
                <h1 class="text-xl font-semibold text-red-600 mb-2">Delete Confirmation</h1>
                <p class="font-medium text-sm">You are about to delete "{{ categoryToDelete.catname }}", you will not be able to recover it. Do you want to proceed?</p>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" @click="hideConfirmationModal" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm text-gray-900 font-medium">Cancel</button>
                <button type="button" @click="confirmDelete" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-sm text-white font-medium">Confirm</button>
            </div>
        </div>
    </Modal>
</template>