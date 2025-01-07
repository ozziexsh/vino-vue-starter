<php>
use Illuminate\Http\Request;
use Ozzie\Vino\Page;
use App\Models\User;

Page::name('register');

$submit = function(Request $request) {
    $data = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',
    ]);

    $data['password'] = bcrypt($data['password']);

    auth()->login($user = User::create($data));

    return redirect()->intended('/home');
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

const page = useComponent();
const form = useFormAction(page.value.submit, {
  name: 'Test User',
  email: 'test@example.com',
  password: '123123123',
  password_confirmation: '123123123',
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
          <Label for="name">Name</Label>
          <Input
            id="name"
            type="text"
            placeholder=""
            v-model="form.state.name"
          />
          <InputError>{{ form.errors?.name }}</InputError>
        </div>
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
          <Label for="password_confirmation">Confirm Password</Label>
          <Input
            id="password_confirmation"
            type="password"
            v-model="form.state.password_confirmation"
          />
          <InputError>{{ form.errors?.password_confirmation }}</InputError>
        </div>
      </CardContent>
      <CardFooter>
        <div class="flex flex-col gap-2 justify-center w-full">
          <Button class="w-full">Create account</Button>
          <Button variant="link" :as="VinoLink" :href="route('login')">
            Or login
          </Button>
        </div>
      </CardFooter>
    </Card>
  </form>
</template>
