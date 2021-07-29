// global imports
import '../toggleSidebar.js'
// named imports
import { getElement, getElements } from '../utils.js'

const input = getElements('input')
const btn = getElement('.btn')

input.forEach((input) => {
  if (input.value == '') {
    btn.classList.add('disable')
    btn.disabled = true
  }
  btn.classList.toggle('disable')
  btn.toggleAttribute('disable')
})
