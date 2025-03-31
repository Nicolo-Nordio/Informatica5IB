<template>
    <v-container>
        <v-card class="pa-4 mb-4">
            <v-card-title>Create New Tag</v-card-title>
            <v-card-text>
                <v-form @submit.prevent="createTag">
                    <v-row>
                        <v-col cols="12" md="6">
                            <v-text-field v-model="newTag.name" label="Tag name" variant="outlined"
                                :rules="[requiredRule]" />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-color-picker v-model="newTag.color" mode="hexa" hide-inputs swatches-max-height="100" />
                        </v-col>
                        <v-col cols="12" md="2" class="d-flex align-center">
                            <v-btn color="primary" type="submit" :loading="loading">
                                Create
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>
        </v-card>

        <v-card>
            <v-card-title>Your Tags</v-card-title>
            <v-card-text>
                <div v-if="tags.length === 0" class="text-center py-8">
                    <v-icon size="64" color="grey">mdi-tag-off-outline</v-icon>
                    <p class="text-h6 mt-2">No tags created yet</p>
                </div>

                <v-list v-else>
                    <v-list-item v-for="tag in tags" :key="tag.id">
                        <template v-slot:prepend>
                            <TagChip :tag="tag" icon="mdi-tag" />
                        </template>

                        <template v-slot:append>
                            <v-btn icon variant="text" color="error" @click="deleteTag(tag.id)">
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import { ref, onMounted } from 'vue'
import { useTagsStore } from '../stores/tags'
import TagChip from '../components/TagChip.vue'

export default {
    components: { TagChip },
    setup() {
        const tagsStore = useTagsStore()
        const loading = ref(false)
        const newTag = ref({
            name: '',
            color: '#4285F4'
        })

        const requiredRule = value => !!value || 'Required field'

        onMounted(async () => {
            await tagsStore.loadTags()
        })

        const createTag = async () => {
            if (!newTag.value.name) return

            loading.value = true
            try {
                await tagsStore.addTag(newTag.value)
                newTag.value = { name: '', color: '#4285F4' }
            } finally {
                loading.value = false
            }
        }

        const deleteTag = async (id) => {
            if (confirm('Are you sure you want to delete this tag? This will remove it from all notes.')) {
                await tagsStore.deleteTag(id)
            }
        }

        return {
            tags: tagsStore.tags,
            loading,
            newTag,
            requiredRule,
            createTag,
            deleteTag
        }
    }
}
</script>