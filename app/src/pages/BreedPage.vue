<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <q-page class="flex flex-center bg-grey-2 col-12">
        <div class="q-pa-lg row items-start q-gutter-lg">
          <div class="q-pa-md">
            <q-table
              title="Razas de perros"
              :rows="breeds"
              :columns="columns"
              row-key="name"
            >
              <template v-slot:body-cell-name="props">
                <q-td :props="props">
                  <q-avatar size="150px" class="shadow-10">
                    <img :src="props.row.photo" />
                  </q-avatar>
                </q-td>
              </template>
            </q-table>
          </div>
        </div>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import { useQuasar } from "quasar";
import axios from "axios";
export default defineComponent({
  name: "BreedPage",

  setup() {
    const $q = useQuasar();
    const columns = [
      {
        name: "photo",
        align: "center",
        label: "Foto",
        field: "photo",
        sortable: true,
      },
      {
        name: "breed",
        align: "center",
        label: "Raza",
        field: "breed",
        sortable: true,
      },
      {
        name: "size",
        align: "center",
        label: "Tamaño",
        field: "size",
        sortable: true,
      },
      {
        name: "hair",
        align: "center",
        label: "Color de pelo",
        field: "hair",
        sortable: true,
      },
      {
        name: "clasification",
        align: "center",
        label: "Clasificacion",
        field: "clasification",
        sortable: true,
      },
      {
        name: "actions",
        align: "center",
        label: "Acciones",
      },
    ];
    const breeds = ref();
    onMounted(async () => {
      await axios
        .get("http://127.0.0.1:8000/api/dogs/get-breeds")
        .then((response) => {
          breeds.value = response.data.breeds;
        });
    });

    return {
      breeds,
      columns,
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
