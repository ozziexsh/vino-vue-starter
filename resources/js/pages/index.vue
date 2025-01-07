<template>
  <div class="p-4 space-y-4">
    <p>This is just a default page. Click through to see the designed pages.</p>
    <div>
      <Button variant="link" :as="VinoLink" :href="route('login')">
        Login
      </Button>
      <Button variant="link" :as="VinoLink" :href="route('register')">
        Register
      </Button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { VinoLink } from 'vino-vue';
import { Button } from '@/components/ui/button';
</script>
