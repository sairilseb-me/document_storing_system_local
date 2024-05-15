<template>
    <v-snackbar
        v-model="globalSnackbar.show"
        vertical
        :color="globalSnackbar.color"
    >
    <div class="d-flex justify-end align-center">
        
    </div>
    <div class="d-flex justify-center align-center">
        {{ globalSnackbar.message }}
    </div>
    </v-snackbar>
</template>

<script>
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar';
import { watch } from 'vue';
export default {
    setup() {
        const globalSnackbar = useGlobalSnackbarStore();

        watch(() => globalSnackbar.show, (value) => {
            if (value) {
                setTimeout(() => {
                    globalSnackbar.setValues({
                        show: false,
                        message: '',
                        color: '',
                    })
                }, globalSnackbar.timeout);
            }
        });

        return {
            globalSnackbar,
        };
    },
}
</script>