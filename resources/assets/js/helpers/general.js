export function initialize(store, router) {

    router.beforeEach((to, from, next) => {
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        const currentUser = store.state.currentUser;
        console.log(to, from)
        if(requiresAuth && !currentUser) {
            next('/login');
        } else if(to.path == '/login' && currentUser) {
            next({path:'/admin'});
        } else {
            next();
        }
    });
    
    axios.interceptors.response.use(null, (error) => {
        if (error.resposne.status == 401) {
            store.commit('logout');
            router.push('/login');
        }

        return Promise.reject(error);
    });

    if(store.getters.currentUser !== null){
        axios.defaults.headers.common["Authorization"] = `Bearer ${store.getters.currentUser.token}`

    }




}