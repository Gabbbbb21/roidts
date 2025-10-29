<template>
    <form @submit.prevent="update()">
        <div class="card">
            <div class="card-body">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" v-model="form.fname">
            </div>
            <button type="submit">Update</button>
        </div>
    </form>
</template>

<script>
import { useForm } from "@inertiajs/vue3"

export default {

    data() {
        return {
            form: useForm({
                request_id: this.requests.request_id,
                fname: this.requests.fname,
            })
        }
    },

    props: {
        requests: Object
    },

    methods: {
        update() {

            this.form.put(route('pending.update', this.form.request_id), {
                onError: (errors) => {
                    console.log("Error during update:", errors);
                },
                onSuccess: () => {
                    console.log('Update successful! Inertia handles navigation.');
                }
            });
        }
    }
}
</script>

<style></style>