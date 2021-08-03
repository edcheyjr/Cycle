import { getElement, getStorageItem, setStorageItem } from './utils.js'
import { displayCartTotal } from './cart/setCart.js'

const form = getElement('#order')
const cart = getStorageItem('cart')
const error = getElement('.error-msg')
const success = getElement('.success-msg')
const submitbtn = getElement('#cart-submit')

form.addEventListener('click', (event) => {
  // prevent default submmisssion
  event.preventDefault()
  const user_id = getElement('#user_id').value
  if (user_id !== null) {
    handleOrders(user_id)
  } else {
    error.innerHTML = `<p class='error-msg'>one of the fields in empty</p>`
  }
})

const handleOrders = (user_id) => {
  let totalAmount = 0
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
      .then((response) => response.json())
      .then((json) => {
        console.log(json)
        if (json.success == 'success') {
          console.log(json.success)
          success.innerHTML = `<p class='success-msg'>${json.order}</p>`
          setStorageItem('cart', [])
          removeItem(id)
          displayCartTotal()

          // setRemoveItemFromCart([], id, submitbtn)
        } else
          error.innerHTML = `<p class = 'success-msg'>Oops! the was a problem submitting</p>`
      })
      .catch((err) => console.log(err))
  })
}
