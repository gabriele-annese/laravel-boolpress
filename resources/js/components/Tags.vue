
<template>

    <div>
        <span v-for="tag in list"
            :key="`tag-${tag.id}`"
            class="badge badge-primary mr-3 p-2"
        >
        {{tag.name}}
        </span>
    </div>
</template>

<script>
export default {
    name: 'tags',
    props:{
        list: Array
    },
}
</script>

<style lang="scss" scoped>

</style>