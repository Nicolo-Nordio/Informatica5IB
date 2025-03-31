<template>
    <div class="notes-grid">
        <v-text-field v-model="searchQuery" label="Search notes" prepend-inner-icon="mdi-magnify" variant="outlined"
            clearable class="mb-4" />

        <v-select v-model="selectedTags" :items="tags" item-title="name" item-value="id" label="Filter by tags" multiple
            chips variant="outlined" clearable class="mb-4">
            <template v-slot:selection="{ item }">
                <TagChip :tag="item.raw" small />
            </template>
        </v-select>

        <div v-if="filteredNotes.length === 0" class="text-center py-8">
            <v-icon size="64" color="grey">mdi-note-off-outline</v-icon>
            <p class="text-h6 mt-2">No notes found</p>
            <v-btn color="primary" class="mt-4" @click="createNewNote">
                Create your first note
            </v-btn>
        </div>

        <v-row v-else>
            <v-col v-for="note in filteredNotes" :key="note.id" cols="12" sm="6" md="4" lg="3">
                <NoteCard :note="note" :tags="tags" @click="openNote(note.id)" @delete="deleteNote(note.id)" />
            </v-col>
        </v-row>

        <v-btn fab color="primary" fixed bottom right class="ma-6" @click="createNewNote">
            <v-icon>mdi-plus</v-icon>
        </v-btn>
    </div>
</template>

<script>
import { computed, ref } from 'vue'
import NoteCard from './NoteCard.vue'
import TagChip from './TagChip.vue'

export default {
    components: { NoteCard, TagChip },
    props: {
        notes: {
            type: Array,
            required: true
        },
        tags: {
            type: Array,
            required: true
        }
    },
    emits: ['open-note', 'delete-note', 'create-note'],
    setup(props, { emit }) {
        const searchQuery = ref('')
        const selectedTags = ref([])

        const filteredNotes = computed(() => {
            let result = [...props.notes]

            // Filter by search query
            if (searchQuery.value) {
                const query = searchQuery.value.toLowerCase()
                result = result.filter(note =>
                    note.title.toLowerCase().includes(query) ||
                    note.content.toLowerCase().includes(query)
                )
            }

            // Filter by selected tags
            if (selectedTags.value.length > 0) {
                result = result.filter(note =>
                    selectedTags.value.every(tagId => note.tags.includes(tagId))
                )
            }

            return result
        })

        const openNote = (id) => {
            emit('open-note', id)
        }

        const deleteNote = (id) => {
            emit('delete-note', id)
        }

        const createNewNote = () => {
            emit('create-note')
        }

        return {
            searchQuery,
            selectedTags,
            filteredNotes,
            openNote,
            deleteNote,
            createNewNote
        }
    }
}
</script>

<style scoped>
.notes-grid {
    position: relative;
    min-height: 80vh;
}
</style>