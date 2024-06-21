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
                                @update:model-value="searchOffices"
                            ></v-text-field>
                        </v-col>
                    </div>
                    <div>
                        <v-col>
                            <office-table :offices="offices" @edit="editOffice" @delete="deleteOffice"></office-table>
                        </v-col>
                    </div>
                </v-card>
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
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
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
        const search = ref('')
        const globalSnackbar = useGlobalSnackbarStore()

        const closeShowOfficeDialog = () => {
            showOfficeDialog.value = false
            getOffices()
        }

        const getOffices = () => {
            axios.get('/office?all')
            .then(({data}) => {
                offices.value = data.offices
            }).catch(error => {
                globalSnackbar.setValues({
                    message: 'Having some problem fetching the offices. Please try again later.',
                    color: 'error',
                    show: true,
                })
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

        const searchOffices = () => {
            if (search.value == ''){
                getOffices()
            } else {
                axios.get(`/office/search/${search.value}`)
                .then(({data}) => {
                    offices.value = data.offices
                }).catch(error => {
                    globalSnackbar.setValues({
                        message: 'Having some problem searching the offices. Please try again later.',
                        color: 'error',
                        show: true,
                    })
                })
            }
        }

        getOffices()

        return {
            //variable
            showOfficeDialog,
            offices,
            office,
            deleteDetails,
            deleteDialogVisible,
            search,


            //methods
            closeShowOfficeDialog,
            editOffice,
            deleteOffice,
            deleteDialogClose,
            searchOffices,
        }
    },
}
</script>