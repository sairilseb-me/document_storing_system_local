<script setup>
import avatar1 from '@images/avatars/avatar-default.jpg'
import axios from '@axios'
import { useRouter } from 'vue-router'
import { useGlobalSnackbarStore } from '@/store/GlobalSnackbar';


const router = useRouter()
const globalSnackbar = useGlobalSnackbarStore()

const username = localStorage.getItem('user').username

const handleLogout = () => {
  axios.post('/logout', { 
    headers: {
    'Authorization': 'Bearer ' + localStorage.getItem('token'),
    'Content-Type': 'application/json'
    }
  })
    .then(response => {
      if (response.status == 200){
        // handle success
        localStorage.removeItem('token')
        router.push({name: 'login'})
        globalSnackbar.setValues({
          show: true,
          message: 'Logout successful',
          color: 'success'
        })
      }
    })
    .catch(error => {
      // handle error
      globalSnackbar.setValues({
        show: true,
        message: 'An error occurred while logging out',
        color: 'error'
      })
    })

}
</script>

<template>
  <VBadge
    dot
    location="bottom right"
    offset-x="3"
    offset-y="3"
    color="success"
    bordered
  >
    <VAvatar
      class="cursor-pointer"
      color="primary"
      variant="tonal"
    >
      <VImg :src="avatar1" />

      <!-- SECTION Menu -->
      <VMenu
        activator="parent"
        width="230"
        location="bottom end"
        offset="14px"
      >
        <VList>
          <!-- 👉 User Avatar & Name -->
          <VListItem>
            <template #prepend>
              <VListItemAction start>
                <VBadge
                  dot
                  location="bottom right"
                  offset-x="3"
                  offset-y="3"
                  color="success"
                >
                  <VAvatar
                    color="primary"
                    variant="tonal"
                  >
                    <VImg :src="avatar1" />
                  </VAvatar>
                </VBadge>
              </VListItemAction>
            </template>

            <VListItemTitle class="font-weight-semibold">
              {{ username }}
            </VListItemTitle>
            <VListItemSubtitle>Admin</VListItemSubtitle>
          </VListItem>
          <!-- Divider -->
          <VDivider class="my-2" />

          <!-- 👉 Logout -->
          <VListItem @click="handleLogout">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="bx-log-out"
                size="22"
              />
            </template>

            <VListItemTitle>Logout</VListItemTitle>
          </VListItem>
        </VList>
      </VMenu>
      <!-- !SECTION -->
    </VAvatar>
  </VBadge>
</template>
