<template>
  <q-page class="flex flex-center"> </q-page>
</template>

<script>
import { defineComponent } from "vue";
import axios from "axios";

export default defineComponent({
  name: "IndexPage",
  setup() {
    axios.get("http://127.0.0.1:8000/sanctum/csrf-cookie").then((response) => {
      console.log(response);
    });
  },
});
</script>
