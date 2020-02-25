
const assert = require('chai').assert;
const Gateway = require('../');

/**
 * Integration Tests
 */
describe('js/Gateway.js', () => {
  const uri = 'http://localhost:3002'; // My gateway URI
  const key = '6u23eJTVL4yNzprH6AlRo8nja3jT5ekv'; // My key
  const secret = '01STgFyfRJ7yi17d8Uab1B7WU7M1TZ0L4tF2KGLSFkdhxs6P'; // My secret
  const gateway = new Gateway(uri, key, secret);

  const ticker = 'BTC';
  const customer = {
    cid: 1,
    name: 'Test',
    email: 'test@test.com',
    lang: 'en',
  };

  describe('getNewAddress', () => {
    it('Get new address', async () => {
      const result = await gateway.getNewAddress(ticker, false, customer, '1');
      assert.containsAllKeys(result, ['address', 'destTag', 'expired']);
    });
  });

  describe('createWithdrawal', () => {
    it('Create withdrawal', async () => {
      const result = await gateway.createWithdrawal(
        ticker, '2NGZrVvZG92qGYqzTLjCAewvPZ7JE8S8VxE',
        0.001, '', '', customer, '1',
      );
      assert.containsAllKeys(result, ['amount', 'created', 'scheduling']);
    });
  });

  describe('getFeesList', () => {
    it('Get fees list', async () => {
      const result = await gateway.getFeesList(ticker);
      assert.isArray(result);
    });
  });
});
