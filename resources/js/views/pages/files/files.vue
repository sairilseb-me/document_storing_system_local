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
            <v-col>
                <file-table :files="files" @view="showFileHandler"></file-table>
            </v-col>
        </v-row>
        <file-dialog :visible="showFileDialog" @close="closeShowFileDialog"></file-dialog>
        <view-file-dialog :visible="viewFileDialog" :file="sfile" @close="closeViewFileDialog"></view-file-dialog>
    </v-container>
</template>

<script>

import { ref } from 'vue'
import axios from '@axios'
import FileTable from '@/components/tables/file-table.vue'
import FileDialog from '@/components/dialogs/file-dialog.vue'
import ViewFileDialog from '@/components/dialogs/view-file-dialog.vue'
export default {
    components: {
        FileTable,
        FileDialog,
        ViewFileDialog,
    },
    setup() {

        const showFileDialog = ref(false)
        const files = ref([])
        const viewFileDialog = ref(false)
        const sfile = ref(null)

        const closeShowFileDialog = () => {
            showFileDialog.value = false
            getFiles()
        }

        const closeViewFileDialog = () => {
            viewFileDialog.value = false
            getFiles()
        }

        const getFiles = () => {
            axios.get('file')
            .then(({data}) => {
                files.value = data.files
            })
        }

        const showFileHandler = (file) => {
            sfile.value = file
            viewFileDialog.value = true
        }

        getFiles()

        return {
            //variables
            showFileDialog,
            files,
            sfile,
            viewFileDialog,

            //methods
            closeShowFileDialog,
            closeViewFileDialog,
            showFileHandler,
        }
        
    },
}
</script>