<script setup>
import { ref } from "vue";

const props = defineProps({
    mimeType: {
        type: [String, null],
    },
})

const emits = defineEmits(['change']);

const fileInput = ref(null);
const fileName = ref(props.fileName);

const handleFileUpload = () => {
    fileName.value = fileInput.value.files[0].name;
    emits('change', fileInput.value.files[0]);
}
</script>

<template>
    <div>
        <input type="file" id="photo" @change="handleFileUpload" class="hidden" ref="fileInput" :accept="mimeType">
        <div class="flex items-center">
            <button type="button" @click="$refs.fileInput.click()" class="shrink-0 inline-flex items-center px-3 py-1.5 text-sm font-medium border rounded-md border-gray-400 text-gray-800 bg-gray-200 hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 0 1 1.06 0l4.5 4.5a.75.75 0 0 1-1.06 1.06l-3.22-3.22V16.5a.75.75 0 0 1-1.5 0V4.81L8.03 8.03a.75.75 0 0 1-1.06-1.06l4.5-4.5ZM3 15.75a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                </svg>
                               
                Browse File
            </button>
            <div v-if="!fileName" class="text-sm truncate px-2">No file selected</div>
            <div v-else class="text-sm truncate px-2">{{ fileName }}</div>
        </div>
    </div>
</template>