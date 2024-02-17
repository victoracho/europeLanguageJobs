const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        name: "home",
        path: "",
        component: () => import("pages/IndexPage.vue"),
        meta: { title: "Home" },
      },
      {
        name: "Login",
        path: "/login",
        component: () => import("pages/Auth/LoginView.vue"),
        meta: { title: "Login" },
      },
      {
        name: "Breed",
        path: "/breeds",
        component: () => import("pages/BreedPage.vue"),
        meta: { title: "Breed" },
      },
      {
        name: "Logout",
        path: "/logout",
        component: () => import("pages/Auth/LogoutView.vue"),
        meta: { title: "logout" },
      },
      {
        name: "Design",
        path: "/design",
        component: () => import("pages/DesignPage.vue"),
        meta: { title: "design" },
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];
export default routes;
