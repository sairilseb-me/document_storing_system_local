<script setup>
import AuthProvider from '@/views/pages/authentication/AuthProvider.vue'
import logo from '@images/logo.svg?raw'
import axios from '@axios'
import {useRouter} from 'vue-router'  
import {onMounted, ref} from 'vue'
const form = ref({
  username: '',
  password: '',
  remember: false,
})

const router = useRouter() 

const handleLogin = () => {
  axios.post('/login', form.value)
    .then(response => {
      if (response.status == 200){
        // handle success
        localStorage.setItem('token', response.data.token)
        router.push({name: 'dashboard'})
      }
    })
    .catch(error => {
      console.log(error)
      // handle error
    })

}

onMounted(() => {
  console.log(localStorage.getItem('token'))
})

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
