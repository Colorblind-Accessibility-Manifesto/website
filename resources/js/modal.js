
const modal  = document.getElementById('issue-modal');
const close  = modal.getElementsByClassName('modal-close')[0];
const button = document.getElementById('add-an-issue');

const toggleClass = 'show';

button.addEventListener('click', () => {
    modal.classList.add(toggleClass);
});

close.addEventListener('click', () => {
    modal.classList.remove(toggleClass);
});
