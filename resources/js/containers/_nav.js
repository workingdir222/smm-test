export default [
  {
    _name: 'CSidebarNav',
    _children: [
      {
        _name: 'CSidebarNavItem',
        name: 'Dashboard',
        to: '/dashboard',
        icon: 'cil-speedometer',
        badge: {
          color: 'primary',
          text: 'NEW'
        }
      },
      {
        _name: 'CSidebarNavTitle',
        _children: ['inventory']
      },
      {
        _name: 'CSidebarNavItem',
        name: 'User',
        to: '/pages/users',
        icon: 'cil-user'
      },
      {
        _name: 'CSidebarNavDropdown',
        name: 'Product',
        route: '/product',
        icon: 'cil-puzzle',
        items: [
          {
            name: 'Product',
            to: '/pages/product'
          },
          {
            name: 'Inventory',
            to: '/pages/inventory'
          }
        ]
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Request',
        to: '/pages/request',
        icon: 'cil-cursor'
      }
    ]
  }
]