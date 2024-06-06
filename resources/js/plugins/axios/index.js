import axios from 'axios'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'



const axiosIns = axios.create({
    baseURL: 'http://localhost:8000/api',
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
    }
)

axios.interceptors.response.use(
    response => response,
    error => {
        const snackbarStore = useGlobalSnackbarStore()
        if (error.response.status == 500)
            {
                snackbarStore.setValues({
                    show: true,
                    message: 'Server Error',
                    color: 'error'
                })
            }
        
        if (error.response.status == 401)
            {
                snackbarStore.setValues({
                    show: true,
                    message: 'Unauthorized login, please login first.',
                    color: 'error'
                })
            }
    }
)

export default axiosIns