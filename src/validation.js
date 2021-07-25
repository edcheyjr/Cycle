import { getElement } from './utils.js'

const input = document.querySelectorAll('.form-control')
const btn = document.querySelector('.btn')

input.addEventListener('keyup', () => {
  input.forEach((input) => {
    if (!input.value) {
      btn.classList.add('disable')
      btn.disabled = true
    }
    btn.classList.remove('disable')
    btn.removeAttribute('disable')
  })
})
