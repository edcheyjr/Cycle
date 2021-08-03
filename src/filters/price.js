import { getElement } from '../utils.js'
import display from '../displayProducts.js'

const setupPrice = (store) => {
  const priceInput = getElement('.price-filter')
  const priceValue = getElement('.price-value')

  // setup filter by default to the maximum price value
  let maxPrice = store.map((product) => product.price)
  maxPrice = Math.max(...maxPrice)
  //   round up
  maxPrice = Math.ceil(maxPrice / 1)
  priceInput.value = maxPrice
  priceInput.max = maxPrice
  priceInput.min = 0
  priceValue.textContent = `Value : $${maxPrice}`

  priceInput.addEventListener('input', function () {
    const value = parseInt(priceInput.value)

    priceValue.textContent = `Value : KSH${value}`

    // then when input get from the toggle filter to show only those less or equal to that price
    let newStore = store.filter((product) => product.price / 1 <= value)

    // the only display those bycycles or products
    display(newStore, getElement('.products-container'), true)

    //  add if the the length of array filtered is zero display this messages
    if (newStore.length < 1) {
      const products = getElement('.products-container')
      products.innerHTML = `<h3 class="filter-error">sorry, no products matched your search</h3>`
    }
  })
}

export default setupPrice

// filter by price
