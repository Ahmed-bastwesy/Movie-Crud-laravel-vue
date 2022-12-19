export default function authHeader() {
    let user = JSON.parse(localStorage.getItem('user'));
  
    if (user && user.authorisation.token) {
      return { Authorization: 'Bearer ' + user.authorisation.token ,'Accept': 'application/json','Content-Type': 'multipart/form-data' };
    } else {
      return {};
    }
  }