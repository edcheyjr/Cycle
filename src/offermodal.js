import { getElement } from './utils.js'

const modal = getElement('#offer')

if (document.readyState === 'complete') {
  modal.modal('show')
}
