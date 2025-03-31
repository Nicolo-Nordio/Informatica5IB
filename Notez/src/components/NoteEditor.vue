<template>
    <div class="note-editor">
        <v-text-field v-model="title" label="Title" variant="outlined" hide-details class="mb-4" />

        <v-textarea v-model="content" label="Content" variant="outlined" auto-grow rows="10" hide-details />

        <div class="tags-section mt-4">
            <v-combobox v-model="selectedTags" :items="availableTags" item-title="name" item-value="id" label="Tags"
                multiple chips variant="outlined" return-object>
                <template v-slot:selection="{ item }">
                    <TagChip :tag="item" small />
                </template>
            </v-combobox>
        </div>

        <div class="actions mt-4">
            <v-btn color="error" @click="$emit('cancel')">
                Cancel
            </v-btn>
            <v-spacer />
            <v-btn color="primary" @click="saveNote">
                Save
            </v-btn>
        </div>
    </div>
</template>

<script>
import { ref, watch, computed } from 'vue'
import { useTagsStore } from '../stores/tags'
import TagChip from './TagChip.vue'

export default {
    components: { TagChip },
    props: {
        note: {
            type: Object,
            default: null
        }
    },
    emits: ['save', 'cancel'],
    setup(props, { emit }) {
        const tagsStore = useTagsStore()
        const title = ref(props.note?.title || '')
        const content = ref(props.note?.content || '')
        const selectedTags = ref([])

        const availableTags = computed(() => tagsStore.tags)

        watch(() => props.note, (newNote) => {
            if (newNote) {
                title.value = newNote.title
                content.value = newNote.content
                selectedTags.value = availableTags.value.filter(tag =>
                    newNote.tags.includes(tag.id)
                )
            } else {
                title.value = ''
                content.value = ''
                selectedTags.value = []
            }
        }, { immediate: true })

        const saveNote = () => {
            const noteData = {
                title: title.value,
                content: content.value,
                tags: selectedTags.value.map(tag => tag.id)
            }
            emit('save', noteData)
        }

        return { title, content, selectedTags, availableTags, saveNote }
    }
}
</script>

<style scoped>
.actions {
    display: flex;
}
</style>