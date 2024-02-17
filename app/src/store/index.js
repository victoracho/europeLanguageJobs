import { store } from "quasar/wrappers";
import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import axios from "axios";
/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export default store(function (/* { ssrContext } */) {
  const Store = createStore({
    plugins: [createPersistedState()],
    state: {
      authenticated: false,
      user: {},
      token: {},
    },
    getters: {
      authenticated(state) {
        return state.authenticated;
      },
      user(state) {
        return state.user;
      },
      token(state) {
        console.log(state.token);
        return state.token;
      },
    },
    mutations: {
      SET_AUTHENTICATED(state, value) {
        state.authenticated = value;
      },
      SET_USER(state, value) {
        state.user = value;
      },
      SET_TOKEN(state, value) {
        state.token = value;
      },
    },
    actions: {
      async login({ commit, state }) {
        //cada vez que hacemos login, persistimos con vuex para checar si nuestro user esta activo
        return await axios
          .get("http://127.0.0.1:8000/api/user", {
            headers: { Authorization: `Bearer ${state.token}` },
          })
          .then(({ data }) => {
            commit("SET_USER", data);
            commit("SET_AUTHENTICATED", true);
          });
      },
      logout({ commit }) {
        commit("SET_USER", {});
        commit("SET_AUTHENTICATED", false);
      },
    },

    // enable strict mode (adds overhead!)
    // for dev mode and --debug builds only
    strict: process.env.DEBUGGING,
  });

  return Store;
});
