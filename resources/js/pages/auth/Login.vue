<!-- <script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <AuthBase
        title="Log in to your account"
        description="Enter your email and password below to log in"
    >
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm"
                            :tabindex="5"
                        >
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="mt-4 w-full"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <LoaderCircle
                        v-if="processing"
                        class="h-4 w-4 animate-spin"
                    />
                    Log in
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Don't have an account?
                <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
            </div>
        </Form>
    </AuthBase>
</template> -->
<template>
  <form @submit.prevent="handleLogin()" class="flex flex-col gap-6">
    <div class="min-h-screen flex items-center justify-center">
      <div
        class="bg-white rounded-3xl shadow-xl flex flex-col md:flex-row overflow-hidden max-w-screen-xl w-full mx-4 min-h-[600px]">

        <div class="md:w-1/2 w-full">
          <img
            src="https://media.istockphoto.com/id/1588289977/es/foto/feliz-estudiante-negra-durante-una-clase-en-la-sala-de-conferencias-mirando-a-la-c%C3%A1mara.jpg?s=612x612&w=0&k=20&c=uYsHI--vkn0-X6gkHMTZnJMyR8396cM85GJcnsCdduU="
            alt="Welcome" class="object-cover h-full w-full" />
        </div>

        <div class="md:w-1/2 w-full flex flex-col justify-center p-12 bg-white">
          <h2 class="text-4xl font-extrabold text-blue-600 mb-10 text-center">Welcome Back</h2>
          <div class="relative m-4">
            <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Email"
              class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 opacity-70" />
            <input type="text" placeholder="Username" v-model="form.username"
              class="pl-12 pr-4 py-3 w-full rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 text-base shadow-sm transition duration-200" />
          </div>

          <div class="relative m-4">
            <img src="https://cdn-icons-png.flaticon.com/512/3064/3064155.png" alt="Password"
              class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 opacity-70" />
            <input type="password" placeholder="Password" v-model="form.password"
              class="pl-12 pr-4 py-3 w-full rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 text-base shadow-sm transition duration-200" />
          </div>

          <button type="submit"
            class="w-full m-4 py-3 bg-blue-500 text-white font-semibold text-lg rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
            Log In
          </button>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
import { useForm } from '@inertiajs/vue3'

export default {

  data() {
    return {
      form: useForm({
        username: '',
        password: '',
      })
    }
  },

  methods: {
    handleLogin() {
      this.form.post(route("auth.authenticate"), {
        onError: (errors) => {
          console.log(errors)
        },

      })
    }
  }
}
</script>

<style></style>