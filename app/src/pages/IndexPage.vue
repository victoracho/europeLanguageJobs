<template>
  <div class="q-pa-md">
    <q-carousel
      v-model="slide"
      transition-prev="slide-right"
      transition-next="slide-left"
      animated
      control-color="primary"
      class="rounded-borders"
    >
      <q-carousel-slide name="style" class="column no-wrap flex-center">
        <q-icon name="style" color="primary" size="56px" />
        <div class="q-mt-md text-center">
          <div class="text-h3">
            Esta es una prueba con quasar y laravel, en la cual se muestra una
            lista de razas de perros a las que se pueden consultar, editar y
            eliminar.
          </div>
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="tv" class="column no-wrap flex-center">
        <q-icon name="live_tv" color="primary" size="56px" />
        <div class="q-mt-md text-center">
          <div class="text-h3">
            Fue hecho con quasar 2.14, Laravel 8 y mysql.
          </div>
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="layers" class="column no-wrap flex-center">
        <q-icon name="layers" color="primary" size="56px" />
        <div class="q-mt-md text-center">
          <div class="text-h3">
            Fue realizada por Victor Gonzalez Pereira, bajo la supervision de
            europeLanguageJobs, con el proposito de demostrar manejo de Vue y
            Laravel.
          </div>
        </div>
      </q-carousel-slide>
    </q-carousel>

    <div class="row justify-center">
      <q-btn-toggle
        glossy
        v-model="slide"
        :options="[
          { label: 1, value: 'style' },
          { label: 2, value: 'tv' },
          { label: 3, value: 'layers' },
        ]"
      />
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import axios from "axios";

export default defineComponent({
  name: "IndexPage",
  setup() {
    return {
      slide: ref("style"),
    };
  },
});
</script>
