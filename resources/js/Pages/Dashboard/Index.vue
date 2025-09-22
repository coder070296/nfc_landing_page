<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  cards: { type: Array, default: () => [] }, // each with visits_count (from controller)
})
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight">Dashboard</h2>
    </template>

    <div class="py-6">
      <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-medium">Your Cards</h3>
          <Link href="/cards/create"
                class="rounded-md bg-gray-900 px-4 py-2 text-white text-sm hover:bg-black">
            + New Card
          </Link>
        </div>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr class="text-left text-xs font-semibold text-gray-600">
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Slug</th>
                <th class="px-4 py-3">Visits</th>
                <th class="px-4 py-3">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <tr v-for="c in cards" :key="c.id" class="text-sm">
                <td class="px-4 py-3">{{ c.display_name }}</td>
                <td class="px-4 py-3">@{{ c.slug }}</td>
                <td class="px-4 py-3">{{ c.visits_count ?? 0 }}</td>
                <td class="px-4 py-3 flex gap-2">
                  <Link :href="`/cards/${c.id}/edit`" class="px-3 py-1 rounded border">Edit</Link>
                  <a :href="`/u/${c.slug}`" target="_blank" class="px-3 py-1 rounded border">View</a>
                  <a :href="`/cards/${c.id}/qr.png`" target="_blank" class="px-3 py-1 rounded border">QR</a>
                </td>
              </tr>

              <tr v-if="!cards?.length">
                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                  No cards yet. Create your first one →
                  <Link href="/cards/create" class="underline">New Card</Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
