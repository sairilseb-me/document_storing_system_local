<template>
    <v-dialog
        v-model="visible"
        max-width="500"
    >
        <v-card class="pa-5">
            <v-form @submit.prevent="resolveAction">
                <v-card-title>Offices</v-card-title>
                <v-card-text>
                    <v-text-field label="Enter Office Name" v-model="office_name" class="mb-3"></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="secondary" @click="closeDialog">Close</v-btn>
                    <v-btn color="primary" type="submit">{{ office && office.id ? 'Edit Office' : 'Add Office' }}</v-btn>
                </v-card-actions>
            </v-form>
           
        </v-card>
    </v-dialog>
</template>

<script>
import { ref, watch } from 'vue'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
import axios from '@axios'
export default {
    props: {
        visible: {
            type: Boolean,
            default: false,
        },
        office: {
            type: Object,
            default: () => {}
        }
    },
    setup(props, { emit }) {
        const visible = ref(false)
        const office_name = ref(null)
        const globalSnackbar = useGlobalSnackbarStore()

        watch(
            () => props.visible,
            (value) => {
                visible.value = value
                
            }
        )

        watch(
            () => props.office,
            (value) => {
                if (value && value.id){
                    office_name.value = value.name
                }
            }
        )

        const addOffice = () => {
            axios.post('/office', {
                name: office_name.value
            })
            .then(response => {
                if (response.status == 200){
                    globalSnackbar.setValues({
                        show: true,
                        message: 'Office added successfully',
                        color: 'success'
                    })
                    closeDialog()
                } else {
                    globalSnackbar.setValues({
                        show: true,
                        message: 'An error occurred while adding office',
                        color: 'error'
                    })
                }
               
            })
            .catch((error) => {
                globalSnackbar.setValues({
                    show: true,
                    message: 'An error occurred while adding office',
                    color: 'error'
                })
            })
        }

        const editOffice = () => {
            axios.put(`/office/${props.office.id}`, {
                name: office_name.value
            })
            .then(response => {
                if (response.status == 200){
                    globalSnackbar.setValues({
                        show: true,
                        message: 'Office updated successfully',
                        color: 'success'
                    })
                    closeDialog()
                } else {
                    globalSnackbar.setValues({
                        show: true,
                        message: 'An error occurred while updating office',
                        color: 'error'
                    })
                }
                
            })
            .catch(err => {
                globalSnackbar.setValues({
                        show: true,
                        message: 'An error occurred while updating office',
                        color: 'error'
                    })
            })
        }

        const resolveAction = computed(() => {
            if (props.office && props.office.id){
                return editOffice
            }

            return addOffice
        })

        const closeDialog = () => {
            emit('close')
            clearInputs()
        }

        const clearInputs = () => {
            office_name.value = null
        }   

        return {
            visible,
            office_name,
            
            // computed
            resolveAction,

            //methods
            closeDialog,
            
        }
    },
}
</script>