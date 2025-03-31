<template>
    <v-card class="note-card" hover @click="$emit('click')">
        <v-card-title class="text-h6">{{ note.title }}</v-card-title>
        <v-card-text>
            <div class="note-content">{{ truncatedContent }}</div>
            <div v-if="noteTags.length > 0" class="tags-container mt-2">
                <TagChip v-for="tag in noteTags" :key="tag.id" :tag="tag" small />
            </div>
        </v-card-text>
        <v-card-actions>
            <v-chip small color="grey lighten-2">
                {{ formattedDate }}
            </v-chip>
            <v-spacer />
            <v-btn icon small @click.stop="$emit('delete')">
                <v-icon small>mdi-delete</v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import { computed } from 'vue'
import TagChip from './TagChip.vue'

export default {
    components: { TagChip },
    props: {
        note: {
            type: Object,
            required: true
        },
        tags: {
            type: Array,
            default: () => []
        }
    },
    emits: ['click', 'delete'],
    setup(props) {
        const truncatedContent = computed(() => {
            return props.note.content.length > 100
                ? props.note.content.substring(0, 100) + '...'
                : props.note.content
        })

        const formattedDate = computed(() => {
            const date = new Date(props.note.updatedAt || props.note.createdAt)
            return date.toLocaleDateString()
        })

        const noteTags = computed(() => {
            return props.tags.filter(tag => props.note.tags.includes(tag.id))
        })

        return { truncatedContent, formattedDate, noteTags }
    }
}
</script>

<style scoped>
.note-card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.note-content {
    white-space: pre-line;
}

.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
}
</style>