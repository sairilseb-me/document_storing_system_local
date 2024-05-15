<template>
    <v-dialog
        v-model="visible"
        max-width="500"
    >
        <v-row>
            <v-col>
                <v-card class="pa-5">
                    <v-form @submit.prevent="deleteItem">
                        <v-card-title>{{ deleteDetails.title ? deleteDetails.title : 'Delete' }}</v-card-title>
                        <v-card-text>
                            {{ deleteDetails.message ? deleteDetails.message : 'Are you sure you want to delete this item?'}}
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="secondary" @click="closeDialog">Cancel</v-btn>
                            <v-btn color="primary" type="submit">Delete</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-col>
        </v-row>
    </v-dialog>
</template>

<script>
import { ref, watch } from 'vue';
import axios from '@axios'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
export default {
    props: {
        visible: {
            type: Boolean,
            default: false
        },
        details: {
            type: Object,
            default: () => ({})
        }
    },
    setup(props, {emit}) {
        const visible = ref(false)
        const deleteDetails = ref({})
        const globalSnackbar = useGlobalSnackbarStore()

        watch(
            () => props.visible,
            (value) => {
                visible.value = value
            }
        )

        watch(
            () => props.details,
            (value) => {
                if (value && value.url) {
                    deleteDetails.value = value
                }
            }, {deep: true}
        )

        const deleteItem = () => {
            if (deleteDetails.value.url){
                console.log(deleteDetails.value.url)
                axios.delete(deleteDetails.value.url)
                .then(response => {
                    if (response.status == 200){
                        globalSnackbar.setValues({
                            show: true,
                            message: 'Item deleted successfully',
                            color: 'success'
                        })
                    }
                    closeDialog()
                })
                .catch(error => {
                    console.log(error)
                })
            }
            console.log(deleteDetails.value.url)
        }

        const closeDialog = () => {
            emit('close')
            deleteDetails.value = {}
        }

        return  {
            //variable
            visible,
            deleteDetails,

            //methods
            deleteItem,
            closeDialog,

        }
    },
}
</script>