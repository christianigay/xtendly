export default[
    {
        path:'/auth/register',
        component: () => import('@/pages/auth/register.vue'),
        name:'auth-register',
        meta: {layout: 'LayoutAuth'}
    },
    {
        path:'/auth/login',
        component: () => import('@/pages/auth/login.vue'),
        name:'auth-login',
        meta: {layout: 'LayoutAuth'}
    },
    
]