<template>
    <button :type="type" class="inline-flex items-center px-4 py-2
    border-transparent rounded-md font-semibold text-xs transition ease-in-out
    uppercase tracking-widest focus:outline-none focus:shadow-outline-gray
    duration-150

    bg-personal-colors-button-background hover:bg-personal-colors-button-hover text-button-text
    focus:bg-personal-colors-button-background
    active:bg-personal-colors-button-background
    "
    >
        <slot

        ></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
