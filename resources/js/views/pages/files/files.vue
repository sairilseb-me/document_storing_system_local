<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="pa-5">
                    <v-card-title class="d-flex justify-space-between">
                        <h4 class="text-h5">Files</h4>
                        <v-btn color="primary" @click="showFileDialog = true">Add File</v-btn>
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <div class="mt-3 d-flex justify-end">
                        <v-col cols="4">
                            <v-text-field
                                v-model="search"
                                prepend-inner-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                                @update:model-value="searchFiles"
                            ></v-text-field>
                        </v-col>
                    </div>
                    <div>
                        <v-col>
                            <file-table :files="files" :loading="tableLoading" @view="showFileHandler" @delete="deleteFileHandler" @changePage="changePage"></file-table>
                        </v-col>
                    </div>
                </v-card>
            </v-col>
            
        </v-row>
        <file-dialog :visible="showFileDialog" @close="closeShowFileDialog"></file-dialog>
        <view-file-dialog :visible="viewFileDialog" :file="sfile" @close="closeViewFileDialog"></view-file-dialog>
        <delete-dialog :details="deleteDetails" :visible="deleteDialogVisible" @close="deleteDialogClose"></delete-dialog>
    </v-container>
</template>

<script>

import { ref, onMounted } from 'vue'
import axios from '@axios'
import FileTable from '@/components/tables/file-table.vue'
import FileDialog from '@/components/dialogs/file-dialog.vue'
import ViewFileDialog from '@/components/dialogs/view-file-dialog.vue'
import DeleteDialog from '@/components/dialogs/delete-dialog.vue'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
export default {
    components: {
        FileTable,
        FileDialog,
        ViewFileDialog,
        DeleteDialog,
    },
    setup() {

        const showFileDialog = ref(false)
        const files = ref([])
        const viewFileDialog = ref(false)
        const sfile = ref(null)
        const deleteDetails = ref({})
        const deleteDialogVisible = ref(false) 
        const search = ref('')
        const page = ref(1)
        const globalSnackbar = useGlobalSnackbarStore()
        const tableLoading = ref(false)

        const closeShowFileDialog = () => {
            showFileDialog.value = false
            getFiles()
            search.value = ''
        }

        const closeViewFileDialog = () => {
            viewFileDialog.value = false
            getFiles()
            search.value = ''
        }

        const getFiles = () => {
            tableLoading.value = true
            axios.get('file', {params: {page: page.value} })
            .then((response) => {
                files.value = response.data.files
            }).finally(() => {
                tableLoading.value = false
            })
        }

        const changePage = (value) => {
            page.value = value
            getFiles()
        }

        const showFileHandler = (file) => {
            sfile.value = file
            viewFileDialog.value = true
        }

        const deleteFileHandler = (file) => {
            deleteDialogVisible.value = true
            deleteDetails.value = {
                url: '/file/' + file.id,
                message: 'Are you sure you want to delete this file?'
            }
        }

        const deleteDialogClose = () => {
            deleteDialogVisible.value = false
            deleteDetails.value = {}
            getFiles()
        }

        const searchFiles = () => {
            
            if (search.value === '') {
                getFiles()
            } else {
                tableLoading.value = true
                axios.get('file/search/' + search.value)
                .then(({data}) => {
                    files.value = data.files
                }).finally(() => {
                    tableLoading.value = false
                })
            }
        }


        getFiles()

        return {
            //variables
            showFileDialog,
            files,
            sfile,
            viewFileDialog,
            deleteDetails,
            deleteDialogVisible,
            search,
            tableLoading,

            //methods
            closeShowFileDialog,
            closeViewFileDialog,
            showFileHandler,
            deleteFileHandler,
            deleteDialogClose,
            searchFiles,
            changePage
        }
        
    },
}
</script>