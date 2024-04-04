<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import Tooltip from '@/Components/Tooltip.vue';
import Modal from '@/Components/Modal.vue';
import FallbackUserPhoto from '@/Components/FallbackUserPhoto.vue';
import Pagination from '@/Components/Pagination.vue';
import { ref } from 'vue';

const props = defineProps({
    employees: Object
})

// Update Employee Status
const updateEmployeeStatus = (employeeId) => {
    router.post('/employees/toggle-status/' + employeeId, {
        preserveScroll: true,
    })
}
</script>

<template>
    <Head title="Employees" />
    <AppLayout>
        <div class="py-12">
            <div class="w-full px-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl text-gray-700 font-bold">Employees</h1>
                        <p class="text-sm text-gray-500 mb-4">Manage all the information of the employees.</p>
                    </div>

                    <Link href="/employees/create" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-md">Add Employee</Link>
                </div>
    
                <div class="relative overflow-hidden overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID NO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="emp in employees.data" :key="emp.id" class="bg-white hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ emp.id_no }}
                                </th>
                                <td class="px-6 py-4 flex items-center">
                                    <div v-show="emp.profile_photo_url" class="rounded-full w-10 h-10 overflow-hidden">
                                        <img :src="emp.profile_photo_url" class="object-cover h-full w-full" alt="profile pic">
                                    </div>
                                    <FallbackUserPhoto v-show="!emp.profile_photo_url" :firstname="emp.fname" :lastname="emp.lname" />

                                    <div class="ps-3">
                                        <div class="text-base font-medium text-gray-700">{{ `${emp.fname} ${emp.mname[0]}. ${emp.lname}` }}</div>
                                        <div class="font-normal text-gray-500">{{ emp.emp_type }}</div>
                                    </div> 
                                </td>
                                <td class="px-6 py-4">
                                    {{ emp.address }}
                                </td>
                                <td class="px-6 py-4">
                                    <label :for="'status-' + emp.id" class="inline-flex items-center mb-5 cursor-pointer">
                                        <input :id="'status-' + emp.id" type="checkbox" :checked="emp.status" @change="updateEmployeeStatus(emp.id)" class="sr-only peer">
                                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                </td>
                                <td class="px-6 py-4">
                                    {{ emp.role}}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <Tooltip text="Edit">
                                            <Link :href="`/employees/edit/${emp.id}`" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                                            </Link>
                                        </Tooltip>
                                        
                                        <Tooltip text="Delete">
                                            <Link :href="route('employee.destroy', emp.id)" method="DELETE" as="button" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </Link>
                                        </Tooltip>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- <Pagination class="mt-4" :data="employees" /> -->
            </div>
        </div>
    </AppLayout>

    <Modal>

    </Modal>
</template>