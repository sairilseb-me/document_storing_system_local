<template>
     <v-dialog max-width="500" v-model="visible" z-index=2>
        <v-card>
            <v-card-title class="d-flex justify-center items-center mt-3">
                View PDF
                <v-spacer></v-spacer>
                <v-icon @click="closeDialog">
                    mdi-close
                </v-icon>
            </v-card-title>
            <v-card-text>
                <iframe :src="file" width="100%" height="800px" frameborder="0"></iframe>
            </v-card-text>
            <v-card-actions>
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
        }
    },
    setup(props, {emit}) {

        const visible = ref(false)

        watch(
            () => props.visible,
            (value) => {
                visible.value = value
            }
        )

        return {
            //variables

            visible,
        }
        
    },
}
</script>