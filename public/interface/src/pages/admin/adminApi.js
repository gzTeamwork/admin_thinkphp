import axios from 'axios';
//  api host
let apiHost = 'http://inforward.localhost.com/inforward/admin';
export default {
  adminLoginSub: function (form) {
    axios.get(apiHost + '/api_admin_login').then(response => {
      console.log(form);
    })
  }
}
