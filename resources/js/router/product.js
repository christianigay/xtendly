export default[
    {
        path:'/product/list',
        component: () => import('@/pages/product/list.vue'),
        name:'product-list',
        meta: {layout: 'LayoutDefault', requiresAuth: true}
    },
    {
        path:'/product/add',
        component: () => import('@/pages/product/add.vue'),
        name:'product-add',
        meta: {layout: 'LayoutDefault', requiresAuth: true}
    },
    {
        path:'/product/edit/:id',
        component: () => import('@/pages/product/edit.vue'),
        name:'product-edit',
        meta: {layout: 'LayoutDefault', requiresAuth: true}
    },
    
]