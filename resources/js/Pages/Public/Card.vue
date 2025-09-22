<script setup>
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  card: { type: Object, required: true },
  qrUrl: { type: String, required: true }, // route('card.public', slug) from controller
})
</script>

<template>
  <Head :title="card.display_name" />

  <div class="min-h-screen bg-gray-50">
    <div class="mx-auto max-w-xl px-4 py-8">
      <div class="rounded-2xl bg-white p-6 shadow">
        <div class="flex items-center gap-4">
          <img v-if="card.avatar_path" :src="`/storage/${card.avatar_path}`"
               class="h-16 w-16 rounded-full object-cover" alt="avatar" />
          <div>
            <h1 class="text-2xl font-semibold">{{ card.display_name }}</h1>
            <p class="text-gray-500">{{ card.title }}</p>
          </div>
        </div>

        <p v-if="card.bio" class="mt-4 text-gray-700">{{ card.bio }}</p>

        <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
          <a v-if="card.whatsapp" :href="`https://wa.me/${card.whatsapp}`" target="_blank" class="btn">WhatsApp</a>
          <a v-if="card.phone" :href="`tel:${card.phone}`" class="btn">Call</a>
          <a v-if="card.email_public" :href="`mailto:${card.email_public}`" class="btn">Email</a>
          <a v-if="card.website" :href="card.website" target="_blank" class="btn">Website</a>
          <a v-if="card.instagram" :href="card.instagram" target="_blank" class="btn">Instagram</a>
          <a v-if="card.linkedin" :href="card.linkedin" target="_blank" class="btn">LinkedIn</a>
          <a v-if="card.x_handle" :href="`https://x.com/${card.x_handle.replace('@','')}`" target="_blank" class="btn">X (Twitter)</a>
        </div>

        <div class="mt-8">
          <img :src="`/cards/${card.id}/qr.png`" class="mx-auto h-44 w-44" alt="QR" />
          <p class="mt-2 text-center text-xs text-gray-500 break-all">
            Scan to open: {{ qrUrl }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.btn { @apply inline-flex items-center justify-center rounded border px-3 py-2 hover:bg-gray-50; }
</style>
