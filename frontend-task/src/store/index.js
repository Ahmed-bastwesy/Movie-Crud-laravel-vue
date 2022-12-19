import { createStore } from 'vuex'
import { auth } from "./auth.module";
import { movie } from "./movie.module";

const store = createStore({
  modules: {
    auth,
    movie,
  },
});
export default store;
