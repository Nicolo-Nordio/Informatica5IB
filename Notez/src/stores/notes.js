import { defineStore } from 'pinia'
import { db } from '../utils/db'
import { v4 as uuidv4 } from 'uuid'

export const useNotesStore = defineStore('notes', {
    state: () => ({
        notes: [],
        loading: false,
        error: null,
    }),

    actions: {
        async loadNotes() {
            this.loading = true
            try {
                this.notes = await db.getAll('notes')
                this.notes.sort((a, b) => new Date(b.updatedAt || b.createdAt) - new Date(a.updatedAt || a.createdAt))
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        },

        async addNote(note) {
            const newNote = {
                id: uuidv4(),
                title: note.title || 'Untitled',
                content: note.content || '',
                tags: note.tags || [],
                createdAt: new Date().toISOString(),
            }

            await db.add('notes', newNote)
            await this.loadNotes()
            return newNote.id
        },

        async updateNote(note) {
            const updatedNote = {
                ...note,
                updatedAt: new Date().toISOString(),
            }

            await db.put('notes', updatedNote)
            await this.loadNotes()
        },

        async deleteNote(id) {
            await db.delete('notes', id)
            await this.loadNotes()
        },

        async addTagToNote(noteId, tagId) {
            const note = this.notes.find(n => n.id === noteId)
            if (note && !note.tags.includes(tagId)) {
                note.tags.push(tagId)
                await this.updateNote(note)
            }
        },

        async removeTagFromNote(noteId, tagId) {
            const note = this.notes.find(n => n.id === noteId)
            if (note) {
                note.tags = note.tags.filter(t => t !== tagId)
                await this.updateNote(note)
            }
        },
    },

    getters: {
        getNoteById: (state) => (id) => state.notes.find(note => note.id === id),
        getNotesByTag: (state) => (tagId) => state.notes.filter(note => note.tags.includes(tagId)),
    },
})