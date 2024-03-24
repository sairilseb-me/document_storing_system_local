<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="pa-5">
                    <v-card-title class="d-flex justify-space-between">
                        <h4 class="text-h5">Offices</h4>
                        <v-btn color="primary" @click="showOfficeDialog = true">Add Office</v-btn>
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
        <office-dialog :visible="showOfficeDialog" @close="closeShowOfficeDialog"></office-dialog>
    </v-container>
</template>

<script>

import OfficeDialog from '@/components/dialogs/office-dialog.vue'
export default {
    components: {
        OfficeDialog
    },
    setup() {
        const showOfficeDialog = ref(false)

        const closeShowOfficeDialog = () => {
            showOfficeDialog.value = false
        }

        return {
            //variable
            showOfficeDialog,


            //methods
            closeShowOfficeDialog
        }
    },
}
</script>