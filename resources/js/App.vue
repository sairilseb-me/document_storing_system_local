<script setup>
import { useTheme } from 'vuetify'
import { hexToRgb } from '@layouts/utils'
import DefaultLayout from '@/layouts/default.vue'
import BlankLayout from '@/layouts/blank.vue'
import { useRoute } from 'vue-router';


const { global } = useTheme()
const route = useRoute()


const resolveLayout = computed(() => {
  if(route.meta.layout == 'blank') return BlankLayout
  if(route.meta.layout == 'default') return DefaultLayout

  return null
})

</script>

<template>
  <VApp :style="`--v-global-theme-primary: ${hexToRgb(global.current.value.colors.primary)}`">
    <component :is="resolveLayout">
      <RouterView />
    </component>
  </VApp>
</template>
