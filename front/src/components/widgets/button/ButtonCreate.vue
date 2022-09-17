<template>
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 mx-2 text-white p-1.5 px-3 rounded focus:outline-none focus:shadow-outline">
        <slot name="button_create"></slot>
        <slot name="button_body"></slot>
    </button>
</template>