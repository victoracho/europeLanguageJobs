<template>
  <div class="q-pa-md">
    <q-layout
      view="lHh lpr lFf"
      container
      style="height: 400px"
      class="shadow-2 rounded-borders background-page"
    >
      <q-header elevated>
        <q-toolbar
          class="q-toolbar row no-wrap items-center relative-position q-pa-none q-toolbar-normal bg-primary text-white"
        >
          <template v-slot:default>
            <div class="row col-12">
              <div class="col-2"></div>
              <div class="col-3">
                <q-avatar>
                  <img
                    src="https://www.europelanguagejobs.com/statics/images/logo-elj-white.svg"
                  />
                </q-avatar>
              </div>
              <div class="col-2"></div>
              <div class="col-5">
                <q-btn no-caps color="primary" label="Jobs" />
                <q-btn no-caps color="primary" label="Candidates" />
                <q-btn no-caps color="primary" label="For Employers" />
                <q-btn no-caps color="primary" label="Career Advice" />
                <q-btn no-caps color="primary" label="Log in / Sign up" />
              </div>
            </div>
          </template>
        </q-toolbar>
      </q-header>
    </q-layout>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "DesignPage",
});
</script>
<style>
.bg-primary {
  background: #0d3762 !important;
}
.background-page {
  background-size: cover;
  background-image: url(https://www.europelanguagejobs.com/statics/images/header/companies.png);
  background-position: 50%;
}
.background-page .banner-container {
  padding-top: 20px;
  padding-bottom: 80px;
}
</style>
