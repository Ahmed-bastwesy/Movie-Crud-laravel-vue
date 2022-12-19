import MovieService from '../services/movie.service';

const user = JSON.parse(localStorage.getItem('user'));
const initialState = { movies: [], categories: [] , selectedCategory: 'select category' }


export const movie = {
    namespaced: true,
    state: initialState,
    actions: {

        categoriesList({ commit }) {
            return MovieService.categoriesList().then(
                categories => {
                    commit('getCategoriesList', categories);
                    return Promise.resolve(categories);
                },
                error => {
                    commit('getCategoriesListFailed');
                    return Promise.reject(error);
                }
            );
        },

        categoryMoviesList({ commit }, { id }) {
            return MovieService.categoryMoviesList(id).then(
                movies => {
                    commit('getCategoryMoviesList', movies);
                    return Promise.resolve(movies);
                },
                error => {
                    commit('getCategoryMoviesListFailed');
                    return Promise.reject(error);
                }
            );
        },

        moviesList({ commit }) {
            return MovieService.moviesList().then(
                movies => {
                    commit('getMoviesList', movies);
                    return Promise.resolve(movies);
                },
                error => {
                    commit('getMoviesListFailed');
                    return Promise.reject(error);
                }
            );
        },
        
        movieUpdated({ commit },{movie,id}) {
            return MovieService.movieUpdate(movie,id).then(
                movie => {
                    commit('movieUpdated', movie);
                    return Promise.resolve(movie);
                },
                error => {
                    commit('movieUpdatedFailed');
                    return Promise.reject(error);
                }
            );
        },
        
        getMovie({ commit },id) {
            return MovieService.getMovie(id).then(
                movie => {
                    commit('getMovie');
                    return Promise.resolve(movie);
                },
                error => {
                    commit('getMovieFailed');
                    return Promise.reject(error);
                }
            );
        },

        movieCreated({ commit },movie) {
            return MovieService.movieCreate(movie).then(
                movie => {
                    commit('movieCreated', movie);
                    return Promise.resolve(movie);
                },
                error => {
                    commit('movieCreatedFailed');
                    return Promise.reject(error);
                }
            );
        },

        movieDelete({ commit }, { id }) {
            return MovieService.movieDestroy(id).then(
                movies => {
                    commit('movieDelete', id);
                    return Promise.resolve(movies);
                },
                error => {
                    commit('movieDeleteFailed');
                    return Promise.reject(error);
                }
            );
        },
    },
    mutations: {
        movieUpdatedFailed(state) {
            state.movies = []
        },
        getMoviesList(state, movies) {
            state.movies = movies;
        },
        getMoviesListFailed(state) {
            state.movies = []
        },
        getMovie(state) {
        },
        getMovieFailed(state) {
            state.movies = []
        },

        getCategoriesList(state, categories) {
            state.categories = categories;
        },
        getCategoriesListFailed(state) {
            state.categories = []
        },

        getCategoryMoviesList(state, movies) {
            state.movies = movies;
        },
        getCategoryMoviesListFailed(state) {
            state.movies = []
        },
        
        movieDelete(state, id) {
            state.movies.splice(state.movies.findIndex(movie => movie.id == id),1);
        },
        movieDeleteFailed(state) {
            state.movies = []
        },

        movieCreated(state, movie) {
            state.movies.push(movie.message);
        },
        movieCreatedFailed(state) {
            state.movies = []
        },

        movieUpdated(state, mov) {
            state.movies.find(movie => movie.id == mov.message.id).name = mov.message.name;
            state.movies.find(movie => movie.id == mov.message.id).description = mov.message.description;
            state.movies.find(movie => movie.id == mov.message.id).image = mov.message.image;
            state.movies.find(movie => movie.id == mov.message.id).category_id = mov.message.category_id;
        },
    }
};