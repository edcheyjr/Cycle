// display frequently asked question and user can submit questions if he or she is logged in

// global imports
import '../toggleSidebar.js'
import '../cart/toggleCart.js'
import '../cart/setCart.js'

//
import { getElement, getElements } from '../utils.js'

//using selectors inside the element
// const questions = getElements('.question')

// questions.forEach(function (question) {
//   const btn = getElement('.question-btn')
//   btn.addEventListener('click', function () {
//     questions.forEach(function (item) {
//       if (item !== question) {
//         item.classList.remove('show-text')
//       }
//     })

//     question.classList.toggle('show-text')
//   })
// })

// traversing the dom
const btns = getElements('.question-btn')
const error = getElement('.error-msg')
const success = getElement('.success-msg')

btns.forEach(function (btn) {
  btn.addEventListener('click', function (e) {
    const question = e.currentTarget.parentElement.parentElement

    question.classList.toggle('show-text')
  })
})

const form = document.getElementById('contact-us')
// send data
form.addEventListener('submit', (event) => {
  const name = getElement('#name').value
  const email = getElement('#email').value
  const subject = getElement('#subject').value
  const message = getElement('#message').value

  // prevent default submmisssion
  event.preventDefault()

  const data = {
    submit_contact: 'submit_contact',
    name: name,
    email: email,
    subject: subject,
    message: message,
  }
  if (name != '' && email != '' && subject != '' && message != '') {
    handleContactUs(data)
  } else {
    error.innerHTML = `<p>please fill all the fields</p>`
  }
})

const handleContactUs = (data) => {
  // console.log('handling submission')
  // console.log(data)
  fetch('http://localhost/ecycle/contactus.php', {
    method: 'POST',
    body: JSON.stringify(data),
    headers: { 'Content-type': 'application/json; charset=UTF-8' },
  })
    .then((response) => response.json())
    .then((json) => {
      console.log(json)
      console.log(success)

      if (json.success == 'submitted') {
        success.innerHTML = `<p class= 'success-msg'>${json.success}, thank you for you question, we will get back to you soon</p>`
      } else
        error.innerHTML = `<p  class='error-msg'>Oops! the was a problem submitting</p>`
    })
    .catch((err) => console.log(err))
}
