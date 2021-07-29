import { allProductsUrl } from './utils.js'

//  create a promise to fetch or request products from the backend
const fetchProducts = async () => {
  const response = await fetch(allProductsUrl).catch((err) => console.log(err))
  //    check if their is responses
  if (response) {
    return response.json()
  }
  return response
}
export default fetchProducts
