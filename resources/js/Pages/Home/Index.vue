<script setup>
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Home" />
  <div class="min-h-screen flex items-center justify-center">
    <div class="max-w-xl text-center">
      <h1 class="text-3xl font-semibold mb-3">Welcome 👋</h1>
      <p class="text-gray-600 mb-6">This is your NFC/QR MVP.</p>
      <div class="flex gap-3 justify-center">
        <Link href="/login" class="rounded px-4 py-2 border">Login</Link>
        <Link href="/register" class="rounded px-4 py-2 bg-black text-white">Register</Link>
      </div>
    </div>
  </div>
</template>
