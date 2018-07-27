import userRouter from '@/pages/admin/user/userRouter.js';
import postRouter from '@/pages/admin/post/postRouter.js';
import cateRouter from '@/pages/admin/category/cateRouter.js';
import materialRouter from "@/pages/admin/material/materialRouter";
//  后台子路由
let subRouter = [
    {
        path: 'login',
        name: 'adminLogin',
        component: () => import('@/pages/admin/login'),
    },
    userRouter,
    postRouter,
    cateRouter,
    materialRouter,
    {
        path: '*',
        component: () => import('@/pages/admin/index'),
    }
]


export default {
    path: '/admin',
    name: '系统首页',
    component: () => import('@/pages/admin/dashboard'),
    children: subRouter
}
