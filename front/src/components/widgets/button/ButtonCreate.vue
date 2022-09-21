<template>
    <button type="submit" class="bg-primary hover:bg-blue-600 text-white p-1.5 rounded focus:outline-none focus:shadow-outline">
        <slot name="button_create"></slot>
        <slot name="button_body"></slot>
    </button>
</template>