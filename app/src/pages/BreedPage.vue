<template>
  <q-dialog v-model="newDialog">
    <q-card>
      <q-card-section>
        <div class="text-h6">Agregar una nueva Raza</div>
      </q-card-section>

      <q-separator />

      <q-card-section style="max-height: 50vh" class="scroll">
        <div class="q-mt-md" style="width: 500px">
          <q-form @submit="onSubmit" class="q-gutter-md">
            <q-input
              filled
              v-model="name"
              label="Nombre de la raza"
              hint="Nombre"
              lazy-rules
              :rules="[
                (val) =>
                  (val && val.length > 0) || 'Porfavor escribe un nombre',
              ]"
            />
            <q-select
              :options="tamanoOptions"
              label="Tamaño de la raza"
              option-label="Tamaño"
              v-model="tamano"
            ></q-select>
            <q-input
              filled
              v-model="hair"
              label="Color de pelo"
              lazy-rules
              :rules="[
                (val) =>
                  (val && val.length > 0) ||
                  'Porfavor escribe el color de pelo',
              ]"
            />
            <q-select
              :options="clasificationOptions"
              label="Clasificación de la raza"
              v-model="clasification"
            ></q-select>
            <q-file
              v-model="file"
              label="Escoge una foto"
              filled
              style="max-width: 300px"
            />
            <div>
              <q-btn label="Enviar" type="submit" color="primary" />
            </div>
          </q-form>
        </div>
      </q-card-section>

      <q-separator />

      <q-card-actions align="right">
        <q-btn flat label="Cerrar" color="primary" v-close-popup />
      </q-card-actions>
    </q-card>
  </q-dialog>
  <q-dialog v-model="editDialog">
    <q-card>
      <q-card-section>
        <div class="text-h6">Editar Raza de Perro</div>
      </q-card-section>

      <q-separator />

      <q-card-section style="max-height: 50vh" class="scroll">
        <div class="q-mt-md" style="width: 500px">
          <q-form @submit="updateBreed" class="q-gutter-md">
            <q-input
              filled
              v-model="name"
              label="Nombre de la raza"
              hint="Nombre"
              lazy-rules
              :rules="[
                (val) =>
                  (val && val.length > 0) || 'Porfavor escribe un nombre',
              ]"
            />
            <q-select
              :options="tamanoOptions"
              label="Tamaño de la raza"
              option-label="Tamaño"
              v-model="tamano"
            ></q-select>
            <q-input
              filled
              v-model="hair"
              label="Color de pelo"
              lazy-rules
              :rules="[
                (val) =>
                  (val && val.length > 0) ||
                  'Porfavor escribe el color de pelo',
              ]"
            />
            <q-select
              :options="clasificationOptions"
              label="Clasificación de la raza"
              v-model="clasification"
            ></q-select>
            <q-file
              v-model="file"
              label="Escoge una foto"
              filled
              style="max-width: 300px"
            />
            <div>
              <q-btn label="Enviar" type="submit" color="primary" />
            </div>
          </q-form>
        </div>
      </q-card-section>

      <q-separator />

      <q-card-actions align="right">
        <q-btn flat label="Cerrar" color="primary" v-close-popup />
      </q-card-actions>
    </q-card>
  </q-dialog>
  <q-dialog v-model="filterDialog">
    <q-card>
      <q-card-section>
        <div class="text-h6">Filtrar una raza de Perro</div>
      </q-card-section>

      <q-separator />

      <q-card-section style="max-height: 50vh" class="scroll">
        <div class="q-mt-md" style="width: 500px">
          <q-form @submit="searchBreed" class="q-gutter-md">
            <q-input
              filled
              v-model="name"
              label="Nombre de la raza"
              hint="Nombre"
            />
            <q-select
              :options="tamanoOptions"
              label="Tamaño de la raza"
              option-label="Tamaño"
              v-model="tamano"
            ></q-select>
            <q-input filled v-model="hair" label="Color de pelo" />
            <q-select
              :options="clasificationOptions"
              label="Clasificación de la raza"
              v-model="clasification"
            ></q-select>
            <div>
              <q-btn label="buscar" type="submit" color="primary" />
            </div>
          </q-form>
        </div>
      </q-card-section>

      <q-separator />

      <q-card-actions align="right">
        <q-btn flat label="Cerrar" color="primary" v-close-popup />
      </q-card-actions>
    </q-card>
  </q-dialog>

  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <q-page class="flex flex-center bg-grey-2 col-12">
        <div class="q-pa-lg row items-start q-gutter-lg">
          <div class="q-pa-md">
            <q-table
              title="Razas de perro"
              :rows="breeds"
              :columns="columns"
              row-key="name"
            >
              <!--Para filtrar le damos al boton -->
              <template v-slot:top-left="">
                <q-btn
                  color="secondary"
                  icon-right="search"
                  label="Filtrar"
                  @click="filterBreed()"
                />
              </template>
              >
              <!-- modificamos los props de este componente a nuestro gusto-->
              <template v-if="visible" v-slot:top-right="">
                <q-btn
                  color="secondary"
                  icon-right="add"
                  label="Agregar"
                  @click="newBreed()"
                />
              </template>

              <template v-slot:body="props">
                <q-tr :props="props">
                  <q-td
                    v-for="col in props.cols"
                    :key="col.name"
                    :props="props"
                  >
                    <span v-if="col.name != 'photo'"> {{ col.value }}</span>

                    <q-avatar
                      v-if="col.name == 'photo'"
                      size="130px"
                      class="shadow-10"
                    >
                      <img :src="props.row.photo" />
                    </q-avatar>
                    <div v-if="visible">
                      <q-btn
                        v-if="col.name == 'actions'"
                        @click="editBreed(props.row)"
                        icon="mode_edit"
                      ></q-btn>
                      <q-btn
                        v-if="col.name == 'actions'"
                        @click="deleteBreed(props.row.id)"
                        icon="delete"
                      ></q-btn>
                    </div>
                  </q-td>
                </q-tr>
              </template>
            </q-table>
          </div>
        </div>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref, watchEffect, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import { useQuasar } from "quasar";
import axios from "axios";
export default defineComponent({
  name: "BreedPage",

  setup() {
    const $q = useQuasar();
    const tamanoOptions = ref(["Grande", "Mediano", "pequeño"]);
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
    const tamano = ref();
    const file = ref();
    const hair = ref();
    const id = ref();
    const name = ref();
    const clasification = ref();
    const clasificationOptions = ref();
    const store = useStore();
    const router = useRouter();
    const newDialog = ref(false);
    const filterDialog = ref(false);
    const editDialog = ref(false);
    const newBreed = () => {
      tamano.value = null;
      hair.value = null;
      name.value = null;
      file.value = null;
      clasification.value = null;
      newDialog.value = true;
    };
    const editBreed = (row) => {
      tamano.value = row.size;
      hair.value = row.hair;
      id.value = row.id;
      name.value = row.breed;
      file.value = null;
      let option = row.classification;
      option.label = option.name;
      clasification.value = option;
      editDialog.value = true;
    };
    const filterBreed = () => {
      tamano.value = null;
      hair.value = null;
      name.value = null;
      file.value = null;
      clasification.value = null;
      filterDialog.value = true;
    };
    const searchBreed = () => {
      let formData = new FormData();
      if (id.value) {
        formData.append("id", id.value);
      }
      if (name.value) {
        formData.append("breed", name.value);
      }
      if (tamano.value) {
        formData.append("size", tamano.value);
      }
      if (hair.value) {
        formData.append("hair", hair.value);
      }
      if (clasification.value) {
        formData.append("classifier_id", clasification.value.id);
      }
      formData.append("_method", "POST");
      axios.get("http://127.0.0.1:8000/sanctum/csrf-cookie");
      axios
        .post("http://127.0.0.1:8000/api/dogs/filter-breed", formData, {
          headers: {
            Authorization: `Bearer ${store.getters.token}`,
          },
        })
        .then((response) => {
          breeds.value = response.data.breeds;
          $q.notify({
            message: "Busqueda realizada!",
            color: "green",
            position: "top",
          });
        });
    };

    const updateBreed = () => {
      let formData = new FormData();
      formData.append("id", id.value);
      formData.append("breed", name.value);
      formData.append("size", tamano.value);
      formData.append("hair", hair.value);
      formData.append("classifier_id", clasification.value.id);
      formData.append("photo", file.value);
      formData.append("_method", "POST");
      axios.get("http://127.0.0.1:8000/sanctum/csrf-cookie");
      axios
        .post("http://127.0.0.1:8000/api/dogs/update-breed", formData, {
          headers: {
            Authorization: `Bearer ${store.getters.token}`,
          },
        })
        .then((response) => {
          $q.notify({
            message: "Raza de perro actualizada!",
            color: "green",
            position: "top",
          });
          router.go();
        });
    };
    const deleteBreed = (id) => {
      let formData = new FormData();
      formData.append("id", id);
      formData.append("_method", "POST");
      axios.get("http://127.0.0.1:8000/sanctum/csrf-cookie");
      axios
        .post("http://127.0.0.1:8000/api/dogs/delete-breed", formData, {
          headers: {
            Authorization: `Bearer ${store.getters.token}`,
          },
        })
        .then((response) => {
          breeds.value = response.data.breeds;
          $q.notify({
            message: "Raza de perro eliminada!",
            color: "green",
            position: "top",
          });
        });
    };
    const onSubmit = async () => {
      let formData = new FormData();
      formData.append("breed", name.value);
      formData.append("size", tamano.value);
      formData.append("hair", hair.value);
      formData.append("classifier_id", clasification.value.id);
      formData.append("photo", file.value);
      formData.append("_method", "POST");
      await axios.get("http://127.0.0.1:8000/sanctum/csrf-cookie");
      await axios
        .post("http://127.0.0.1:8000/api/dogs/create-breed", formData, {
          headers: {
            Authorization: `Bearer ${store.getters.token}`,
          },
        })
        .then((response) => {
          $q.notify({
            message: "Raza de perro creada!",
            color: "green",
            position: "top",
          });

          window.location.reload();
        })
        .catch(function (error) {
          $q.notify({
            message: "Algo inesperado ha pasado, revisa la informacion!",
            color: "red",
            position: "top",
          });
        });
    };
    const visible = ref();
    const checkActions = (user) => {
      visible.value = false;
      if (user) {
        visible.value = true;
      }
    };
    watchEffect(() => {
      checkActions(store.state.user);
    });

    onMounted(async () => {
      await axios
        .get("http://127.0.0.1:8000/api/dogs/get-breeds")
        .then((response) => {
          breeds.value = response.data.breeds;
          clasificationOptions.value = response.data.clasifications;
          console.log(response.data.clasifications);
        });
    });

    return {
      tamano,
      tamanoOptions,
      clasification,
      clasificationOptions,
      onSubmit,
      hair,
      file,
      id,
      name,
      breeds,
      columns,
      newDialog,
      filterDialog,
      editDialog,
      editBreed,
      filterBreed,
      searchBreed,
      deleteBreed,
      newBreed,
      updateBreed,
      visible,
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
