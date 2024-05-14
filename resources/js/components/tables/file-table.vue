<template>
    <v-card class="pa-5">
        <v-card-text>
            <v-data-table
                :headers="headers"
                :items="files"
            >
                <template #[`item.actions`] = "{item}">
                    <v-icon color="secondary" @click="viewFileHandler(item.selectable)">mdi-eye-outline</v-icon>
                    <v-icon color="error" @click="deleteFileHandler(item.selectable)">mdi-trash</v-icon>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
    
</template>

<script>

import { ref, watch } from 'vue'

export default {
    props: {
        files: {
            type: Array,
            default: []
        }
    },
    setup(props, {emit}) {
        const headers = ref([
            {
                title: 'title',
                key: 'title'
            },
            {
                title: 'Office Name',
                key: 'office.name'
            },
            {
                title: 'Date Received',
                key: 'date_received'
            },
            {
                title: 'Actions',
                key: 'actions'
            }
        ])

        const files = ref([])

        watch(
            () => props.files,
            (value) => {
                files.value = value
            }
        )

        const deleteFileHandler = (file) => {
            emit('delete', file)
        }

        const viewFileHandler = (file) => {
            emit('view', file)
        }

        return {
            //variables
            headers,
            files,

            //methods
            viewFileHandler,
            deleteFileHandler,
        }
    },
}
</script>

<style scoped>

</style>