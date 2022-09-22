export default[
    {
        path:'/',
        component: () => import('@/pages/home/index.vue'),
        name:'home',
        meta: {layout: 'LayoutDefault'}
    },
    
]