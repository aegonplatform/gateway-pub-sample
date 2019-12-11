
const rp = require('request-promise');
const url = require('url');
const pick = require('lodash/pick');
const get = require('lodash/get');
const set = require('lodash/set');
const qs = require('querystring');
const crypto = require('crypto');

module.exports = class Gateway {

  constructor(uri, key, secret) {
    this._uri = uri;
    this._key = key;
    this._secret = secret;
  }

  _getURI() {
    const parse = url.parse(this._uri);
    return `${parse.protocol}//${parse.host}`;
  }

  _getSignature(endpoint, data) {
    const search = qs.stringify(data);
    return crypto
      .createHmac('sha512', this._secret)
      .update(JSON.stringify({
        cmd: endpoint, key: this._key, search,
      }))
      .digest('hex');
  }

  async _executeRequest(endpoint, data = {}) {
    try {
      const uri = this._getURI() + endpoint;
      const options = {
        method: 'GET',
        json: true,
        uri,
        qs: data,
        headers: {
          'accept': 'application/json',
          'content-type': 'application/json',
          'ag-access-key': this._key,
          'ag-access-timestamp': Date.now(),
        },
      };
      const signature = this._getSignature(endpoint, data);
      set(options, 'headers.ag-access-signature', signature);
      return await rp(options);
    } catch (err) {
      const error = get(err, 'error.error');
      if (error) throw error;
      throw err;
    }
  }

  async getNewAddress(ticker, fromMaster = false, customer) {
    ticker = ticker.toLowerCase();
    const email = get(customer, 'email');
    customer = get(customer, '__data', customer);
    customer = JSON.stringify(pick(customer, [
      'cid', 'name', 'lang',
    ]));
    return this._executeRequest('/api/deposits/getnewaddress', {
      ticker, email, fromMaster, customer,
    });
  }

  async createWithdrawal(ticker, address, amount, destTag = '', note = '', customer) {
    ticker = ticker.toLowerCase();
    const email = get(customer, 'email');
    customer = get(customer, '__data', customer);
    customer = JSON.stringify(pick(customer, [
      'cid', 'name', 'lang',
    ]));
    return this._executeRequest('/api/withdrawals/createwithdrawal', {
      ticker, email, address, amount, destTag, note, customer,
    });
  }
};
