export default[
    {
        path:'/',
        component: () => import('@/pages/home/index.vue'),
        name:'home',
        meta: {layout: 'LayoutHome'}
    },
    {
        path:'/dashboard',
        component: () => import('@/pages/dashboard/index.vue'),
        name:'dashboard',
        meta: {layout: 'LayoutDefault'}
    },
    
]