<template>
  <div class="flex flex-col gap-4">
    <form class="max-w-[600px]" @submit.prevent="submit">
      <Card>
        <CardHeader>
          <CardTitle class="text-2xl">Profile</CardTitle>
          <CardDescription>
            Update your profile information below.
          </CardDescription>
        </CardHeader>
        <CardContent class="grid gap-4">
          <div class="grid gap-2">
            <Label for="name">Name</Label>
            <Input
              id="name"
              type="text"
              placeholder="John Doe"
              v-model="form.state.name"
            />
            <InputError>{{ form.errors?.name }}</InputError>
          </div>
          <div class="grid gap-2">
            <Label for="email">Email</Label>
            <Input id="email" type="email" v-model="form.state.email" />
            <InputError>{{ form.errors?.email }}</InputError>
          </div>
          <CardFooter>
            <div class="flex flex-col gap-2 justify-center w-full">
              <Button class="w-full" type="submit">Update</Button>
            </div>
          </CardFooter>
        </CardContent>
      </Card>
    </form>

    <form class="max-w-[600px]" @submit.prevent="resetPassword">
      <Card>
        <CardHeader>
          <CardTitle class="text-2xl">Password</CardTitle>
          <CardDescription>Change your password.</CardDescription>
        </CardHeader>
        <CardContent class="grid gap-4">
          <div class="grid gap-2">
            <Label for="current_password">Current Password</Label>
            <Input
              id="current_password"
              type="password"
              v-model="passwordForm.state.current_password"
            />
            <InputError>{{ passwordForm.errors?.current_password }}</InputError>
          </div>
          <div class="grid gap-2">
            <Label for="password">New Password</Label>
            <Input
              id="password"
              type="password"
              v-model="passwordForm.state.password"
            />
            <InputError>{{ passwordForm.errors?.password }}</InputError>
          </div>
          <div class="grid gap-2">
            <Label for="password_confirmation">Confirm Password</Label>
            <Input
              id="password_confirmation"
              type="password"
              v-model="passwordForm.state.password_confirmation"
            />
            <InputError>
              {{ passwordForm.errors?.password_confirmation }}
            </InputError>
          </div>
          <CardFooter>
            <div class="flex flex-col gap-2 justify-center w-full">
              <Button class="w-full" type="submit">Update</Button>
            </div>
          </CardFooter>
        </CardContent>
      </Card>
    </form>
  </div>
</template>

<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import InputError from '@/components/input-error.vue';
import { useFormAction, useComponent } from 'vino-vue';
import { useToast } from '@/components/ui/toast/use-toast';

const page = useComponent();
const form = useFormAction(page.value.submit, {
  name: page.value.user.name,
  email: page.value.user.email,
});

const passwordForm = useFormAction(page.value.resetPassword, {
  current_password: '',
  password: '',
  password_confirmation: '',
});

const { toast } = useToast();

async function submit() {
  const response = await form.run();
  if (response.ok) {
    toast({ description: 'Profile updated successfully' });
  }
}

async function resetPassword() {
  const response = await passwordForm.run();
  if (response.ok) {
    toast({ description: 'Password updated successfully' });
    passwordForm.reset();
  }
}
</script>
