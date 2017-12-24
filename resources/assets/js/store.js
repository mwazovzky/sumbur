import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        catalog: []
    },

    getters: {
        catalog: (state) => state.catalog,
    },

    mutations: {
        init: (state, data) => state.catalog = data,
        add: (state, data) => state.catalog.push(data),
        update: ({ catalog }, data) => {
                let index = catalog.findIndex(item => item.id == data.id);
                catalog[index].name = data.name;
                catalog[index].description = data.description;
            },
        remove: (state, index) => state.catalog.splice(index, 1),
    },

    actions: {
        load: (context) => {
            let endpoint = '/furniture';
            return new Promise ((resolve, reject) => {
                axios.get(endpoint)
                    .then(({ data }) => {
                        context.commit('init', data);
                        resolve(data);
                    })
                    .catch(errors => reject(errors));
            });
        }
    }
});
