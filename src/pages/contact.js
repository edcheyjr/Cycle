// global imports
import '../toggleSidebar.js'
import '../cart/toggleCart.js'
import '../cart/setCart.js'

//using selectors inside the element
const questions = document.querySelectorAll('.question')

questions.forEach(function (question) {
  const btn = question.querySelector('.question-btn')
  // console.log(btn);

  btn.addEventListener('click', function () {
    // console.log(question);

    questions.forEach(function (item) {
      if (item !== question) {
        item.classList.remove('show-text')
      }
    })

    question.classList.toggle('show-text')
  })
})

// traversing the dom
// const btns = document.querySelectorAll(".question-btn");

// btns.forEach(function (btn) {
//   btn.addEventListener("click", function (e) {
//     const question = e.currentTarget.parentElement.parentElement;

//     question.classList.toggle("show-text");
//   });

// display frequently asked question and user can submit questions if he or she is logged in
