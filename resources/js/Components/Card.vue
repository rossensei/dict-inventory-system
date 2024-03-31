<script setup>
const props = defineProps({
    maxWidth: {
        type: [String, null]
    }
})
</script>

<template>
    <div class="bg-white rounded-lg shadow-sm" :style="'width:' + maxWidth ">
        <slot name="image" />

        <div class="p-2">
            <slot name="body" />
        </div>
    </div>
</template>