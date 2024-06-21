import {defineStore } from 'pinia'

export const useGlobalSnackbarStore = defineStore('snackbar',{
    state: () => ({
        show: false,
        message: 'I don\'t know what to say....',
        color: 'primary',
        timeout: 3000
    }),

    getters: {
        getValues(state){
            return {
                show: state.show,
                message: state.color,
                color: state.color,
                timeout: state.timeout
            }
        },
    },
    actions: {
        setValues(payload){
            this.show = payload.show
            this.message = payload.message
            this.color = payload.color
        }
    }
})