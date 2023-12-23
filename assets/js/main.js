 document.addEventListener('DOMContentLoaded', () => {
    const loginFormContainer = document.querySelectorAll('.ring')[0];
    const registerFormContainer = document.querySelectorAll('.ring')[1];
    const checkboxToggle = document.getElementById('checkbox_toggle');

    const toggleForms = () => {
    if (checkboxToggle.checked) {
    registerFormContainer.style.display = 'flex';
    loginFormContainer.style.display = 'none';
} else {
    loginFormContainer.style.display = 'flex';
    registerFormContainer.style.display = 'none'
}
};

    toggleForms();

    checkboxToggle.addEventListener('change', toggleForms);
});

    document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    const validateForm = (event) => {
    if (!event.target.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
    alert('Please fill out the form correctly.');
}
};

    loginForm.addEventListener('submit', validateForm);
    registerForm.addEventListener('submit', validateForm);
});



