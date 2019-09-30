const Gateway = require('./Gateway');
const source = 'Name my platform';
const uri = 'My gateway URI';
const key = 'My key';
const secret = 'My secret';

(async () => {
  const gateway = new Gateway(source, uri, key, secret);
  return gateway.getNewAddress('BTC', {email: 'test@test.com'});
})()
.then(console.log)
.catch(console.error)
.finally(process.exit);