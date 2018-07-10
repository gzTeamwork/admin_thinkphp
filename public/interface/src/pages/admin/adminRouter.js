import userRouter from '@/pages/admin/user/userRouter.js';
import postRouter from '@/pages/admin/post/postRouter.js';
//  后台子路由
let subRouter = [
  {
    path: 'login',
    name: 'adminLogin',
    component: () => import('@/pages/admin/login'),
  },
  userRouter,
  postRouter,
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
