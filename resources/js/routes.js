//home component
import adminHome from './components/admin/HomeComponent.vue';
//category component
import categoryList from './components/admin/category/List.vue';
import categoryNew from './components/admin/category/New.vue';
import categoryEdit from './components/admin/category/Edit.vue';
//items component
import itemList from './components/admin/item/List.vue';
import itemNew from './components/admin/item/New.vue';
import itemEdit from './components/admin/item/Edit.vue';
import VueRouter from 'vue-router';

export const routes =[
    //home routes
    {
        path:'/home',
        component:adminHome
    },
    //category routes
    {
        path: '/category-list',
        component: categoryList
    },
    {
        path: '/category-new',
        component: categoryNew
    },
    {
        path: '/category-edit/:id',
        component: categoryEdit
    },
    //item routes
    {
        path: '/item-list',
        component: itemList
    },
    {
        path: '/item-new',
        component: itemNew
    },
    {
        path: '/item-edit/:id',
        component: itemEdit
    }
]
