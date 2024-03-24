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
        <v-row>
            <v-col>
                <office-table :offices="offices"></office-table>
            </v-col>
        </v-row>
        <office-dialog :visible="showOfficeDialog" @close="closeShowOfficeDialog"></office-dialog>
    </v-container>
</template>

<script>

import OfficeDialog from '@/components/dialogs/office-dialog.vue'
import OfficeTable from '@/components/tables/office-table.vue'
import { ref } from 'vue'
import axios from '@axios'
export default {
    components: {
        OfficeDialog,
        OfficeTable
    },
    setup() {
        const showOfficeDialog = ref(false)
        const offices = ref([])

        const closeShowOfficeDialog = () => {
            showOfficeDialog.value = false
        }

        const getOffices = () => {
            axios.get('/office')
            .then(({data}) => {
                offices.value = data.offices
                console.log(offices.value)
            })
        }

        getOffices()

        return {
            //variable
            showOfficeDialog,
            offices,


            //methods
            closeShowOfficeDialog
        }
    },
}
</script>