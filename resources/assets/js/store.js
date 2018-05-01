import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        customers: [],
        tags: [],
        posts: [],
        users:[]


    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        customers(state) {
            return state.customers;
        },
        tags(state){
            return state.tags;
        },
        users(state){
            return state.tags;
        }
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        updateCustomers(state, payload) {
            state.customers = payload;
        },
        updateTags(state, payload){
            state.tags=payload
        },
        updatePosts(state, payload) {
            state.posts=payload
        },
        updateUsers(state, payload) {
            state.users=payload
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getCustomers(context) {
            
            axios.get('/api/customers')
            .then((response) => {
                context.commit('updateCustomers', response.data.customers);
            })
        },
        getTags(context) {
            axios.get('/api/tags')
                .then((response) => {
                    context.commit('updateTags', response.data.tags);
            })
        },
        getPost(context) {
            axios.get('/api/posts')
                .then((response) => {
                    context.commit('updatePosts', response.data.posts);
            })
        },
        getUsers(context) {
            axios.get('/api/users')
                .then((response) => {
                    console.log(response.data.data);
                    console.log(context.getters.currentUser.id)
                    let othersUser = response.data.data.filter(item => item.id !== context.getters.currentUser.id)

                    context.commit('updatePosts', othersUser);
                })
        }

    }
};