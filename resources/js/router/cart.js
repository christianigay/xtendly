export default[
    {
        path:'/cart',
        component: () => import('@/pages/cart/index.vue'),
        name:'cart',
        meta: {layout: 'LayoutDefault', requiresAuth: true}
    },
    
]