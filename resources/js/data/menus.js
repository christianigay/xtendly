const menus = [
    {
        icon: 'font_download',
        title: 'Home',
        to: '/'
    },
    {
        icon: 'mdi-magnify',
        title: 'Search',
        to: ''
    },
    {
        icon: 'mdi-notebook-outline',
        title: 'Files',
        to: ''
    },
    {
        icon: 'mdi-book-open-page-variant',
        title: 'Library',
        to: ''
    },
    {
        icon: 'mdi-cog-outline',
        title: 'Settings',
        children: [
            {
                icon: 'mdi-account-group-outline',
                title: 'Users',
                to: ''
            },
            {
                icon: 'mdi-account-settings',
                title: 'Roles',
                to: ''
            },
            {
                icon: 'mdi-shield-account-outline',
                title: 'Permissions',
                to: ''
            },
            {
                icon: 'mdi-family-tree',
                title: 'Categories',
                to: ''
            },
        ],
    }
  ]
  
  export { menus }