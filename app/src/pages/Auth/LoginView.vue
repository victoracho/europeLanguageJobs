<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <q-page class="flex flex-center bg-grey-2">
        <q-card class="q-pa-md shadow-2 my_card" bordered>
          <q-card-section class="text-center">
            <div class="text-grey-9 text-h5 text-weight-bold">
              Iniciar Sesion
            </div>
            <div class="text-grey-8">Inicia sesion para ver</div>
          </q-card-section>
          <q-card-section>
            <q-input
              dense
              outlined
              v-model="email"
              label="Correo Electronico"
            ></q-input>
            <q-input
              dense
              outlined
              class="q-mt-md"
              v-model="password"
              type="password"
              label="Contrasena"
            ></q-input>
          </q-card-section>
          <q-card-section>
            <q-btn
              style="border-radius: 8px"
              color="dark"
              rounded
              size="md"
              label="Acceder"
              @click="login"
              no-caps
              class="full-width"
            ></q-btn>
          </q-card-section>
          <q-card-section class="text-center q-pt-none"> </q-card-section>
        </q-card>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";
import { useQuasar } from "quasar";
import axios from "axios";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
export default defineComponent({
  name: "LoginView",

  setup() {
    const $q = useQuasar();
    const email = ref("");
    const password = ref("");
    const router = useRouter();
    const store = useStore();
    const login = async () => {
      let formData = new FormData();
      formData.append("email", email.value);
      formData.append("password", password.value);
      formData.append("_method", "POST");
      await axios.get("http://127.0.0.1:8000/sanctum/csrf-cookie");
      await axios
        .post("http://127.0.0.1:8000/api/users/login", formData)
        .then((response) => {
          if (response.data.success == true) {
            // se actualiza el localstorage con el usuario logeado y el token de acceso
            store.commit("SET_USER", response.data.user);
            $q.notify({
              message: "Has iniciado sesion!",
              color: "green",
              position: "top",
            });
            router.push("/breeds");
          }
          if (response.data.success != true) {
            $q.notify({
              message: "algo ha fallado!",
              color: "red",
              position: "top",
            });
          }
        });
    };

    return {
      email,
      password,
      login,
    };
  },
});
</script>

<style>
.my_card {
  width: 25rem;
  border-radius: 8px;
  box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1),
    0 8px 10px -6px rgb(0 0 0 / 0.1);
}
</style>
