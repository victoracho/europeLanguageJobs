<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title> Clasificación de razas de perros</q-toolbar-title>

        <div>Quasar v{{ $q.version }}</div>
      </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" show-if-above bordered>
      <q-list>
        <q-item-label header> Menu Principal</q-item-label>

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref, watchEffect } from "vue";
import EssentialLink from "components/EssentialLink.vue";
import { useStore } from "vuex";

const userList = [
  {
    title: "Login",
    caption: "acceder al sistema",
    icon: "login",
    link: "/login",
  },
  {
    title: "Razas",
    caption: "Razas de perro",
    icon: "pets",
    link: "/breeds",
  },
];

const adminList = [
  {
    title: "Logout",
    caption: "salir del sistema",
    icon: "logout",
    link: "/logout",
  },
  {
    title: "Razas",
    caption: "Razas de perro",
    icon: "pets",
    link: "/breeds",
  },
  {
    title: "Maquetación",
    caption: "Maquetacion sencilla",
    icon: "star",
    link: "/design",
  },
];

export default defineComponent({
  name: "MainLayout",

  components: {
    EssentialLink,
  },

  setup() {
    const store = useStore();
    const list = ref();
    const leftDrawerOpen = ref(false);
    const checkList = (user) => {
      list.value = userList;
      if (user) {
        list.value = adminList;
      }
    };
    watchEffect(() => {
      checkList(store.state.user);
    });

    return {
      essentialLinks: list,
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
});
</script>
