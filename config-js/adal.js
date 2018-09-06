export default {
  instance: 'https://login.microsoftonline.com/', 
  tenant: 'common', //COMMON OR YOUR TENANT ID
  clientId: 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', //This is your client ID
  redirectUri: `http://localhost/trs/public/authentication`, //This is your redirect URI
  cacheLocation: 'localStorage',
  // callback: userSignedIn,
  popUp: true,
  endpoints : {"https://graph.microsoft.com": "https://graph.microsoft.com"},
}