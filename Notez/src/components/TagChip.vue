<template>
    <v-chip :color="tag.color || '#4285F4'" :size="small ? 'small' : 'default'" class="ma-1" close
        @click:close="$emit('remove')" @click="$emit('click')">
        <v-icon v-if="icon" left :icon="icon" />
        {{ tag.name }}
    </v-chip>
</template>

<script>
export default {
    props: {
        tag: {
            type: Object,
            required: true
        },
        small: {
            type: Boolean,
            default: false
        },
        icon: {
            type: String,
            default: null
        }
    },
    emits: ['remove', 'click']
}
</script>

<style scoped>
.v-chip {
    cursor: pointer;
}
</style>