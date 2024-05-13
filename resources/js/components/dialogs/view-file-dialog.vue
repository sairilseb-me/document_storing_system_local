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
                <div v-if="isFilePDF">
                    <iframe :src="returnFilePath" width="100%" height="800px" frameborder="0"></iframe>
                </div>
                <v-btn v-else color="primary" @click="downloadFile">Download</v-btn>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="secondary" @click="closeDialog">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { ref, watch, computed } from 'vue'

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


        const isFilePDF = computed(() => {
            if (props.file && props.file.path){
                return props.file.path.split('.').pop() === 'pdf' ? true : false
            }
        })

        const returnFilePath = computed(() => {
            if (props.file && props.file.path){
                let props_array = props.file.path.split('/')
                props_array[0] = props_array[0].replace('public', 'storage');
                console.log(props_array)
                return 'http://localhost:8000/' + props_array.join('/')
            }
        })

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

            //compputed
            isFilePDF,
            returnFilePath,

            //methods
            closeDialog
        }
    },
}
</script>