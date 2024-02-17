<template>
  <div class="q-pa-md">
    <div class="q-gutter-md row">
      <q-spinner color="primary" size="3em" />
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";
import { useStore } from "vuex";
export default defineComponent({
  name: "LoginView",

  setup() {
    const $q = useQuasar();
    const router = useRouter();
    const store = useStore();
    const logout = async () => {
      store.commit("SET_USER", null);
      store.commit("SET_TOKEN", null);

      router.push("/");
    };
    logout();
  },
});
</script>
