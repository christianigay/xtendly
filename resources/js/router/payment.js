export default[
    {
        path:'/payment/:id',
        component: () => import('@/pages/payment/index.vue'),
        name:'payment',
        meta: {layout: 'LayoutDefault'}
    },
    {
        path:'/payment/approve',
        component: () => import('@/pages/payment/approve.vue'),
        name:'payment-approve',
        meta: {layout: 'LayoutDefault'}
    },
    
]