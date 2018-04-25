import HomeAdmin from './components/HomeAdmin.vue';
import Login from './components/auth/Login.vue';
import Posts from './components/posts/Posts';
import CustomersMain from './components/customers/Main.vue';
import CustomersList from './components/customers/List.vue';
import NewCustomer from './components/customers/New.vue';
import Customer from './components/customers/View.vue';

export const routes = [
    {
        path: '/admin',
        component: HomeAdmin,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/',
        component: Posts
    },
    {
        path: '/admin/posts',
        component: CustomersMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: CustomersList
            },
            {
                path: 'new',
                component: NewCustomer
            },
            {
                path: ':id',
                component: Customer
            }
        ]
    }
];