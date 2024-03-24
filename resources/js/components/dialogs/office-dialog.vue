<template>
    <v-dialog
        v-model="visible"
        max-width="500"
    >
        <v-card class="pa-5">
            <v-form @submit.prevent="addOffice">
                <v-card-title>Offices</v-card-title>
                <v-card-text>
                    <v-text-field label="Enter Office Name" v-model="office_name"></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="secondary" @click="closeDialog">Close</v-btn>
                    <v-btn color="primary" type="submit">Add Office</v-btn>
                </v-card-actions>
            </v-form>
           
        </v-card>
    </v-dialog>
</template>

<script>
import { ref, watch } from 'vue'
import axios from '@axios'
export default {
    props: {
        visible: {
            type: Boolean,
            default: false,
        },
    },
    setup(props, { emit }) {
        const visible = ref(false)
        const office_name = ref(null)

        watch(
            () => props.visible,
            (value) => {
                visible.value = value
            }
        )

        const addOffice = () => {
            axios.post('/office', {
                name: office_name.value
            })
            .then(({data}) => {
                console.log(data)
                closeDialog()
            })
            .catch((error) => {
                console.log(error.response.data)
            })
            
        }

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
            

            //methods
            closeDialog,
            addOffice,
        }
    },
}
</script>