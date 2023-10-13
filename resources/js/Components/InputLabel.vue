<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block font-bold text-[12px] ml-2 text-[#616161]">
        <span v-if="value">{{ value }}:</span>
        <span v-else>
            <slot />
        </span>
    </label>
</template>
