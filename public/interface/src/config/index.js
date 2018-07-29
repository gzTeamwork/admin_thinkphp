export default {
  'isDev': process.env.NODE_ENV !== 'development',
  'apiServer': process.env.NODE_ENV === 'development' ? 'http://inforward.localhost.com/inforward/admin/api' : '',
  'mockOpen': false,
}
