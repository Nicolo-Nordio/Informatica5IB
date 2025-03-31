import { openDB } from 'idb'

const DB_NAME = 'notezDB'
const DB_VERSION = 1

const dbPromise = openDB(DB_NAME, DB_VERSION, {
    upgrade(db) {
        if (!db.objectStoreNames.contains('notes')) {
            const notesStore = db.createObjectStore('notes', { keyPath: 'id' })
            notesStore.createIndex('createdAt', 'createdAt')
            notesStore.createIndex('updatedAt', 'updatedAt')
        }

        if (!db.objectStoreNames.contains('tags')) {
            const tagsStore = db.createObjectStore('tags', { keyPath: 'id' })
            tagsStore.createIndex('name', 'name', { unique: true })
        }
    },
})

export const db = {
    async getAll(storeName) {
        return (await dbPromise).getAll(storeName)
    },

    async get(storeName, id) {
        return (await dbPromise).get(storeName, id)
    },

    async add(storeName, item) {
        return (await dbPromise).add(storeName, item)
    },

    async put(storeName, item) {
        return (await dbPromise).put(storeName, item)
    },

    async delete(storeName, id) {
        return (await dbPromise).delete(storeName, id)
    },
}