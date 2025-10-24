<template>
  <form @submit.prevent="submit()">
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" v-model="form.fname">
    <label for="mname">Middle Name:</label>
    <input type="text" id="mname" name="mname" v-model="form.mname">
    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" v-model="form.lname">
    <label for="doc_type">Document Type:</label>
    <input type="text" id="doc_type" name="doc_type" v-model="form.doc_type">
    <label for="notes">Notes:</label>
    <input type="text" id="notes" name="notes" v-model="form.notes">
    <label for="action">Action:</label>
    <input type="text" id="action" name="action" v-model="form.action">
    <button type="submit">Submit</button>
  </form>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {

  data() {
    return {
      form: useForm({
        'request_id': '',
        'fname': '',
        'mname': '',
        'lname': '',
        'doc_type': '',
        'notes': '',
        'action': '',
        'origin_user': '',
        'origin_division': '',
        'new_division': '',
        'new_user': '',
      })
    }
  },

  methods: {
    submit() {
      this.form.post(route('create.store'), {
        onFinish: () => this.form.reset,

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