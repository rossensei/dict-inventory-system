<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useState } from '@/composables/counter.js'

const props = defineProps({
    categoriesCount: Number,
    subcategoriesCount: Number,
    acquisitionsCount: Number,
    employeesCount: Number,
    officesCount: Number,
    propertiesCount: Number,
})

const state = useState();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            <!-- <h1 class="text-2xl text-gray-700 font-bold leading-tight">Dashboard</h1> -->
        </template>

        <div class="w-full px-6 py-4">
            <div class="flex justify-between flex-wrap gap-4">
                <div class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px]">
                    <span class="w-12 h-12 rounded-full text-green-700 bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                        </svg>
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ categoriesCount }}</h1>
                        <p class="text-sm text-gray-500">Categories</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px]">
                    <span class="w-12 h-12 rounded-full text-yellow-700 bg-yellow-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                          </svg>                          
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ subcategoriesCount }}</h1>
                        <p class="text-sm text-gray-500">Sub-Categories</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px]">
                    <span class="w-12 h-12 rounded-full text-purple-700 bg-purple-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                        </svg>                          
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ acquisitionsCount }}</h1>
                        <p class="text-sm text-gray-500">Acquisitions</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px]">
                    <span class="w-12 h-12 rounded-full text-blue-700 bg-blue-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                          </svg>                                                   
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ employeesCount }}</h1>
                        <p class="text-sm text-gray-500">Employees</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px]">
                    <span class="w-12 h-12 rounded-full text-orange-700 bg-orange-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>                                                 
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ officesCount }}</h1>
                        <p class="text-sm text-gray-500">Offices</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px]">
                    <span class="w-12 h-12 rounded-full text-red-700 bg-red-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                          </svg>                                                                          
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ propertiesCount }}</h1>
                        <p class="text-sm text-gray-500">Properties</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
@/composables/counter.js