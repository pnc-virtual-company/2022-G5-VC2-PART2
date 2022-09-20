<template>
    <div class="create-success p-2 bg-green-100 text-center border border-green-500 rounded shadow absolute w-5/12 right-4 top-4 text-md text-green-700 ease-in-out duration-200">{{content}}</div>
</template>

<script>

export default({
    props: {
        content: String
    }
})
</script>
