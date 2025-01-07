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
import { useComponent, useFormAction } from 'vino-vue';
import InputError from '@/components/input-error.vue';

const page = useComponent();
const form = useFormAction(page.value.submit, {
  email: '',
  password: '',
  password_confirmation: '',
  token: page.value.token,
});
</script>

<template>
  <form @submit.prevent="form.run" class="w-full max-w-sm">
    <Card>
      <CardHeader>
        <CardTitle class="text-2xl">Reset Password</CardTitle>
        <CardDescription>Enter your new password below.</CardDescription>
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
        <div class="grid gap-2">
          <Label for="password">Password</Label>
          <Input id="password" type="password" v-model="form.state.password" />
          <InputError>{{ form.errors?.password }}</InputError>
        </div>
        <div class="grid gap-2">
          <Label for="password_confirmation">Password Again</Label>
          <Input
            id="password_confirmation"
            type="password"
            v-model="form.state.password_confirmation"
          />
          <InputError>{{ form.errors?.password_confirmation }}</InputError>
        </div>
      </CardContent>
      <CardFooter>
        <Button class="w-full">Submit</Button>
      </CardFooter>
    </Card>
  </form>
</template>
