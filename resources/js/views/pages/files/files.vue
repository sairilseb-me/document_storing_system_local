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
                <file-table></file-table>
            </v-col>
        </v-row>
        <file-dialog :visible="showFileDialog" @close="closeShowFileDialog"></file-dialog>
    </v-container>
</template>

<script>

import { ref } from 'vue'
import axios from '@axios'
import FileTable from '@/components/tables/file-table.vue'
import FileDialog from '@/components/dialogs/file-dialog.vue'
export default {
    components: {
        FileTable,
        FileDialog,
    },
    setup() {

        const showFileDialog = ref(false)

        const closeShowFileDialog = () => {
            showFileDialog.value = false
        }

        return {
            //variables
            showFileDialog,

            //methods
            closeShowFileDialog
        }
        
    },
}
</script>