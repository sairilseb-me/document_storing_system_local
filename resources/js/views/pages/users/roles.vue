<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="pa-5">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" class="d-flex justify-space-between">
                                <h3 class="text-h5">Roles</h3>
                                <v-btn color="primary" @click="showRoleDialog">Add Role</v-btn>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <role-table :items="roles" @edit="editRole" @delete="deleteRole"></role-table>
            </v-col>
        </v-row>
        <role-dialog :visible="visible" @close="closeRoleDialog" :role="selectedRole"></role-dialog>
        <delete-dialog :visible="deleteDialogVisible" :details="deleteDetails" @close="closeDeleteDialog"></delete-dialog>
    </v-container>
</template>

<script>
import RoleTable from '@/components/tables/role-table.vue'
import RoleDialog from '@/components/dialogs/role-dialog.vue'
import DeleteDialog from '@/components/dialogs/delete-dialog.vue'
import { ref } from 'vue'
import axios from '@axios'
export default {
    components: {
        RoleTable,
        RoleDialog,
        DeleteDialog,
    },
    setup() {
        
        const visible = ref(false)
        const deleteDialogVisible = ref(false)
        const roles = ref([])
        const selectedRole = ref({})
        const deleteDetails = ref({})

        const showRoleDialog = () => {
            visible.value = true
        }
        const closeRoleDialog = () => {
            visible.value = false
            selectedRole.value = {}
            getRoles()
        } 

        const getRoles = () => {
            axios.get('/role')
            .then(({data}) => {
                roles.value = data.roles
            })
            .catch(error => {
                console.log(error)
            })
        }

        const editRole = (item) => {
            selectedRole.value = item
            visible.value = true
        }

        const deleteRole = (item) => {
            deleteDetails.value = {
                url: `/role/${item.id}`,
                message: 'Are you sure you want to delete this role?',
            }
            deleteDialogVisible.value = true
        }

        const closeDeleteDialog = () => {
            deleteDialogVisible.value = false
            getRoles()
        }

        getRoles()

        return {

            //variable
            visible,
            roles,
            selectedRole,
            deleteDialogVisible,
            deleteDetails,

            //methods
            showRoleDialog,
            closeRoleDialog,
            editRole,
            deleteRole,
            closeDeleteDialog,
        }
    },
}
</script>