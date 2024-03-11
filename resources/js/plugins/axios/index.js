import axios from 'axios'

const axiosIns = axios.create({
    baseURL: 'http://localhost:8000/api'
})

export default axiosIns