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
    <!-- <div class="grid gap-6">
        <div class="grid gap-2">
            <label for="username" class="flex items-center gap-2 text-sm leading-none font-medium select-none group-data-[disabled=true]:pointer-events-none group-data-[disabled=true]:opacity-50 peer-disabled:cursor-not-allowed peer-disabled:opacity-50">Username: </label>
            <input type="text" id="username" name="username" v-model="form.username" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive">
        </div>
    <div class="grid gap-2">
        <div class="flex items-center justify-between">
            <label for="password" class="flex items-center gap-2 text-sm leading-none font-medium select-none group-data-[disabled=true]:pointer-events-none group-data-[disabled=true]:opacity-50 peer-disabled:cursor-not-allowed peer-disabled:opacity-50">Passsword</label>
        </div>
            <input type="password" id="password" name="password" v-model="form.password" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive">

    </div>
    <button type="submit">Login</button>
    </div> -->

    <div class="min-h-screen flex items-center justify-center">
  <div class="bg-white rounded-3xl shadow-xl flex flex-col md:flex-row overflow-hidden max-w-screen-xl w-full mx-4 min-h-[600px]">
    
    <!-- Imagen -->
    <div class="md:w-1/2 w-full">
      <img
        src="https://media.istockphoto.com/id/1588289977/es/foto/feliz-estudiante-negra-durante-una-clase-en-la-sala-de-conferencias-mirando-a-la-c%C3%A1mara.jpg?s=612x612&w=0&k=20&c=uYsHI--vkn0-X6gkHMTZnJMyR8396cM85GJcnsCdduU="
        alt="Welcome"
        class="object-cover h-full w-full"
      />
    </div>

    <!-- Formulario -->
    <div class="md:w-1/2 w-full flex flex-col justify-center p-12 bg-white">
      <h2 class="text-4xl font-extrabold text-blue-600 mb-10 text-center">Welcome Back</h2>
        <div class="relative">
          <img
            src="https://cdn-icons-png.flaticon.com/512/561/561127.png"
            alt="Email"
            class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 opacity-70"
          />
          <input
            type="text"
            placeholder="Username"
            v-model="form.username"
            class="pl-12 pr-4 py-3 w-full rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 text-base shadow-sm transition duration-200"
          />
        </div>

        <div class="relative">
          <img
            src="https://cdn-icons-png.flaticon.com/512/3064/3064155.png"
            alt="Password"
            class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 opacity-70"
          />
          <input
            type="password"
            placeholder="Password"
            v-model="form.password"
            class="pl-12 pr-4 py-3 w-full rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 text-base shadow-sm transition duration-200"
          />
        </div>

        <button
          type="submit"
          class="w-full py-3 bg-blue-500 text-white font-semibold text-lg rounded-lg hover:bg-blue-600 transition duration-300 shadow-md"
        >
          Log In
        </button>

      <div class="text-center mt-6">
        <p class="text-gray-600 text-sm">
          Don't have an account?
          <a href="#" class="text-blue-600 font-semibold hover:underline ml-1">Register</a>
        </p>
      </div>
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

<style>
</style>