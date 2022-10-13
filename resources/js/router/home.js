export default[
    {
        path:'/',
        component: () => import('@/pages/home/index.vue'),
        name:'home',
        meta: {layout: 'LayoutAuth'}
    },
    {
        path:'/dashboard',
        component: () => import('@/pages/dashboard/index.vue'),
        name:'dashboard',
        meta: {layout: 'LayoutDefault', requiresAuth:true}
    },
    
]