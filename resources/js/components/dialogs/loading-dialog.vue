<template>
    <v-dialog v-model="loading" persistent max-width="290">
        <v-card color="primary" dark>
            <v-card-text>
                <v-row align="center">
                    <v-col>
                        <v-progress-circular indeterminate color="white"></v-progress-circular>
                    </v-col>
                    <v-col>
                        <span class="white--text">Loading...</span>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import {ref, watch, onMounted} from 'vue'
export default {
    props: {
        loading: {
            type: Boolean,
            default: false
        }
    },
    setup(props) {
        const loading = ref(false)

        watch(
            () => props.loading, 
            (value) => {
                loading.value = value
                console.log(loading.value)
            }
        )

    return {
        // variables
        loading,
    }
        
    },
}
</script>