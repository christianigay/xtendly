export default[
    {
        path:'/auth/register',
        component: () => import('@/pages/auth/register.vue'),
        name:'auth-register',
        meta: {layout: 'LayoutAuth'}
    },
    
]