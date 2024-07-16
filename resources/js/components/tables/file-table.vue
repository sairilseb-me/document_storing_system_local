<template>
    <v-card class="pa-5">
        <v-card-text>
            <v-data-table
                :headers="headers"
                :items="files.data"
                :hide-default-footer = "true"
                :loading="loading"
            >
                <template #[`item.actions`] = "{item}">
                    <v-icon color="secondary" @click="viewFileHandler(item.selectable)">mdi-eye-outline</v-icon>
                    <v-icon color="error" @click="deleteFileHandler(item.selectable)">mdi-trash</v-icon>
                </template>
                <template
                    v-slot:bottom
                >
                    <v-row>
                        <v-col cols="12">
                            <v-pagination
                                v-model="page"
                                :length="length"
                                @update:modelValue="handlePageChange"
                            ></v-pagination>
                        </v-col>
                    </v-row>

                </template>
               
            </v-data-table>
        </v-card-text>
    </v-card>
    
</template>

<script>

import { ref, watch } from 'vue'
import { load } from 'webfontloader';

export default {
    props: {
        files: {
            type: Object,
            default: {}
        },
        loading: {
            type: Boolean,
            default: false
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
        const itemsPerPage = ref(10)
        const itemsPerPageOptions = ref([
            {
                value: 5,
                title: '5'
            },
            {
                value: 10,
                title: '10'
            },
            {
                value: 20,
                title: '20'
            },
            {
                value: 50,
                title: '50'
            }
        ])
        const page = ref(1)
    

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

        const length = computed(() => {
            if (files.value.total) {
                return Math.ceil(files.value.total / files.value.per_page)
            }

            return 0
        })

        const handlePageChange = () => {
            emit('changePage', page.value)
        }

        return {
            //variables
            headers,
            files,
            itemsPerPage,
            itemsPerPageOptions,
            page,

            // computed
            length,

            //methods
            viewFileHandler,
            deleteFileHandler,
            handlePageChange,
        }
    },
}
</script>

<style scoped>

</style>