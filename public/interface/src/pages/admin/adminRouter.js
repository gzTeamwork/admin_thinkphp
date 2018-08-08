import userRouter from '@/pages/admin/user/userRouter';
import postRouter from '@/pages/admin/post/postRouter';
import cateRouter from '@/pages/admin/category/cateRouter';
import advancedRouter from '@/pages/admin/advanced/advancedRouter';
import materialRouter from '@/pages/admin/material/materialRouter';
import orderRouter from '@/pages/admin/order/orderRouter';
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
  advancedRouter,
  orderRouter,
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
