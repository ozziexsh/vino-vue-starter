<php>
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Ozzie\Vino\Page;

Page::name('password.request');

$submit = function (Request $request) {
    $request->validate(['email' => 'required|email']);

    Password::sendResetLink(
        $request->only('email')
    );

    return ['ok' => true];
};
</php>

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
import { ref } from 'vue';

const page = useComponent();
const form = useFormAction(page.value.submit, {
  email: 'hello@ozzie.sh',
});
const showMessage = ref(false);

async function submit() {
  await form.run();
  showMessage.value = true;
}
</script>

<template>
  <form @submit.prevent="submit" class="w-full max-w-sm">
    <Card>
      <CardHeader>
        <CardTitle class="text-2xl">Forgot Password</CardTitle>
        <CardDescription>
          Enter your email below to receive a password reset link.
        </CardDescription>
      </CardHeader>
      <template v-if="showMessage">
        <CardContent>
          <p>
            If the email you entered is associated with an account, you will
            receive an email with instructions on how to reset your password.
          </p>
        </CardContent>
        <CardFooter>
          <Button :as="VinoLink" :href="route('login')" class="w-full">
            Return to login
          </Button>
        </CardFooter>
      </template>
      <template v-else>
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
        </CardContent>
        <CardFooter>
          <div class="flex flex-col gap-2 justify-center w-full">
            <Button class="w-full">Submit</Button>
            <Button variant="link" :as="VinoLink" :href="route('login')">
              Or log in to your account
            </Button>
          </div>
        </CardFooter>
      </template>
    </Card>
  </form>
</template>
