<template>
    <v-dialog
        v-model="visible"
        max-width="600"
    >
        <v-card class="pa-5">
            <v-form @submit.prevent="resolveAction">
                <v-card-title>Roles</v-card-title>
                <v-card-text>
                    <v-text-field v-model="roleName" label="Role Name"></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="secondary" @click="closeDialog">Cancel</v-btn>
                    <v-btn color="primary" type="submit">{{ role && role.id ? 'Update' : 'Save' }}</v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
import {ref, watch, computed} from 'vue'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
import axios from '@axios'
export default {
    props: {
        visible: {
            type: Boolean,
            default: false
        },
        role: {
            type: Object,
            default: () => ({})
        }
    },
    setup(prop, {emit}) {

        const visible = ref(false)
        const roleName = ref('')
        const globalSnackbar = useGlobalSnackbarStore()

        const closeDialog = () => {
            emit('close', false)
            resetInput()

        }

        const saveRole = () => {
            axios.post('/role', {name: roleName.value})
                .then(response => {
                    if (response.status == 200){
                        globalSnackbar.setValues({
                            show: true,
                            message: 'Role saved successfully',
                            color: 'success'
                        })
                    }
                    closeDialog()
                })
                .catch(error => {
                    console.log(error)
                })
        }

        const editRole = () => {
            axios.put(`/role/${prop.role.id}`, {name: roleName.value})
                .then(response => {
                    console.log(response.data)
                    closeDialog()
                })
                .catch(error => {
                    console.log(error)
                })
        }

        const resolveAction = computed(() => {
            if (prop.role && prop.role.id)
            {
                return editRole
            }

            return saveRole
        })

        watch(
            () => prop.visible,
            (value) => {
                visible.value = value
            }
        )

        watch(
            () => prop.role,
            (value) => {
                if (value && value.id)
                {
                    roleName.value = value.name
                }
            }
        )

        //methods

        const resetInput = () => {
            roleName.value = null
        }

        return {
            //variable
            visible,
            roleName,

            // computed
            resolveAction,

            //methods
            closeDialog,
            saveRole,
            editRole,
        }
    },
}
</script>