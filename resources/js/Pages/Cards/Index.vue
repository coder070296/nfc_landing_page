<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
defineProps({ cards: Array })
</script>

<template>
  <Head title="Cards" />
  <AuthenticatedLayout>
    <template #header><h2 class="text-xl font-semibold">Cards</h2></template>

    <div class="py-6">
      <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
        <div class="flex justify-end mb-3">
          <Link href="/cards/create" class="rounded bg-gray-900 px-4 py-2 text-white text-sm">+ New Card</Link>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
          <div v-for="c in cards" :key="c.id" class="rounded border p-4">
            <div class="font-medium">{{ c.display_name }}</div>
            <div class="text-gray-500 text-sm">@{{ c.slug }}</div>
            <div class="mt-3 flex gap-2">
              <Link :href="`/cards/${c.id}/edit`" class="px-3 py-1 rounded border text-sm">Edit</Link>
              <a :href="`/u/${c.slug}`" target="_blank" class="px-3 py-1 rounded border text-sm">View</a>
              <a :href="`/cards/${c.id}/qr.png`" target="_blank" class="px-3 py-1 rounded border text-sm">QR</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
