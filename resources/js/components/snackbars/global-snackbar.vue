<template>
    <v-snackbar
        v-model="globalSnackbar.show"
        vertical
        :color="globalSnackbar.color"
        close-on-content-click
        location="top right"
    >
        <div class="w-100">
            <p class="text-center">{{ globalSnackbar.message }}</p> 
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