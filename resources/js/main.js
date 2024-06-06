/* eslint-disable import/order */
import '@/@iconify/icons-bundle'
import { createPinia } from 'pinia'
import App from '@/App.vue'

import { createApp } from 'vue'
import router from '@/router'
import vuetify from '@/plugins/vuetify'
import { loadFonts } from '@/plugins/webfontloader'
import '@core-scss/template/index.scss'
import '@layouts/styles/index.scss'
import '@styles/styles.scss'


loadFonts()


// Create vue app
const app = createApp(App)


// Use plugins
app.use(createPinia())
app.use(vuetify)
app.use(router)

// Mount vue app
app.mount('#app')
