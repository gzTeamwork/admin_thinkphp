export default {
  path: 'order',
  name: '订单',
  component: {
    template: '<router-view/>'
  },
  children: [
    {
      path: 'booking',
      name: '看盘预约',
      component: () => import('./orderBooking'),
    },
    {
      path: 'benefit_dynamic',
      name: '公益留言',
      component: () => import('./orderBenefitDynamic'),
    }
  ]
}
