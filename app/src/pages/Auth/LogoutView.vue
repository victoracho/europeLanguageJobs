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
      let formData = new FormData();
      let token = store.state.token;
      store.commit("SET_USER", null);
      store.commit("SET_TOKEN", null);
      /*
      await axios.get("http://127.0.0.1:8000/sanctum/csrf-cookie");
      await axios
        .post("http://127.0.0.1:8000/api/users/logout", formData, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          if (response.data.success == true) {
            // se actualiza el localstorage con el usuario logeado y el token de acceso
            $q.notify({
              message: "Has cerrado sesion!",
              color: "green",
              position: "top",
            });
          }
          if (response.data.success != true) {
            $q.notify({
              message: "algo ha fallado!",
              color: "red",
              position: "top",
            });
          }
        });
        */
      router.push("/breeds");
    };
    logout();
  },
});
</script>
