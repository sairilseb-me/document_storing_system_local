<template>
    <v-dialog
        v-model="visible"
        max-width="500"
    >
        <v-card class="pa-5">
            <v-form @submit.prevent="resolveAction">
                <v-card-title>Offices</v-card-title>
                <v-card-text>
                    <v-text-field label="Enter Office Name" v-model="office_name"></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="secondary" @click="closeDialog">Close</v-btn>
                    <v-btn color="primary" type="submit">{{ office.id ? 'Edit Office' : 'Add Office' }}</v-btn>
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
        office: {
            type: Object,
            default: () => {}
        }
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
            .then(({data}) => {
                console.log(data)
                closeDialog()
            })
            .catch((error) => {
                console.log(error.response.data)
            })
        }

        const editOffice = () => {
            axios.put(`/office/${props.office.id}`, {
                name: office_name.value
            })
            .then(({data}) => {
                console.log(data.message)
                closeDialog()
            })
            .catch(err => {
                console.log(err.response.data)
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