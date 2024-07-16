<script setup>
import axios from '@axios'
import {useRouter} from 'vue-router'  
import {onMounted, ref} from 'vue'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar'
import { load } from 'webfontloader';
const form = ref({
  username: '',
  password: '',
  remember: false,
})

const loading = ref(false)

const router = useRouter() 
const globalSnackBar = useGlobalSnackbarStore()

const handleLogin = () => {
  loading.value = true
  if (!form.value.username || !form.value.password) {
    globalSnackBar.setValues({
      show: true,
      color: 'error',
      message: 'Please fill in all fields'
    })
    return
  }
  axios.post('/login', form.value)
    .then(response => {
      if (response.status == 200){
        // handle success
        localStorage.setItem('token', response.data.token)
        localStorage.setItem('user', JSON.stringify(response.data.user))
        router.push({name: 'dashboard'})
      }
    })
    .catch(error => {
      console.log(error)
      globalSnackBar.setValues({
          show: true,
          color: 'error',
          message: 'Invalid username or password'
        })
    }).finally(() => {
      loading.value = false
    })

}

const isPasswordVisible = ref(false)
</script>

<template>
  <div class="auth-wrapper d-flex align-center justify-center pa-4">
    <VCard
      class="auth-card pa-4 pt-7"
      max-width="448"
    >

      <VCardText class="pt-2">
        <h5 class="text-h5 mb-1">
          Document Management System
        </h5>
      </VCardText>

      <VCardText>
        <VForm @submit.prevent="handleLogin">
          <VRow>
            <!-- email -->
            <VCol cols="12">
              <VTextField
                v-model="form.username"
                autofocus
                label="Username"
                type="text"
              />
            </VCol>

            <!-- password -->
            <VCol cols="12">
              <VTextField
                v-model="form.password"
                label="Password"
                placeholder="············"
                :type="isPasswordVisible ? 'text' : 'password'"
                :append-inner-icon="isPasswordVisible ? 'bx-hide' : 'bx-show'"
                @click:append-inner="isPasswordVisible = !isPasswordVisible"
                class="mb-5"
              />

              <!-- login button -->
              <VBtn
                block
                type="submit"
                :loading="loading"
              >
                Login
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </div>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
</style>
