import HomeAdmin from './components/HomeAdmin.vue';
import Login from './components/auth/Login.vue';
import Posts from './components/posts/Posts';
import TagsMain from './components/Tags/Main.vue';
import TagsList from './components/Tags/List.vue';
import NewTags from './components/Tags/New.vue';
import TagView from './components/Tags/View.vue';
import EditView from './components/Tags/edit.vue'
import RegisterUser from './components/Users/Register'

export const routes = [{
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
        path: '/register',
        component: RegisterUser
    },
    {
        path: '/',
        component: Posts
    },

    {
        path: '/admin/tags',
        component: TagsMain,
        meta: {
            requiresAuth: true
        },
        children: [{
                path: '/',
                component: TagsList,
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: 'new',
                component: NewTags,
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: 'view/:id',
                component: TagView,
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: 'edit/:id',
                component: EditView,
                meta: {
                    requiresAuth: true
                }
            }
        ]
    }
];