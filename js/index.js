const Gateway = require('./Gateway');
const uri = 'http://localhost:3002'; // My gateway URI
const key = '4YvMUp6xP7PEVXqW3NyZm9LBkmycJ9cu'; // My key
const secret = '3B2PhQoESpk5xVHi49qtl8Jr5WZtS2N7iVuoe9jR8Jg5F7Oh'; // My secret

(async () => {
  const customer = {
    cid: 1, 
    name: 'Test',
    email: 'test@test.com',
    lang: 'en',
  };
  const gateway = new Gateway(uri, key, secret);
  let result = await gateway.getNewAddress('BTC', false, customer);
  console.log('getNewAddress =', result);
  result = await gateway.createWithdrawal(
    'BTC', '2NGZrVvZG92qGYqzTLjCAewvPZ7JE8S8VxE', 0.001, '', '', customer,
  );
  console.log('createWithdrawal =', result);
})()
.then(console.log)
.catch(console.error)
.finally(process.exit);