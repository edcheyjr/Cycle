/**gets the element using the two utils function
 * getStorageItems,
 */
import { getStorageItem, setStorageItem } from './utils.js'
let store = getStorageItem('store')

const setupStore = (products) => {
  store = products.map((product) => {
    const {
      id,
      fields: { featured, name, price, company, colors, image: img },
    } = product
    const image = img[0].thumbnails.large.url

    // product AND img
    console.log('product', product)
    console.log('img', img)
    return { id, featured, name, price, company, colors, image }
  })
  setStorageItem('store', store)
}

const findProduct = (id) => {
  let product = store.find((product) => product.id === id)
  return product
}

export { store, setupStore, findProduct }
