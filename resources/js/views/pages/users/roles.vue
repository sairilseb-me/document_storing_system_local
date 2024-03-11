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
                <role-table :items="roles"></role-table>
            </v-col>
        </v-row>
        <role-dialog :visible="visible" @close="closeRoleDialog"></role-dialog>
    </v-container>
</template>

<script>
import RoleTable from '@/components/tables/role-table.vue'
import RoleDialog from '@/components/dialogs/role-dialog.vue'
import { ref } from 'vue'
import axios from '@axios'
import { formatDate } from '@/@core/utils/formatters'
export default {
    components: {
        RoleTable,
        RoleDialog,
    },
    setup() {
        
        const visible = ref(false)
        const roles = ref([])

        const showRoleDialog = () => {
            visible.value = true
        }
        const closeRoleDialog = () => {
            visible.value = false
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

        getRoles()

        return {

            //variable
            visible,
            roles,

            //methods
            showRoleDialog,
            closeRoleDialog,
        }
    },
}
</script>