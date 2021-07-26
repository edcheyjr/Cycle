import { getElement } from './utils.js'

const input = document.querySelectorAll('input')
const btn = document.querySelector('.btn')

input.forEach((input) => {
  if (input.value == '') {
    btn.classList.add('disable')
    btn.disabled = true
  }
  btn.classList.toggle('disable')
  btn.toggleAttribute('disable')
})
