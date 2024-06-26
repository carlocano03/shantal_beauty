document.addEventListener('DOMContentLoaded', function () {
    const stepper = new Stepper(document.querySelector('.bs-stepper'), {
        linear: false,
        animation: true
    });

    const firstFormNext = document.getElementById('first-form')
    const secondFormNext = document.getElementById('second-form')
    const thirdFormNext = document.getElementById('third-form')
    const fourthFormNext = document.getElementById('fourth-form')
    const fifthFormNext = document.getElementById('fifth-form')

    const secondFormBack = document.getElementById('second-form-back')
    const thirdFormBack = document.getElementById('third-form-back')
    const fourthFormBack = document.getElementById('fourth-form-back')
    const fifthFormBack = document.getElementById('fifth-form-back')
    const sixthFormBack = document.getElementById('sixth-form-back')


    // Next 
    firstFormNext.addEventListener('click', () => {
        stepper.next();
    })
    secondFormNext.addEventListener('click', () => {
        stepper.next();
    })
    thirdFormNext.addEventListener('click', () => {
        stepper.next();
    })
    fourthFormNext.addEventListener('click', () => {
        stepper.next();
    })
    fifthFormNext.addEventListener('click', () => {
        stepper.next();
    })


    // Back
    secondFormBack.addEventListener('click', () => {
        stepper.to(1);
    })
    thirdFormBack.addEventListener('click', () => {
        stepper.to(2);
    })
    fourthFormBack.addEventListener('click', () => {
        stepper.to(3);
    })
    fifthFormBack.addEventListener('click', () => {
        stepper.to(4);
    })
    sixthFormBack.addEventListener('click', () => {
        stepper.to(5);
    })


});
