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
                <office-table :offices="offices" @edit="editOffice" @delete="deleteOffice"></office-table>
            </v-col>
        </v-row>
        <office-dialog :visible="showOfficeDialog" :office="office" @close="closeShowOfficeDialog"></office-dialog>
        <delete-dialog :details="deleteDetails" :visible="deleteDialogVisible" @close="deleteDialogClose"></delete-dialog>
    </v-container>
</template>

<script>

import OfficeDialog from '@/components/dialogs/office-dialog.vue'
import OfficeTable from '@/components/tables/office-table.vue'
import DeleteDialog from '@/components/dialogs/delete-dialog.vue'
import { ref } from 'vue'
import axios from '@axios'
export default {
    components: {
        OfficeDialog,
        OfficeTable,
        DeleteDialog,
    },
    setup() {
        const showOfficeDialog = ref(false)
        const offices = ref([])
        const office = ref(null)
        const deleteDetails = ref({})
        const deleteDialogVisible = ref(false)

        const closeShowOfficeDialog = () => {
            showOfficeDialog.value = false
            getOffices()
        }

        const getOffices = () => {
            axios.get('/office')
            .then(({data}) => {
                offices.value = data.offices
            })
        }

        const editOffice = (data) => {
            office.value = data
            showOfficeDialog.value = true
        }

        const deleteOffice = (id) => {
            deleteDetails.value = {
                url: '/office/' + id,
                message: 'Are you sure you want to delete this office?'
            }
            deleteDialogVisible.value = true
        }

        const deleteDialogClose = () => {
            deleteDialogVisible.value = false
            getOffices()
        }

        getOffices()

        return {
            //variable
            showOfficeDialog,
            offices,
            office,
            deleteDetails,
            deleteDialogVisible,


            //methods
            closeShowOfficeDialog,
            editOffice,
            deleteOffice,
            deleteDialogClose,
        }
    },
}
</script>