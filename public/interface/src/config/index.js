export default {
  'isDev': process.env.NODE_ENV !== 'development',
  'apiServer': process.env.NODE_ENV === 'development' ? 'http://inforward.localhost.com/inforward/admin/api' : 'http://admin.inforward.com.cn/',
  'mockOpen': false,
}
