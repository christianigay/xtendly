export default[
    {
        path:'/payment',
        component: () => import('@/pages/payment/index.vue'),
        name:'payment',
        meta: {layout: 'LayoutDefault', requiresAuth: true}
    },
    {
        path:'/payment/approve',
        component: () => import('@/pages/payment/approve.vue'),
        name:'payment-approve',
        meta: {layout: 'LayoutDefault', requiresAuth: true}
    },
    
]