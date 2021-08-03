// global imports
import './toggleSidebar.js'
// named imports
import { getElement, getElements } from './utils.js'

const input = getElements('input')
const btn = getElement('.btn')
btn.disabled = true
btn.classList.add('disable')

input.forEach((input) => {
  input.onchange = handleChange
  function handleChange(e) {
    if (e.target.value.length == 0) {
      btn.classList.add('disable')
      btn.disabled = true
    }
    btn.classList.toggle('disable')
    btn.disabled = false
  }
})
