export function initialize(store, router) {

    router.beforeEach((to, from, next) => {
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        const currentUser = store.state.currentUser;
       
        if (requiresAuth && !currentUser) {
            next('/login');
        } else if (to.path == '/login' && currentUser) {
            next({
                path: '/admin'
            });
        } else {
            let token = localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).token : '';
            if (localStorage.getItem('user') !== null) {
                axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
            }
            next();
        }
    });

    axios.interceptors.response.use(null, (error) => {
        console.log(error.response)
        if (error.response.status == 401) {
            store.commit('logout');
            router.push('/login');
        }

        return Promise.reject(error);
    });





}