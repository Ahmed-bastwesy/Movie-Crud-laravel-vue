import axios from 'axios';
import authHeader from './auth-header';
const API_URL = 'https://test-api.storexweb.com/api/';

class MovieService {

    categoriesList() {
        return axios
            .get(API_URL + 'category', { headers: authHeader() })
            .then(response => {
                return response.data.message;
            });
    }
    categoryMoviesList(id) {
        return axios
            .get(API_URL + 'moviesByCategory/' +id, { headers: authHeader() })
            .then(response => {
                return response.data.message;
            });
    }
    moviesList() {
        return axios
            .get(API_URL + 'movies', { headers: authHeader() })
            .then(response => {
                return response.data.message;
            });
    }

    getMovie(id) {
        return axios
            .get(API_URL + 'movies/' + id, { headers: authHeader() })
            .then(response => {
                return response.data.message;
            });
    }

    movieCreate(movie) {
        return axios.post(API_URL + 'movies', {
            name: movie.name,
            description: movie.description,
            image: movie.image,
            category_id: movie.category_id,
        }, { headers: authHeader()  }).then(response => {
            return response.data;
        });
    }

    movieUpdate(movie, id) {
        let user = JSON.parse(localStorage.getItem('user'));

        return axios.post(API_URL + 'movies/' + id, {
            name: movie.name,
            description: movie.description,
            image: movie.image,
            category_id: movie.category_id,
            _method: 'PUT',
        }, { headers: authHeader()}).then(response => {
            return response.data;
        });
    }

    movieDestroy(id) {
        return axios.delete(API_URL + 'movies/' + id, { headers: authHeader() }, {
            _method: "delete",
        }).then(response => {
            return response.data;
        });
    }
}

export default new MovieService();