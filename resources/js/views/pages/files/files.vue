<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="pa-5">
                    <v-card-title class="d-flex justify-space-between">
                        <h4 class="text-h5">Files</h4>
                        <v-btn color="primary">Add File</v-btn>
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <file-table></file-table>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>

import { ref } from 'vue'
import axios from '@axios'
import FileTable from '@/components/tables/file-table.vue'
export default {
    components: {
        FileTable
    },
    setup() {
        
    },
}
</script>