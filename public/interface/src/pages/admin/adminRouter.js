import userRouter from '@/pages/admin/user/userRouter.js';

//  后台子路由
let subRouter = [
  {
    path: 'login',
    name: 'adminLogin',
    component: () => import('@/pages/admin/login'),
  }, userRouter, {
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
