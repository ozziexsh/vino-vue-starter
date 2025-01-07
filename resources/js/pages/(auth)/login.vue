<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useComponent, useFormAction, VinoLink } from 'vino-vue';
import InputError from '@/components/input-error.vue';

const page = useComponent();
const form = useFormAction(page.value.submit, {
  email: 'test@example.com',
  password: '123123123',
});
</script>

<template>
  <form @submit.prevent="form.run" class="w-full max-w-sm">
    <Card>
      <CardHeader>
        <CardTitle class="text-2xl">Login</CardTitle>
        <CardDescription>
          Enter your email below to login to your account.
        </CardDescription>
      </CardHeader>
      <CardContent class="grid gap-4">
        <div class="grid gap-2">
          <Label for="email">Email</Label>
          <Input
            id="email"
            type="email"
            placeholder="m@example.com"
            v-model="form.state.email"
          />
          <InputError>{{ form.errors?.email }}</InputError>
        </div>
        <div class="grid gap-0.5">
          <div class="grid gap-2">
            <Label for="password">Password</Label>
            <Input
              id="password"
              type="password"
              v-model="form.state.password"
            />
          </div>
          <div class="flex justify-end">
            <Button
              :as="VinoLink"
              variant="link"
              :href="route('password.request')"
              class="p-0 text-xs"
            >
              Forgot your password?
            </Button>
          </div>
          <InputError>{{ form.errors?.password }}</InputError>
        </div>
      </CardContent>
      <CardFooter>
        <div class="flex flex-col gap-2 justify-center w-full">
          <Button class="w-full">Sign in</Button>
          <Button variant="link" :as="VinoLink" :href="route('register')">
            Or create an account
          </Button>
        </div>
      </CardFooter>
    </Card>
  </form>
</template>
