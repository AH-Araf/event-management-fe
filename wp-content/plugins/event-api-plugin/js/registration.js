document.getElementById('register_btn').onclick = async function () {
    const email = document.getElementById('reg_email').value;
    const password = document.getElementById('reg_password').value;

    const response = await fetch('http://localhost:8000/api/v1/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, password }),
    });

    const messageDiv = document.getElementById('reg_message');
    messageDiv.classList.remove('registration-form__message--error');
    messageDiv.classList.remove('registration-form__message--success');

    const result = await response.json();

    if (response.ok) {
        messageDiv.textContent = result.message;
        messageDiv.classList.add('registration-form__message--success');
        // Clear the form after successful registration
        document.getElementById('reg_email').value = '';
        document.getElementById('reg_password').value = '';

        // Redirect to the login page after successful registration
        window.location.href = 'http://eventmanagement.local/';
    } else {
        messageDiv.textContent = result.message || 'Registration failed.';
        messageDiv.classList.add('registration-form__message--error');
    }
};

// BEM-style CSS
const style = document.createElement('style');
style.textContent = `
    .registration-form {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        max-width: 400px;
        margin: auto;
        background-color: #f9f9f9;
    }
    .registration-form__title {
        margin-bottom: 15px;
    }
    .registration-form__input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s;
    }
    .registration-form__input:focus {
        border-color: #007bff;
    }
    .registration-form__button {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    .registration-form__button:hover {
        background-color: #218838;
    }
    .registration-form__message {
        margin-top: 10px;
    }
    .registration-form__message--error {
        color: red;
    }
    .registration-form__message--success {
        color: green;
    }
`;
document.head.appendChild(style);