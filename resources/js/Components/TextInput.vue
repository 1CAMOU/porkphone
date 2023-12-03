<script setup>
import { onMounted, ref } from 'vue'

const props = defineProps({
    type: String,
    modelValue: {
        type: String,
        required: true,
    },
    placeholder: {
        type: String,
    },
})

const emit = defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus()
    }
})

defineExpose({ focus: () => input.value.focus() })

const handleInput = (event) => {
    if (props.type === 'email') {
        event.target.value = event.target.value.toLowerCase()
    }

    emit('update:modelValue', event.target.value)
}
</script>

<template>
    <input
        class="rounded-md border-gray-300 text-sm placeholder-gray-400 shadow-sm focus:border-primary focus:ring-orange-300"
        :value="modelValue"
        :placeholder="placeholder"
        :type="type"
        @input="(event) => handleInput(event)"
        ref="input"
    />
</template>
