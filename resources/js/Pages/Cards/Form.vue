<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
  card: { type: Object, default: null },
})

const isEdit = !!props.card

const form = useForm({
  slug: props.card?.slug ?? '',
  display_name: props.card?.display_name ?? '',
  title: props.card?.title ?? '',
  bio: props.card?.bio ?? '',
  whatsapp: props.card?.whatsapp ?? '',
  phone: props.card?.phone ?? '',
  email_public: props.card?.email_public ?? '',
  website: props.card?.website ?? '',
  instagram: props.card?.instagram ?? '',
  linkedin: props.card?.linkedin ?? '',
  x_handle: props.card?.x_handle ?? '',
  is_active: props.card?.is_active ?? true,
})

function submit() {
  if (isEdit) {
    form.put(`/cards/${props.card.id}`)
  } else {
    form.post('/cards')
  }
}
</script>

<template>
  <Head :title="isEdit ? 'Edit Card' : 'New Card'" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight">
        {{ isEdit ? 'Edit Card' : 'Create Card' }}
      </h2>
    </template>

    <div class="py-6">
      <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
          <form @submit.prevent="submit" class="p-6 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium">Slug (unique)</label>
                <input v-model="form.slug" :disabled="isEdit"
                       class="mt-1 w-full rounded border-gray-300" placeholder="yourname" />
                <p class="text-xs text-gray-500 mt-1">Public URL: /u/{{ form.slug || 'slug' }}</p>
                <div v-if="form.errors.slug" class="text-xs text-red-600 mt-1">{{ form.errors.slug }}</div>
              </div>

              <div>
                <label class="block text-sm font-medium">Display Name</label>
                <input v-model="form.display_name" class="mt-1 w-full rounded border-gray-300" />
                <div v-if="form.errors.display_name" class="text-xs text-red-600 mt-1">{{ form.errors.display_name }}</div>
              </div>

              <div>
                <label class="block text-sm font-medium">Title</label>
                <input v-model="form.title" class="mt-1 w-full rounded border-gray-300" placeholder="Founder, TapIt" />
              </div>

              <div class="md:col-span-2">
                <label class="block text-sm font-medium">Bio</label>
                <textarea v-model="form.bio" rows="3" class="mt-1 w-full rounded border-gray-300"
                          placeholder="Short description"></textarea>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div><label class="block text-sm font-medium">WhatsApp</label>
                <input v-model="form.whatsapp" class="mt-1 w-full rounded border-gray-300" placeholder="91XXXXXXXXXX" />
              </div>
              <div><label class="block text-sm font-medium">Phone</label>
                <input v-model="form.phone" class="mt-1 w-full rounded border-gray-300" />
              </div>
              <div><label class="block text-sm font-medium">Public Email</label>
                <input v-model="form.email_public" class="mt-1 w-full rounded border-gray-300" />
              </div>
              <div><label class="block text-sm font-medium">Website</label>
                <input v-model="form.website" class="mt-1 w-full rounded border-gray-300" placeholder="https://..." />
                <div v-if="form.errors.website" class="text-xs text-red-600 mt-1">{{ form.errors.website }}</div>
              </div>
              <div><label class="block text-sm font-medium">Instagram</label>
                <input v-model="form.instagram" class="mt-1 w-full rounded border-gray-300" />
              </div>
              <div><label class="block text-sm font-medium">LinkedIn</label>
                <input v-model="form.linkedin" class="mt-1 w-full rounded border-gray-300" />
              </div>
              <div><label class="block text-sm font-medium">X (Twitter) handle</label>
                <input v-model="form.x_handle" class="mt-1 w-full rounded border-gray-300" />
              </div>
            </div>

            <div class="flex items-center justify-between">
              <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" v-model="form.is_active" class="rounded border-gray-300" />
                Active
              </label>
              <div class="flex gap-2">
                <Link href="/cards" class="px-4 py-2 rounded border">Cancel</Link>
                <button :disabled="form.processing"
                        class="rounded bg-gray-900 px-4 py-2 text-white hover:bg-black disabled:opacity-50">
                  {{ form.processing ? 'Saving...' : (isEdit ? 'Save' : 'Create') }}
                </button>
              </div>
            </div>
          </form>
        </div>

        <div v-if="isEdit" class="mt-6">
          <h3 class="text-sm font-semibold mb-2">Public Links</h3>
          <div class="flex gap-2 text-sm">
            <a :href="`/u/${form.slug}`" target="_blank" class="underline">View public page</a>
            <a :href="`/cards/${props.card.id}/qr.png`" target="_blank" class="underline">Download QR</a>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
