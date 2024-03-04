<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    categoriesCount: Number,
    subcategoriesCount: Number,
    acquisitionsCount: Number,
    employeesCount: Number,
    officesCount: Number,
    propertiesCount: Number,
})
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->

        <div class="py-12">
            <div class="w-full px-12">
                <h1 class="text-2xl text-gray-700 font-bold">Dashboard</h1>
                <!-- <p class="text-sm text-gray-500 mb-4">Ensure your account is using a long, random password to stay secure.</p> -->
            </div>
        </div>
    </AppLayout>
</template>
