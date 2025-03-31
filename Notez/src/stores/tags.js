import { defineStore } from 'pinia'
import { db } from '../utils/db'
import { v4 as uuidv4 } from 'uuid'

export const useTagsStore = defineStore('tags', {
    state: () => ({
        tags: [],
        loading: false,
        error: null,
    }),

    actions: {
        async loadTags() {
            this.loading = true
            try {
                this.tags = await db.getAll('tags')
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        },

        async addTag(tag) {
            const newTag = {
                id: uuidv4(),
                name: tag.name,
                color: tag.color || '#4285F4',
            }

            await db.add('tags', newTag)
            await this.loadTags()
            return newTag.id
        },

        async updateTag(tag) {
            await db.put('tags', tag)
            await this.loadTags()
        },

        async deleteTag(id) {
            await db.delete('tags', id)
            await this.loadTags()
        },
    },

    getters: {
        getTagById: (state) => (id) => state.tags.find(tag => tag.id === id),
        getTagByName: (state) => (name) => state.tags.find(tag => tag.name === name),
    },
})