import Vue from 'vue'
import Router from 'vue-router'

import TheContainer from '../containers/TheContainer'

import Dashboard from '../views/Dashboard'

import Product from '../pages/product/Product'
import AddProduct from '../pages/product/AddProduct'

import Inventory from '../pages/product-inventory/Inventory'
import AddInventory from '../pages/product-inventory/AddInventory'

import User from '../pages/users/User'
import AddUser from '../pages/users/AddUser'

import ProductRequest from '../pages/request-product/Request'
import AddProductRequest from '../pages/request-product/AddRequest'

Vue.use(Router)

export default new Router({
  mode: 'history',
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})

function configRoutes () {
  return [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: TheContainer,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'pages',
          redirect: '/pages/user',
          name: 'User',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'users',
              name: 'List',
              component: User
            },
            {
              path: 'users/add',
              name: 'Add Users',
              component: AddUser
            },
          ]
        },
        {
          path: 'pages',
          redirect: '/pages/product',
          name: 'Product',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'product',
              name: 'List',
              component: Product
            },
            {
              path: 'product/add',
              name: 'Add Product',
              component: AddProduct
            },
          ]
        },
        {
          path: 'pages',
          redirect: '/pages/inventory',
          name: 'Inventory',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'inventory',
              name: 'List',
              component: Inventory
            },
            {
              path: 'inventory/add',
              name: 'Add Inventory',
              component: AddInventory
            },
          ]
        },
        {
          path: 'pages',
          redirect: '/pages/request',
          name: 'Request',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'request',
              name: 'List',
              component: ProductRequest
            },
            {
              path: 'request/add',
              name: 'Add Request',
              component: AddProductRequest
            },
          ]
        },
      ]
    }
  ]
}

