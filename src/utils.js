// get all products
const allProductsUrl = 'https://course-api.com/javascript-store-products'

// gets single product request
const singleProductUrl =
  'https://course-api.com/javascript-store-single-product'

// util function for getting Dom elements
const getElement = (selection) => {
  const element = document.querySelector(selection)
  if (element) return element
  throw new Error(`Please check "${selection}" selector, no such element exist`)
}

// function for formatting the currency to 2 decimal points
const formatPrice = (price) => {
  let formattedPrice = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'KSH',
  }).format((price / 100).toFixed(2))
  return formattedPrice
}
// gets storageItem from localStorage if their is any item

const getStorageItem = (item) => {
  let storageItem = localStorage.getItem(item)
  if (storageItem) {
    storageItem = JSON.parse(localStorage.getItem(item))
  } else {
    storageItem = []
  }
  return storageItem
}

// setting the localstorage with data
const setStorageItem = (name, item) => {
  localStorage.setItem(name, JSON.stringify(item))
}

// use named export to export the util functions
export {
  allProductsUrl,
  singleProductUrl,
  getElement,
  formatPrice,
  getStorageItem,
  setStorageItem,
}
