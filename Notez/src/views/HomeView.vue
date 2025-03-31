<template>
    <div class="home-view">
        <NotesGrid :notes="notes" :tags="tags" @open-note="openNote" @delete-note="deleteNote"
            @create-note="openNewNote" />

        <v-dialog v-model="editorDialog" max-width="800px">
            <NoteEditor v-if="editorDialog" :note="currentNote" @save="handleSave" @cancel="editorDialog = false" />
        </v-dialog>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import { useNotesStore } from '../stores/notes'
import { useTagsStore } from '../stores/tags'
import NotesGrid from '../components/NotesGrid.vue'
import NoteEditor from '../components/NoteEditor.vue'

export default {
    components: { NotesGrid, NoteEditor },
    setup() {
        const notesStore = useNotesStore()
        const tagsStore = useTagsStore()

        const editorDialog = ref(false)
        const currentNote = ref(null)

        onMounted(async () => {
            await notesStore.loadNotes()
            await tagsStore.loadTags()
        })

        const openNote = (id) => {
            currentNote.value = notesStore.getNoteById(id)
            editorDialog.value = true
        }

        const openNewNote = () => {
            currentNote.value = null
            editorDialog.value = true
        }

        const deleteNote = async (id) => {
            if (confirm('Are you sure you want to delete this note?')) {
                await notesStore.deleteNote(id)
            }
        }

        const handleSave = async (noteData) => {
            if (currentNote.value) {
                await notesStore.updateNote({
                    ...currentNote.value,
                    ...noteData
                })
            } else {
                await notesStore.addNote(noteData)
            }
            editorDialog.value = false
        }

        return {
            notes: notesStore.notes,
            tags: tagsStore.tags,
            editorDialog,
            currentNote,
            openNote,
            openNewNote,
            deleteNote,
            handleSave
        }
    }
}
</script>