<template>
    <v-dialog 
        max-width="800px"
        v-model="visible"
    >
        <v-card>
            <v-card-title>
                View File
            </v-card-title>
            <v-card-text>
                <v-text-field class="mb-3" label="Title" v-model="file.title" readonly></v-text-field>
                <v-text-field class="mb-3" label="Office Name" v-model="file.office.name" readonly></v-text-field>
                <v-btn color="primary">Download</v-btn>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary" @click="closeDialog">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { ref, watch } from 'vue'
export default {
    props: {
        visible: {
            type: Boolean,
            default: false,
        },
        file: {
            type: Object,
            default: null,
        }
    },
    setup(props, {emit}) {
        
        const visible = ref(false)
        const file = ref(props.file)

        watch(
            () => props.visible,
            (value) => {
                visible.value = value
            }
        )

        watch(
            () => props.file,
            (value) => {
                if (value && value.id){
                    file.value = value
                    console.log(file.value)
                }
               
            }
        )

        const closeDialog = () => {
            emit('close', false)
        }
        
        return {
            //variables
            visible,
            file,

            //methods
            closeDialog
        }
    },
}
</script>