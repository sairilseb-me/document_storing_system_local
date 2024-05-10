<template>
    <v-card class="pa-5">
        <v-card-text>
            <v-data-table
                :headers="headers"
                :items="files"
            >
                <template #[`item.actions`] = "{item}">
                    <v-icon color="secondary" @click="viewFileHandler(item.selectable)">mdi-eye-outline</v-icon>
                    <v-icon color="warning" >mdi-pencil</v-icon>
                    <v-icon color="error" >mdi-trash</v-icon>
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

        const editFile = (file) => {
            console.log(file)
        }

        const viewFileHandler = (file) => {
            emit('view', file)
        }

        return {
            //variables
            headers,
            files,

            //methods
            viewFileHandler
        }
    },
}
</script>

<style scoped>

</style>