import { getElement, getStorageItem, setStorageItem } from './utils.js'

const form = getElement('#order')
const cart = getStorageItem('cart')
const error = getElement('.error-msg')
const success = getElement('.success-msg')

form.addEventListener('submit', (event) => {
  event.preventDefault()
  const user_id = getElement('#user_id').value
  if (user_id !== null) {
    handleOrders(user_id)
    setStorageItem('cart', [])
  } else {
    error.innerHtml = 'one of the fields in empty'
  }
})

const handleOrders = (user_id) => {
  let totalAmount = 0
  console.log(user_id)
  cart.map((items) => {
    // destructor items
    const { id, price, amount } = items

    // calculate total
    totalAmount = price * amount

    const data = {
      product_id: parseInt(id),
      user_id: parseInt(user_id),
      quantity: amount,
      price: parseInt(price),
      total_amount: parseInt(totalAmount),
    }

    console.log('data', data)

    fetch('http://localhost/ecycle/order.php', {
      method: 'POST',
      body: JSON.stringify(data),
      headers: { 'Content-type': 'application/json; charset=UTF-8' },
    })
      .then((response) => {
        if (response.json().success == true) {
          success.innerHtml = `${response.json().success}`
        } else {
          error.innerHtml = `${response}`
        }
      })
      .then((json) => console.log(json))
      .catch((err) => console.log(err))
  })
}
