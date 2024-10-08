import axios from 'axios'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'

const axiosIns = axios.create({
    baseURL: `${import.meta.env.VITE_API_URL}/api`,
    headers: {
        'Accept': 'application/json',
    }
})

axiosIns.interceptors.request.use(
    config => {
        const token = localStorage.getItem('token')
        if (token) {
            config.headers.Authorization = `Bearer ${token}`
        }
        return config
})

axiosIns.interceptors.response.use(
    response => response,
    error => {
        const snackbarStore = useGlobalSnackbarStore()
        if (error.response.status == 500)
            {
                snackbarStore.setValues({
                    show: true,
                    message: 'Having problem connecting to Server. Contact your administrator.',
                    color: 'error'
                })  
                return
            }

        if (error.response.status == 422){
            snackbarStore.setValues({
                show: true,
                message: 'Please upload a valid file.',
                color: 'error'
            })

            return
        }
       
    }
)

export default axiosIns